<script setup>
import { ref, computed } from 'vue'

// ── Active Tab ──────────────────────────────────────────────────────────────
const activeTab = ref('workspaces') // 'workspaces' | 'directory'

// ═══════════════════════════════════════════════════════════════════════════
// MOCK STATE
// ═══════════════════════════════════════════════════════════════════════════

// ── Workspaces ──────────────────────────────────────────────────────────────
const workspaces = ref([
  { id: 1, name: 'iReply Services',  memberCount: 5, status: 'active',   color: 'neoIndigo' },
  { id: 2, name: 'SkyNet Ops',       memberCount: 3, status: 'active',   color: 'neoYellow' },
  { id: 3, name: 'DevOps Pipeline',  memberCount: 2, status: 'archived', color: 'neoPink'   },
])
let nextWsId = 4

// ── Users (with workspaceIds[]) ─────────────────────────────────────────────
const users = ref([
  { id: 1, name: 'John Doe',      email: 'john@workforce.io',  globalRole: 'admin', workspaceIds: [1, 2] },
  { id: 2, name: 'Jane Smith',    email: 'jane@workforce.io',  globalRole: 'user',  workspaceIds: [1]    },
  { id: 3, name: 'Alex Rivera',   email: 'alex@workforce.io',  globalRole: 'user',  workspaceIds: [2]    },
  { id: 4, name: 'Sam Wilson',    email: 'sam@workforce.io',   globalRole: 'user',  workspaceIds: [3]    },
  { id: 5, name: 'Mia Chen',      email: 'mia@workforce.io',   globalRole: 'user',  workspaceIds: [1, 3] },
  { id: 6, name: 'Raj Patel',     email: 'raj@workforce.io',   globalRole: 'user',  workspaceIds: []     }, // UNASSIGNED
  { id: 7, name: 'Leila Nasser',  email: 'leila@workforce.io', globalRole: 'user',  workspaceIds: []     }, // UNASSIGNED
])
let nextUserId = 8

// ═══════════════════════════════════════════════════════════════════════════
// COMPUTED
// ═══════════════════════════════════════════════════════════════════════════

const hasNoWorkspaces = computed(() => workspaces.value.length === 0)

// Users assigned to a given workspace id
const getUsersInWorkspace = (wsId) =>
  users.value.filter(u => u.workspaceIds.includes(wsId))

// Unassigned users (no workspaces at all)
const unassignedUsers = computed(() =>
  users.value.filter(u => u.workspaceIds.length === 0)
)

// Users NOT yet in the selected drawer workspace
const usersNotInDrawerWs = computed(() => {
  if (!drawerWorkspace.value) return []
  return users.value.filter(u => !u.workspaceIds.includes(drawerWorkspace.value.id))
})

// Workspace name(s) for a user
const getWorkspaceNames = (workspaceIds) => {
  if (!workspaceIds.length) return []
  return workspaceIds
    .map(id => workspaces.value.find(w => w.id === id)?.name)
    .filter(Boolean)
}

// Initials for workspace icon
const getWsInitials = (name) =>
  name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)

// Color map to Tailwind bg classes
const colorBg = {
  neoIndigo: 'bg-neoIndigo',
  neoYellow: 'bg-neoYellow',
  neoPink:   'bg-neoPink',
  neoMint:   'bg-neoMint',
}
const wsColors = ['neoIndigo', 'neoYellow', 'neoPink', 'neoMint']

// ═══════════════════════════════════════════════════════════════════════════
// WORKSPACE SLIDE-OUT DRAWER
// ═══════════════════════════════════════════════════════════════════════════

const drawerOpen     = ref(false)
const drawerWorkspace = ref(null)

const openDrawer = (ws) => {
  drawerWorkspace.value = ws
  drawerOpen.value = true
}

const closeDrawer = () => {
  drawerOpen.value = false
  setTimeout(() => { drawerWorkspace.value = null }, 300) // after animation
}

// Remove a member from the drawer workspace
const removeMemberFromWs = (user) => {
  user.workspaceIds = user.workspaceIds.filter(id => id !== drawerWorkspace.value.id)
  drawerWorkspace.value.memberCount = getUsersInWorkspace(drawerWorkspace.value.id).length
}

// Archive / Delete workspace
const archiveWorkspace = (ws) => {
  ws.status = ws.status === 'active' ? 'archived' : 'active'
}

const deleteWorkspace = (ws) => {
  // Remove from all users first
  users.value.forEach(u => {
    u.workspaceIds = u.workspaceIds.filter(id => id !== ws.id)
  })
  workspaces.value = workspaces.value.filter(w => w.id !== ws.id)
  closeDrawer()
}

// ── Add Member to Drawer Workspace ──────────────────────────────────────────
const showAddMemberModal = ref(false)
const selectedAddUserId  = ref('')

const openAddMemberModal = () => {
  selectedAddUserId.value = ''
  showAddMemberModal.value = true
}

const closeAddMemberModal = () => {
  showAddMemberModal.value = false
}

const confirmAddMember = () => {
  const uid = parseInt(selectedAddUserId.value)
  if (!uid || !drawerWorkspace.value) return
  const user = users.value.find(u => u.id === uid)
  if (user && !user.workspaceIds.includes(drawerWorkspace.value.id)) {
    user.workspaceIds.push(drawerWorkspace.value.id)
    drawerWorkspace.value.memberCount = getUsersInWorkspace(drawerWorkspace.value.id).length
  }
  closeAddMemberModal()
}

// ═══════════════════════════════════════════════════════════════════════════
// CREATE WORKSPACE MODAL
// ═══════════════════════════════════════════════════════════════════════════

const showWsModal = ref(false)
const newWsName   = ref('')

const openWsModal  = () => { newWsName.value = ''; showWsModal.value = true }
const closeWsModal = () => { showWsModal.value = false }

const createWorkspace = () => {
  if (!newWsName.value.trim()) return
  workspaces.value.push({
    id: nextWsId++,
    name: newWsName.value.trim(),
    memberCount: 0,
    status: 'active',
    color: wsColors[Math.floor(Math.random() * wsColors.length)],
  })
  closeWsModal()
}

// ═══════════════════════════════════════════════════════════════════════════
// CREATE USER ACCOUNT MODAL  (Internal Tool — Admin creates accounts directly)
// ═══════════════════════════════════════════════════════════════════════════

const showInviteModal = ref(false)
const inviteForm = ref({ name: '', email: '', tempPassword: '', globalRole: 'user', workspaceId: '' })

const openInviteModal  = () => {
  inviteForm.value = { name: '', email: '', tempPassword: '', globalRole: 'user', workspaceId: workspaces.value[0]?.id ?? '' }
  showInviteModal.value = true
}
const closeInviteModal = () => { showInviteModal.value = false }

const createUserAccount = () => {
  const { name, email, tempPassword, globalRole, workspaceId } = inviteForm.value
  if (!name.trim() || !email.trim() || !tempPassword.trim() || !workspaceId) return
  const newUser = {
    id: nextUserId++,
    name: name.trim(),
    email: email.trim(),
    globalRole,
    workspaceIds: [parseInt(workspaceId)],
  }
  users.value.push(newUser)
  // bump member count
  const ws = workspaces.value.find(w => w.id === parseInt(workspaceId))
  if (ws) ws.memberCount++
  closeInviteModal()
}
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
        id="tab-workspaces"
        :class="['neo-tab', activeTab === 'workspaces' ? 'active' : '']"
        @click="activeTab = 'workspaces'"
      >
        Workspaces
      </button>
      <button
        id="tab-directory"
        :class="['neo-tab', activeTab === 'directory' ? 'active' : '']"
        @click="activeTab = 'directory'"
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
          {{ workspaces.length }} WORKSPACE{{ workspaces.length !== 1 ? 'S' : '' }}
        </span>
        <button
          id="add-workspace-btn"
          @click="openWsModal"
          class="flex items-center gap-2 px-5 py-2.5 bg-ink text-neoCard brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer"
        >
          + ADD WORKSPACE
        </button>
      </div>

      <!-- Workspace Grid (click card → open drawer) -->
      <div v-if="workspaces.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="ws in workspaces"
          :key="ws.id"
          class="workspace-card cursor-pointer"
          @click="openDrawer(ws)"
        >
          <!-- Color icon -->
          <div
            :class="[colorBg[ws.color] ?? 'bg-neoMint', 'ws-icon text-ink']"
          >
            {{ getWsInitials(ws.name) }}
          </div>

          <!-- Info -->
          <div class="ws-info">
            <div class="ws-name">{{ ws.name }}</div>
            <div class="ws-meta">
              {{ getUsersInWorkspace(ws.id).length }} member{{ getUsersInWorkspace(ws.id).length !== 1 ? 's' : '' }}
              &nbsp;·&nbsp;{{ ws.status }}
            </div>
          </div>

          <!-- Status badge -->
          <span :class="ws.status === 'active' ? 'badge-low' : 'badge-high'">
            {{ ws.status.toUpperCase() }}
          </span>
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
          @click="openWsModal"
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
          {{ users.length }} USER{{ users.length !== 1 ? 'S' : '' }}
        </span>

        <!-- Only show create user button when workspaces exist -->
        <button
          v-if="!hasNoWorkspaces"
          id="create-user-btn"
          @click="openInviteModal"
          class="flex items-center gap-2 px-5 py-2.5 bg-ink text-neoCard brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer"
        >
          + CREATE USER ACCOUNT
        </button>
      </div>

      <!-- Empty-state chicken-or-egg warning when no workspaces exist -->
      <div
        v-if="hasNoWorkspaces"
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
            @click="activeTab = 'workspaces'; openWsModal()"
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
              <th>Global Role</th>
              <th>Assigned Workspaces</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <!-- Name -->
              <td>
                <div class="flex items-center gap-3">
                  <!-- Avatar initials -->
                  <div
                    class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-neoIndigo/20 brut-border font-black text-xs text-ink"
                  >
                    {{ user.name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0,2) }}
                  </div>
                  <span class="font-bold text-ink">{{ user.name }}</span>
                </div>
              </td>

              <!-- Email -->
              <td class="text-neoMuted">{{ user.email }}</td>

              <!-- Global Role -->
              <td>
                <span :class="user.globalRole === 'admin' ? 'badge-admin' : 'badge-user'">
                  {{ user.globalRole.toUpperCase() }}
                </span>
              </td>

              <!-- Assigned Workspaces -->
              <td>
                <!-- UNASSIGNED badge -->
                <span
                  v-if="user.workspaceIds.length === 0"
                  class="inline-flex items-center px-2 py-0.5 bg-neoYellow border-2 border-ink font-black text-xs uppercase tracking-widest text-ink"
                >
                  UNASSIGNED
                </span>

                <!-- Workspace pills -->
                <div v-else class="flex flex-wrap gap-1.5">
                  <span
                    v-for="name in getWorkspaceNames(user.workspaceIds)"
                    :key="name"
                    class="inline-flex items-center px-2 py-0.5 bg-neoMint/30 border border-neoBorder font-bold text-xs text-ink"
                  >
                    {{ name }}
                  </span>
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
              :class="[colorBg[drawerWorkspace.color] ?? 'bg-neoMint', 'w-10 h-10 flex items-center justify-center font-black text-sm text-ink brut-border flex-shrink-0']"
            >
              {{ getWsInitials(drawerWorkspace.name) }}
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
            @click="archiveWorkspace(drawerWorkspace)"
            class="flex-1 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoYellow/40 hover:bg-neoYellow brut-hover cursor-pointer transition-colors"
          >
            {{ drawerWorkspace.status === 'active' ? '📦 Archive' : '♻ Unarchive' }}
          </button>
          <button
            @click="deleteWorkspace(drawerWorkspace)"
            class="flex-1 py-2 border-2 border-black font-black text-xs uppercase tracking-wide text-black bg-rose-500 hover:bg-rose-600 brut-hover cursor-pointer transition-colors"
          >
            🗑 Delete
          </button>
        </div>

        <!-- Drawer Body — Members List -->
        <div class="flex-1 overflow-y-auto p-4 space-y-3">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-black uppercase tracking-wider text-neoMuted">
              Members ({{ getUsersInWorkspace(drawerWorkspace.id).length }})
            </span>
            <button
              id="add-member-btn"
              @click="openAddMemberModal"
              class="flex items-center gap-1 px-3 py-1.5 bg-ink text-neoCard brut-border font-black text-xs uppercase tracking-wide brut-hover cursor-pointer"
            >
              + Add Member
            </button>
          </div>

          <!-- Empty member state -->
          <div
            v-if="getUsersInWorkspace(drawerWorkspace.id).length === 0"
            class="p-6 brut-border border-dashed flex flex-col items-center text-center gap-2"
          >
            <span class="text-2xl">👥</span>
            <p class="text-xs font-black uppercase tracking-wide text-neoMuted">
              No members yet. Add someone above.
            </p>
          </div>

          <!-- Member rows -->
          <div
            v-for="member in getUsersInWorkspace(drawerWorkspace.id)"
            :key="member.id"
            class="flex items-center justify-between p-3 brut-border bg-neoBg/40 hover:bg-neoYellow/10 transition-colors"
          >
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-neoMint/30 brut-border font-black text-xs text-ink">
                {{ member.name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0,2) }}
              </div>
              <div>
                <p class="text-sm font-bold text-ink">{{ member.name }}</p>
                <p class="text-xs text-neoMuted">{{ member.email }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span :class="member.globalRole === 'admin' ? 'badge-admin' : 'badge-user'">
                {{ member.globalRole.toUpperCase() }}
              </span>
              <button
                @click="removeMemberFromWs(member)"
                class="w-6 h-6 flex items-center justify-center brut-border font-black text-xs text-neoMuted hover:text-destructive hover:border-destructive hover:bg-destructive/10 transition-colors cursor-pointer"
                title="Remove from workspace"
              >✕</button>
            </div>
          </div>
        </div>
      </div>
    </transition>

    </Teleport>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- MODAL — Add Member to Workspace                                     -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">
    <transition name="modal">
      <div
        v-if="showAddMemberModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        @click.self="closeAddMemberModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-sm mx-4" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-base font-black uppercase tracking-wide text-ink">Add Member</h2>
            <button
              @click="closeAddMemberModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <div class="p-5 space-y-3">
            <p class="text-xs font-bold text-neoMuted">
              Add an existing user to
              <span class="font-black text-ink">{{ drawerWorkspace?.name }}</span>
            </p>
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                Select User *
              </label>
              <select v-model="selectedAddUserId" class="neo-select w-full" required>
                <option value="" disabled>— pick a user —</option>
                <option
                  v-for="u in usersNotInDrawerWs"
                  :key="u.id"
                  :value="u.id"
                >
                  {{ u.name }} ({{ u.email }})
                </option>
              </select>
              <p
                v-if="usersNotInDrawerWs.length === 0"
                class="mt-2 text-xs font-bold text-neoMuted"
              >
                All users are already in this workspace.
              </p>
            </div>
          </div>
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              @click="closeAddMemberModal"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >Cancel</button>
            <button
              @click="confirmAddMember"
              :disabled="!selectedAddUserId"
              class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-neoCard bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
            >Add Member</button>
          </div>
        </div>
      </div>
    </transition>
    </Teleport>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- MODAL — Create Workspace                                            -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">
    <transition name="modal">
      <div
        v-if="showWsModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        @click.self="closeWsModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-md mx-4" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">New Workspace</h2>
            <button
              @click="closeWsModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <div class="p-5 space-y-4">
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                Workspace Name *
              </label>
              <input
                v-model="newWsName"
                type="text"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="e.g. Marketing Hub"
                @keyup.enter="createWorkspace"
              />
            </div>
          </div>
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              @click="closeWsModal"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >Cancel</button>
            <button
              @click="createWorkspace"
              :disabled="!newWsName.trim()"
              class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-neoCard bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
            >Create</button>
          </div>
        </div>
      </div>
    </transition>
    </Teleport>

    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <!-- MODAL — Create User Account (Internal Tool)                         -->
    <!-- ═══════════════════════════════════════════════════════════════════ -->
    <Teleport to="body">
    <transition name="modal">
      <div
        v-if="showInviteModal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        @click.self="closeInviteModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-lg mx-4" @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <div>
              <h2 class="text-lg font-black uppercase tracking-wide text-ink">Create User Account</h2>
              <p class="text-[0.6rem] font-black uppercase tracking-widest text-neoMuted mt-0.5">Internal Tool — Admin Access Only</p>
            </div>
            <button
              @click="closeInviteModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>

          <!-- Body -->
          <div class="p-5 space-y-4">
            <!-- Name -->
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                Full Name *
              </label>
              <input
                v-model="inviteForm.name"
                type="text"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="Enter full name"
              />
            </div>

            <!-- Email -->
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                Email *
              </label>
              <input
                v-model="inviteForm.email"
                type="email"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="name@company.io"
              />
            </div>

            <!-- Temporary Password (type=text so Admin can read it to share) -->
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                Temporary Password *
              </label>
              <input
                v-model="inviteForm.tempPassword"
                type="text"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm font-mono focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="e.g. Welcome2024!"
                autocomplete="off"
              />
              <p class="mt-1 text-[0.6rem] font-bold text-neoMuted uppercase tracking-wide">
                Share this password with the user via Slack or internal messaging.
              </p>
            </div>

            <!-- Role + Workspace (required) in 2-col grid -->
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                  Global Role
                </label>
                <select v-model="inviteForm.globalRole" class="neo-select w-full">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
              <div>
                <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
                  Workspace <span class="text-destructive">*</span>
                </label>
                <select v-model="inviteForm.workspaceId" class="neo-select w-full" required>
                  <option value="" disabled>— select one —</option>
                  <option
                    v-for="ws in workspaces"
                    :key="ws.id"
                    :value="ws.id"
                  >
                    {{ ws.name }}
                  </option>
                </select>
              </div>
            </div>

            <!-- Hint banner -->
            <div class="bg-neoYellow/20 brut-border p-3 flex items-start gap-2">
              <span class="text-sm flex-shrink-0">⚠</span>
              <p class="text-xs font-bold text-ink">
                Users <span class="font-black uppercase">must</span> be assigned to a workspace before they can access any project data.
              </p>
            </div>
          </div>

          <!-- Footer -->
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              @click="closeInviteModal"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >Cancel</button>
            <button
              @click="createUserAccount"
              :disabled="!inviteForm.name.trim() || !inviteForm.email.trim() || !inviteForm.tempPassword.trim() || !inviteForm.workspaceId"
              class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-neoCard bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
            >
              Create Account
            </button>
          </div>
        </div>
      </div>
    </transition>
    </Teleport>

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
