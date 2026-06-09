<script setup>
import { computed, onMounted, reactive, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'
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
  createWorkspace,
  updateWorkspace,
  deleteWorkspace
} = useTaskStore()

const { createUser, updateUser, deleteUser } = useAuth()
const { addToast } = useToast()

const activeTab = ref('workspaces')
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

function resetErrors(target) {
  Object.keys(target).forEach((key) => {
    target[key] = ''
  })
}

function workspaceInitials(name) {
  return (name || '')
    .split(/\s+/)
    .filter(Boolean)
    .map(word => word[0])
    .join('')
    .slice(0, 2)
    .toUpperCase()
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

async function handleWorkspaceDelete(workspace) {
  if (!window.confirm(`Delete workspace "${workspace.name}"? This cannot be undone.`)) return

  try {
    await deleteWorkspace(workspace.id)
    addToast({ message: 'Workspace deleted.', type: 'success' })
    await refreshAll()
  } catch (error) {
    addToast({ message: error?.response?.data?.message || 'Unable to delete the workspace.', type: 'error' })
  }
}

async function handleUserDelete(user) {
  if (!window.confirm(`Delete ${user.name}? This cannot be undone.`)) return

  try {
    await deleteUser(user.id)
    addToast({ message: 'User deleted.', type: 'success' })
    await refreshAll()
  } catch (error) {
    addToast({ message: error?.response?.data?.message || 'Unable to delete the user.', type: 'error' })
  }
}

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
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-3xl font-black text-ink mb-1">Manage Workspace</h1>
        <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">
          Administer workspaces and member access.
        </p>
      </div>
    </div>

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

    <div v-if="activeTab === 'workspaces'" class="space-y-4">
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">{{ workspaceCount }} WORKSPACES</span>
        <NeoButton variant="primary" @click="openWorkspaceModal()">
          + ADD WORKSPACE
        </NeoButton>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="workspace in workspaces"
          :key="workspace.id"
          class="workspace-card flex-col items-stretch"
        >
          <div class="flex items-center gap-4">
            <div :class="['ws-icon', workspace.color || 'bg-neoIndigo', 'text-ink']">
              {{ workspaceInitials(workspace.name) }}
            </div>
            <div class="ws-info">
              <div class="ws-name">{{ workspace.name }}</div>
              <div class="ws-meta">{{ workspace.usersCount }} members - {{ workspace.status }}</div>
            </div>
            <span :class="workspace.status === 'active' ? 'badge-low' : 'badge-high'">
              {{ workspace.status.toUpperCase() }}
            </span>
          </div>

          <div class="mt-3 flex items-center justify-end gap-2">
            <button class="neo-action-btn" @click="openWorkspaceModal(workspace)">Edit</button>
            <button class="neo-action-btn" @click="handleWorkspaceDelete(workspace)">Delete</button>
          </div>
        </div>
      </div>

      <div v-if="workspaceCount === 0" class="brut-border brut-shadow bg-neoCard p-6 text-center">
        <p class="text-xs font-black uppercase tracking-wider text-neoMuted">No workspaces yet</p>
      </div>
    </div>

    <div v-else class="space-y-4">
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">{{ memberCount }} MEMBERS</span>
        <NeoButton
          variant="primary"
          :disabled="!canCreateUser"
          @click="openUserModal()"
        >
          + CREATE ACCOUNT / INVITE
        </NeoButton>
      </div>

      <div v-if="!canCreateUser" class="brut-border brut-shadow bg-neoCard p-6">
        <p class="text-xs font-black uppercase tracking-wider text-neoMuted">
          Create a workspace first before creating user accounts.
        </p>
      </div>

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
              <td class="font-bold">{{ user.name }}</td>
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
                  <button class="neo-action-btn" @click="handleUserDelete(user)">Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <transition name="modal">
      <div
        v-if="showWorkspaceModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
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

    <transition name="modal">
      <div
        v-if="showUserModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
        @click.self="closeUserModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <div>
              <h2 class="text-lg font-black uppercase tracking-wide text-ink">
                {{ isEditingUser ? 'Edit User' : 'Create User' }}
              </h2>
              <p class="text-xs font-bold text-neoMuted uppercase tracking-wide mt-1">
                Select a workspace from saved records only.
              </p>
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
                {{ userSaving ? 'Saving...' : 'Save User' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </div>
</template>
