<script setup>
import { computed, onMounted, reactive, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'
import ConfirmModal from '../../components/ui/ConfirmModal.vue'
import { useAuth } from '../../composables/useAuth'
import { useTaskStore } from '../../composables/useTaskStore'
import { useToast } from '../../composables/useToast'

const route = useRoute()
const router = useRouter()

const {
  workspaces,
  users,
  loadWorkspaces,
  loadUsers,
  isLoadingWorkspaces,
  isLoadingUsers,
  createWorkspace,
  updateWorkspace,
  deleteWorkspace
} = useTaskStore()

const { createUser, updateUser, deleteUser } = useAuth()
const { addToast } = useToast()

// ── Active Tab ──────────────────────────────────────────────────────────────
const activeTab = ref('workspaces') // 'workspaces' | 'directory'

const showWorkspaceModal = ref(false)
const showUserModal = ref(false)
const workspaceSaving = ref(false)
const userSaving = ref(false)
const editingWorkspaceId = ref(null)
const editingUserId = ref(null)

const workspaceForm = reactive({
  name: '',
  description: '',
  status: 'active'
})

const userForm = reactive({
  name: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user',
  workspace_id: '',
  is_active: true
})

const workspaceErrors = reactive({
  name: '',
  description: '',
  status: '',
  form: ''
})

const userErrors = reactive({
  name: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: '',
  workspace_id: '',
  form: ''
})

const isEditingWorkspace = computed(() => editingWorkspaceId.value !== null)
const isEditingUser = computed(() => editingUserId.value !== null)
const workspaceCount = computed(() => workspaces.value.length)
const memberCount = computed(() => users.value.length)
const canCreateUser = computed(() => workspaces.value.length > 0)

// ═══════════════════════════════════════════════════════════════════════════
// COMPUTED HELPERS (from frontend drawer UI)
// ═══════════════════════════════════════════════════════════════════════════

// Initials for workspace icon
const workspaceInitials = (name) =>
  (name || '').split(/\s+/).filter(Boolean).map(w => w[0]).join('').slice(0, 2).toUpperCase()

// ═══════════════════════════════════════════════════════════════════════════
// WORKSPACE SLIDE-OUT DRAWER (frontend UX)
// ═══════════════════════════════════════════════════════════════════════════

const drawerOpen     = ref(false)
const drawerWorkspace = ref(null)
const drawerMembers = computed(() => {
  if (!drawerWorkspace.value?.id) return []

  return users.value.filter(user => {
    const workspaceId = user.workspaceId ?? user.workspace_id ?? user.workspace?.id ?? null
    return String(workspaceId) === String(drawerWorkspace.value.id)
  })
})

const openDrawer = (ws) => {
  drawerWorkspace.value = ws
  drawerOpen.value = true
}

const closeDrawer = () => {
  drawerOpen.value = false
  setTimeout(() => { drawerWorkspace.value = null }, 300) // after animation
}

// ═══════════════════════════════════════════════════════════════════════════
// FORM HELPERS (from develop API logic)
// ═══════════════════════════════════════════════════════════════════════════

function resetErrors(target) {
  Object.keys(target).forEach((key) => {
    target[key] = ''
  })
}

function resetWorkspaceForm() {
  workspaceForm.name = ''
  workspaceForm.description = ''
  workspaceForm.status = 'active'
  editingWorkspaceId.value = null
  resetErrors(workspaceErrors)
}

function resetUserForm() {
  userForm.name = ''
  userForm.username = ''
  userForm.email = ''
  userForm.password = ''
  userForm.password_confirmation = ''
  userForm.role = 'user'
  userForm.workspace_id = ''
  userForm.is_active = true
  editingUserId.value = null
  resetErrors(userErrors)
}

function syncTabFromRoute() {
  activeTab.value = route.query.tab === 'directory' ? 'directory' : 'workspaces'
}

function setActiveTab(tab) {
  activeTab.value = tab
  router.replace({
    path: route.path,
    query: tab === 'directory' ? { tab: 'directory' } : {}
  })
}

function openWorkspaceModal(workspace = null) {
  resetWorkspaceForm()

  if (workspace) {
    editingWorkspaceId.value = workspace.id
    workspaceForm.name = workspace.name || ''
    workspaceForm.description = workspace.description || ''
    workspaceForm.status = workspace.status || 'active'
  }

  showWorkspaceModal.value = true
}

function openUserModal(user = null) {
  if (!canCreateUser.value) {
    addToast({ message: 'Create a workspace first before creating an account.', type: 'error' })
    return
  }

  resetUserForm()

  if (user) {
    editingUserId.value = user.id
    userForm.name = user.name || ''
    userForm.username = user.username || ''
    userForm.email = user.email || ''
    userForm.role = user.role || 'user'
    userForm.workspace_id = user.workspaceId || ''
    userForm.is_active = Boolean(user.is_active)
  }

  showUserModal.value = true
}

function closeWorkspaceModal() {
  showWorkspaceModal.value = false
  resetWorkspaceForm()
}

function closeUserModal() {
  showUserModal.value = false
  resetUserForm()
}

async function refreshAll() {
  await Promise.all([loadWorkspaces(), loadUsers()])
}

function validateWorkspace() {
  resetErrors(workspaceErrors)

  if (!workspaceForm.name.trim()) {
    workspaceErrors.name = 'Workspace name is required.'
  }

  return !Object.values(workspaceErrors).some(Boolean)
}

function validateUser() {
  resetErrors(userErrors)

  if (!userForm.name.trim()) userErrors.name = 'Full name is required.'
  if (!userForm.username.trim()) userErrors.username = 'Username is required.'
  if (!userForm.email.trim()) userErrors.email = 'Email is required.'
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(userForm.email.trim())) {
    userErrors.email = 'Enter a valid email address.'
  }
  if (!userForm.workspace_id) userErrors.workspace_id = 'Choose a workspace.'
  if (!isEditingUser.value && !userForm.password) userErrors.password = 'Password is required.'
  if (userForm.password && userForm.password.length < 8) {
    userErrors.password = 'Password must be at least 8 characters.'
  }
  if (userForm.password && userForm.password !== userForm.password_confirmation) {
    userErrors.password_confirmation = 'Passwords do not match.'
  }
  if (!userForm.role) userErrors.role = 'Choose a role.'

  return !Object.values(userErrors).some(Boolean)
}

async function handleWorkspaceSubmit() {
  if (!validateWorkspace()) return

  workspaceSaving.value = true
  const payload = {
    name: workspaceForm.name.trim(),
    description: workspaceForm.description.trim() || null,
    status: workspaceForm.status
  }

  try {
    if (isEditingWorkspace.value) {
      await updateWorkspace(editingWorkspaceId.value, payload)
      addToast({ message: 'Workspace updated successfully.', type: 'success' })
    } else {
      await createWorkspace(payload)
      addToast({ message: 'Workspace created successfully.', type: 'success' })
    }

    await refreshAll()
    closeWorkspaceModal()
  } catch (error) {
    workspaceErrors.form = error?.response?.data?.message || 'We could not save that workspace.'
  } finally {
    workspaceSaving.value = false
  }
}

async function handleUserSubmit() {
  if (!validateUser()) return

  userSaving.value = true

  const payload = {
    name: userForm.name.trim(),
    username: userForm.username.trim(),
    email: userForm.email.trim(),
    role: userForm.role,
    workspace_id: userForm.workspace_id,
    is_active: userForm.is_active
  }

  if (userForm.password) {
    payload.password = userForm.password
    payload.password_confirmation = userForm.password_confirmation
  }

  try {
    if (isEditingUser.value) {
      await updateUser(editingUserId.value, payload)
      addToast({ message: 'User updated successfully.', type: 'success' })
    } else {
      await createUser(payload)
      addToast({ message: 'User created successfully.', type: 'success' })
    }

    await refreshAll()
    closeUserModal()
  } catch (error) {
    const responseErrors = error?.response?.data?.errors || {}
    userErrors.form = error?.response?.data?.message || 'We could not save that account.'
    userErrors.name = responseErrors.name?.[0] || userErrors.name
    userErrors.username = responseErrors.username?.[0] || userErrors.username
    userErrors.email = responseErrors.email?.[0] || userErrors.email
    userErrors.password = responseErrors.password?.[0] || userErrors.password
    userErrors.password_confirmation = responseErrors.password_confirmation?.[0] || userErrors.password_confirmation
    userErrors.workspace_id = responseErrors.workspace_id?.[0] || userErrors.workspace_id
    userErrors.role = responseErrors.role?.[0] || userErrors.role
  } finally {
    userSaving.value = false
  }
}

// ── Delete Confirmation ─────────────────────────────────────────────────────
const showDeleteConfirm = ref(false)
const pendingDelete = ref(null) // { type: 'workspace'|'user', item: {...} }

function requestWorkspaceDelete(workspace) {
  pendingDelete.value = { type: 'workspace', item: workspace }
  showDeleteConfirm.value = true
}

function requestUserDelete(user) {
  pendingDelete.value = { type: 'user', item: user }
  showDeleteConfirm.value = true
}

async function confirmDelete() {
  const { type, item } = pendingDelete.value || {}
  showDeleteConfirm.value = false
  pendingDelete.value = null
  if (!item) return

  try {
    if (type === 'workspace') {
      await deleteWorkspace(item.id)
      addToast({ message: 'Workspace deleted.', type: 'success' })
      closeDrawer()
    } else {
      await deleteUser(item.id)
      addToast({ message: 'User deleted.', type: 'success' })
    }
    await refreshAll()
  } catch (error) {
    addToast({ message: error?.response?.data?.message || `Unable to delete the ${type}.`, type: 'error' })
  }
}

function cancelDelete() {
  showDeleteConfirm.value = false
  pendingDelete.value = null
}

const deleteConfirmTitle = computed(() =>
  pendingDelete.value?.type === 'workspace' ? 'Delete Workspace' : 'Delete User'
)
const deleteConfirmMessage = computed(() => {
  if (!pendingDelete.value) return ''
  const name = pendingDelete.value.item.name || 'this item'
  return `Are you sure you want to delete &quot;${name}&quot;? This action cannot be undone.`
})

watch(
  () => route.query.tab,
  () => {
    syncTabFromRoute()
  },
  { immediate: true }
)

onMounted(refreshAll)
</script>

<template>
  <div class="space-y-6">

    <!-- ── Page Header ──────────────────────────────────────────────────── -->
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-3xl font-black text-ink mb-1">Manage Workspace</h1>
        <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">
          Administer workspaces, teams, and member access.
        </p>
      </div>
    </div>

    <!-- ── Tab Bar ──────────────────────────────────────────────────────── -->
    <div class="neo-tab-bar">
      <button
        :class="['neo-tab', activeTab === 'workspaces' ? 'active' : '']"
        @click="setActiveTab('workspaces')"
      >
        Workspaces
      </button>
      <button
        :class="['neo-tab', activeTab === 'directory' ? 'active' : '']"
        @click="setActiveTab('directory')"
      >
        User Directory
      </button>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- TAB 1 — WORKSPACES LIST                                            -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div v-if="activeTab === 'workspaces'" class="space-y-4">

      <!-- Actions bar -->
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">
          {{ workspaceCount }} WORKSPACE{{ workspaceCount !== 1 ? 'S' : '' }}
        </span>
        <NeoButton variant="primary" @click="openWorkspaceModal()">
          + ADD WORKSPACE
        </NeoButton>
      </div>

      <!-- Workspace Grid (click card → open drawer) -->
      <div v-if="workspaceCount > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="workspace in workspaces"
          :key="workspace.id"
          class="workspace-card cursor-pointer flex-col items-stretch"
          @click="openDrawer(workspace)"
        >
          <div class="flex items-center gap-4">
            <!-- Color icon -->
            <div
              :class="[workspace.color || 'bg-neoIndigo', 'ws-icon text-ink']"
            >
              {{ workspaceInitials(workspace.name) }}
            </div>

            <!-- Info -->
            <div class="ws-info">
              <div class="ws-name">{{ workspace.name }}</div>
              <div class="ws-meta">
                {{ workspace.usersCount }} member{{ workspace.usersCount !== 1 ? 's' : '' }}
                &nbsp;·&nbsp;{{ workspace.status }}
              </div>
            </div>

            <!-- Status badge -->
            <span :class="workspace.status === 'active' ? 'badge-low' : 'badge-high'">
              {{ workspace.status.toUpperCase() }}
            </span>
          </div>

          <div class="mt-3 flex items-center justify-end gap-2">
            <button class="neo-action-btn" @click.stop="openWorkspaceModal(workspace)">Edit</button>
            <button class="neo-action-btn" @click.stop="requestWorkspaceDelete(workspace)">Delete</button>
          </div>
        </div>
      </div>

      <!-- Empty state for workspaces tab -->
      <div
        v-else
        class="brut-border brut-shadow bg-neoCard p-10 flex flex-col items-center justify-center text-center gap-4"
      >
        <div class="text-5xl">🏗️</div>
        <p class="text-xl font-black uppercase tracking-wide text-ink">
          No Workspaces Yet
        </p>
        <p class="text-xs font-bold text-neoMuted">
          Create your first workspace to start organising your team.
        </p>
        <button
          @click="openWorkspaceModal()"
          class="mt-2 px-6 py-3 bg-neoYellow text-ink brut-border brut-shadow font-black text-xs uppercase tracking-wide brut-hover cursor-pointer"
        >
          + Create Workspace
        </button>
      </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- TAB 2 — USER DIRECTORY                                             -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <div v-if="activeTab === 'directory'" class="space-y-4">

      <!-- Actions bar -->
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">
          {{ memberCount }} MEMBER{{ memberCount !== 1 ? 'S' : '' }}
        </span>
        <NeoButton
          variant="primary"
          :disabled="!canCreateUser"
          @click="openUserModal()"
        >
          + CREATE ACCOUNT / INVITE
        </NeoButton>
      </div>

      <!-- Empty-state chicken-or-egg warning when no workspaces exist -->
      <div
        v-if="!canCreateUser"
        class="brut-border bg-neoYellow p-6 flex items-center gap-5"
      >
        <span class="text-3xl flex-shrink-0">🐣</span>
        <div>
          <p class="text-xs font-black uppercase tracking-widest text-ink mb-1">
            Workspace Required
          </p>
          <p class="text-sm font-black uppercase tracking-wide text-ink leading-snug">
            CREATE A WORKSPACE FIRST TO INVITE YOUR TEAM.
          </p>
          <button
            @click="setActiveTab('workspaces'); openWorkspaceModal()"
            class="mt-3 px-4 py-1.5 bg-ink text-neoCard brut-border font-black text-xs uppercase tracking-wide brut-hover cursor-pointer"
          >
            → Create a Workspace
          </button>
        </div>
      </div>

      <!-- Users Table -->
      <div class="brut-border brut-shadow bg-neoCard overflow-x-auto">
        <table class="neo-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Workspace</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="users.length === 0">
              <td colspan="5" class="py-8 text-center text-xs font-black uppercase tracking-wider text-neoMuted">
                No members yet
              </td>
            </tr>
            <tr v-for="user in users" :key="user.id">
              <td>
                <div class="flex items-center gap-3">
                  <!-- Avatar initials -->
                  <div
                    class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-neoIndigo/20 brut-border font-black text-xs text-ink"
                  >
                    {{ (user.name || '').split(' ').map(w => w[0]).join('').toUpperCase().slice(0,2) }}
                  </div>
                  <span class="font-bold text-ink">{{ user.name }}</span>
                </div>
              </td>
              <td class="text-neoMuted">{{ user.email }}</td>
              <td>
                <span :class="user.role === 'admin' ? 'badge-admin' : 'badge-user'">
                  {{ user.role.toUpperCase() }}
                </span>
              </td>
              <td>{{ user.workspaceName || '-' }}</td>
              <td class="text-right">
                <div class="flex items-center justify-end gap-1.5">
                  <button class="neo-action-btn" @click="openUserModal(user)">Edit</button>
                  <button class="neo-action-btn" @click="requestUserDelete(user)">Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div><!-- /tab directory -->

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- SLIDE-OUT DRAWER — Workspace Detail                                 -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">

    <!-- Backdrop -->
    <transition name="fade">
      <div
        v-if="drawerOpen"
        class="fixed inset-0 z-[9999] w-screen h-screen bg-zinc-900/80 backdrop-blur-sm"
        @click="closeDrawer"
      />
    </transition>

    <!-- Drawer panel -->
    <transition name="ws-drawer">
      <div
        v-if="drawerOpen && drawerWorkspace"
        class="fixed top-0 right-0 h-screen z-[10000] w-full max-w-md bg-neoCard flex flex-col"
        style="border-left: 3px solid var(--border-color); box-shadow: -6px 0 0 0 var(--shadow-color);"
      >
        <!-- Drawer Header -->
        <div
          class="flex items-center justify-between p-5"
          style="border-bottom: 2px solid var(--border-color);"
        >
          <div class="flex items-center gap-3">
            <div
              :class="[drawerWorkspace.color || 'bg-neoMint', 'w-10 h-10 flex items-center justify-center font-black text-sm text-ink brut-border flex-shrink-0']"
            >
              {{ workspaceInitials(drawerWorkspace.name) }}
            </div>
            <div>
              <h2 class="text-lg font-black uppercase tracking-wide text-ink leading-tight">
                {{ drawerWorkspace.name }}
              </h2>
              <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">
                {{ drawerWorkspace.status }}
              </p>
            </div>
          </div>
          <button
            @click="closeDrawer"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
          >✕</button>
        </div>

        <!-- Drawer Actions -->
        <div
          class="flex items-center gap-2 p-4"
          style="border-bottom: 2px solid var(--border-color);"
        >
          <button
            @click="openWorkspaceModal(drawerWorkspace)"
            class="flex-1 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoYellow/40 hover:bg-neoYellow brut-hover cursor-pointer transition-colors"
          >
            ✏ Edit
          </button>
          <button
            @click="requestWorkspaceDelete(drawerWorkspace)"
            class="flex-1 py-2 border-2 border-black font-black text-xs uppercase tracking-wide text-black bg-rose-500 hover:bg-rose-600 brut-hover cursor-pointer transition-colors"
          >
            🗑 Delete
          </button>
        </div>

        <!-- Drawer Body — Workspace Details -->
        <div class="flex-1 overflow-y-auto p-4 space-y-3">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-black uppercase tracking-wider text-neoMuted">
              Members ({{ drawerWorkspace.usersCount || 0 }})
            </span>
          </div>

          <div v-if="drawerMembers.length > 0" class="space-y-2">
            <div
              v-for="member in drawerMembers"
              :key="member.id"
              class="brut-border bg-neoCard px-3 py-2 flex items-center justify-between gap-3"
            >
              <div class="min-w-0">
                <p class="text-sm font-black uppercase tracking-wide text-ink truncate">
                  {{ member.name }}
                </p>
                <p class="text-[0.65rem] font-bold uppercase tracking-wide text-neoMuted truncate">
                  {{ member.role }} · {{ member.email }}
                </p>
              </div>
              <span :class="member.is_active ? 'badge-low' : 'badge-high'">
                {{ member.is_active ? 'ACTIVE' : 'INACTIVE' }}
              </span>
            </div>
          </div>

          <p v-else class="text-xs font-bold text-neoMuted uppercase tracking-wide">
            No active members found in this workspace.
          </p>

          <p class="text-xs font-bold text-neoMuted">
            {{ drawerWorkspace.description || 'No description provided.' }}
          </p>
        </div>
      </div>
    </transition>

    </Teleport>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- MODAL — Create/Edit Workspace                                      -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">
    <transition name="modal">
      <div
        v-if="showWorkspaceModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        @click.self="closeWorkspaceModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-md mx-4" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">
              {{ isEditingWorkspace ? 'Edit Workspace' : 'New Workspace' }}
            </h2>
            <button
              @click="closeWorkspaceModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >x</button>
          </div>

          <form class="p-5 space-y-4" @submit.prevent="handleWorkspaceSubmit">
            <NeoInput v-model="workspaceForm.name" label="Workspace Name" type="text" :error="workspaceErrors.name" required />
            <NeoInput v-model="workspaceForm.description" label="Description" type="text" :error="workspaceErrors.description" />

            <div class="flex flex-col gap-1">
              <label class="uppercase-label text-ink">Status</label>
              <select v-model="workspaceForm.status" class="neo-select w-full">
                <option value="active">Active</option>
                <option value="archived">Archived</option>
              </select>
            </div>

            <p v-if="workspaceErrors.form" class="text-sm font-medium text-red-600 bg-red-50 border-[3px] border-red-600 px-4 py-3">
              {{ workspaceErrors.form }}
            </p>

            <div class="flex items-center justify-end gap-3">
              <button
                type="button"
                class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
                @click="closeWorkspaceModal"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
              >
                {{ workspaceSaving ? 'Saving...' : 'Save' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
    </Teleport>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- MODAL — Create/Edit User Account                                   -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">
    <transition name="modal">
      <div
        v-if="showUserModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        @click.self="closeUserModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <div>
              <h2 class="text-lg font-black uppercase tracking-wide text-ink">
                {{ isEditingUser ? 'Edit User' : 'Create User Account' }}
              </h2>
              <p class="text-[0.6rem] font-black uppercase tracking-widest text-neoMuted mt-0.5">Internal Tool — Admin Access Only</p>
            </div>
            <button
              @click="closeUserModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >x</button>
          </div>

          <form class="p-5 space-y-4" @submit.prevent="handleUserSubmit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <NeoInput v-model="userForm.name" label="Full Name" type="text" :error="userErrors.name" required />
              <NeoInput v-model="userForm.username" label="Username" type="text" :error="userErrors.username" required />
              <NeoInput v-model="userForm.email" label="Email Address" type="email" :error="userErrors.email" required />

              <div class="flex flex-col gap-1">
                <label class="uppercase-label text-ink">Role</label>
                <select v-model="userForm.role" class="neo-select w-full">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
                <span v-if="userErrors.role" class="text-[0.6rem] font-black uppercase tracking-wide text-red-600 mt-0.5">
                  {{ userErrors.role }}
                </span>
              </div>

              <div class="flex flex-col gap-1">
                <label class="uppercase-label text-ink">Workspace</label>
                <select v-model="userForm.workspace_id" class="neo-select w-full" :disabled="!workspaces.length">
                  <option value="">{{ workspaces.length ? 'Select Workspace' : 'Create a workspace first' }}</option>
                  <option
                    v-for="workspace in workspaces"
                    :key="workspace.id"
                    :value="workspace.id"
                  >
                    {{ workspace.name }}{{ workspace.status === 'archived' ? ' (Archived)' : '' }}
                  </option>
                </select>
                <span v-if="userErrors.workspace_id" class="text-[0.6rem] font-black uppercase tracking-wide text-red-600 mt-0.5">
                  {{ userErrors.workspace_id }}
                </span>
              </div>

              <div class="flex items-center gap-3 md:col-span-2">
                <input v-model="userForm.is_active" type="checkbox" class="w-4 h-4 brut-border" />
                <span class="uppercase-label text-ink">Account active</span>
              </div>

              <div class="md:col-span-2">
                <NeoInput
                  v-model="userForm.password"
                  label="Password"
                  type="password"
                  :hint="isEditingUser ? 'Optional: leave blank to keep the current password.' : 'Required: 8+ characters, uppercase, lowercase, number, and special character.'"
                  :error="userErrors.password"
                  :required="!isEditingUser"
                />
              </div>

              <div class="md:col-span-2">
                <NeoInput
                  v-model="userForm.password_confirmation"
                  label="Confirm Password"
                  type="password"
                  placeholder="********"
                  :error="userErrors.password_confirmation"
                  :required="!isEditingUser && !!userForm.password"
                />
              </div>
            </div>

            <!-- Hint banner -->
            <div class="bg-neoYellow/20 brut-border p-3 flex items-start gap-2">
              <span class="text-sm flex-shrink-0">⚠</span>
              <p class="text-xs font-bold text-ink">
                Users <span class="font-black uppercase">must</span> be assigned to a workspace before they can access any project data.
              </p>
            </div>

            <p v-if="userErrors.form" class="text-sm font-medium text-red-600 bg-red-50 border-[3px] border-red-600 px-4 py-3">
              {{ userErrors.form }}
            </p>

            <div class="flex items-center justify-end gap-3">
              <button
                type="button"
                class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
                @click="closeUserModal"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
              >
                {{ userSaving ? 'Saving...' : (isEditingUser ? 'Save User' : 'Create Account') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
    </Teleport>

    <!-- Delete Confirmation Modal -->
    <ConfirmModal
      :isOpen="showDeleteConfirm"
      :title="deleteConfirmTitle"
      :message="deleteConfirmMessage"
      confirmLabel="Delete"
      variant="danger"
      @confirm="confirmDelete"
      @cancel="cancelDelete"
    />

  </div><!-- /root -->
</template>

<style scoped>
/* ── Workspace drawer slide animation (right side) ─────────────────────── */
.ws-drawer-enter-active {
  animation: ws-drawer-in 0.28s cubic-bezier(0.16, 1, 0.3, 1);
}
.ws-drawer-leave-active {
  animation: ws-drawer-out 0.2s ease-in;
}
@keyframes ws-drawer-in {
  from { transform: translateX(100%); }
  to   { transform: translateX(0); }
}
@keyframes ws-drawer-out {
  from { transform: translateX(0); }
  to   { transform: translateX(100%); }
}
</style>
