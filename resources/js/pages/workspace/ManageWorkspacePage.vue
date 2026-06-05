<script setup>
import { ref, computed } from 'vue'

// ── Active Tab ──
const activeTab = ref('workspaces') // 'workspaces' | 'directory'

// ── Workspaces Mock Data ──
const workspaces = ref([
  { id: 1, name: 'iReply Services', members: 5, status: 'active', color: 'bg-neoIndigo' },
  { id: 2, name: 'SkyNet Ops', members: 3, status: 'active', color: 'bg-neoYellow' },
  { id: 3, name: 'DevOps Pipeline', members: 2, status: 'archived', color: 'bg-neoPink' }
])

let nextWsId = 4

// ── User Directory Mock Data ──
const directoryMembers = ref([
  { id: 1, name: 'John Doe', email: 'john@workforce.io', role: 'admin', team: 'Engineering', workspace: 'iReply Services' },
  { id: 2, name: 'Jane Smith', email: 'jane@workforce.io', role: 'user', team: 'Design', workspace: 'iReply Services' },
  { id: 3, name: 'Alex Rivera', email: 'alex@workforce.io', role: 'user', team: 'Engineering', workspace: 'SkyNet Ops' },
  { id: 4, name: 'Sam Wilson', email: 'sam@workforce.io', role: 'user', team: 'Design', workspace: 'SkyNet Ops' },
  { id: 5, name: 'Mia Chen', email: 'mia@workforce.io', role: 'user', team: 'Engineering', workspace: 'iReply Services' }
])

let nextMemberId = 6

const availableTeams = ['Engineering', 'Design', 'Marketing', 'Operations']

// ── Workspace Modal ──
const showWsModal = ref(false)
const newWsName = ref('')

const openWsModal = () => {
  newWsName.value = ''
  showWsModal.value = true
}

const closeWsModal = () => {
  showWsModal.value = false
}

const createWorkspace = () => {
  if (!newWsName.value.trim()) return
  const colors = ['bg-neoIndigo', 'bg-neoYellow', 'bg-neoPink', 'bg-neoMint']
  workspaces.value.push({
    id: nextWsId++,
    name: newWsName.value.trim(),
    members: 0,
    status: 'active',
    color: colors[Math.floor(Math.random() * colors.length)]
  })
  closeWsModal()
}

const getWsInitials = (name) => {
  return name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}

// ── Invite Member Modal ──
const showInviteModal = ref(false)
const inviteForm = ref({ name: '', email: '', role: 'user', team: 'Engineering' })

const openInviteModal = () => {
  inviteForm.value = { name: '', email: '', role: 'user', team: 'Engineering' }
  showInviteModal.value = true
}

const closeInviteModal = () => {
  showInviteModal.value = false
}

const createMember = () => {
  if (!inviteForm.value.name.trim() || !inviteForm.value.email.trim()) return
  directoryMembers.value.push({
    id: nextMemberId++,
    name: inviteForm.value.name.trim(),
    email: inviteForm.value.email.trim(),
    role: inviteForm.value.role,
    team: inviteForm.value.team,
    workspace: 'Unassigned'
  })
  closeInviteModal()
}

// ── Add Member to Workspace ──
const showAssignWsModal = ref(false)
const assigningMember = ref(null)
const selectedWorkspace = ref('')

const openAssignWsModal = (member) => {
  assigningMember.value = member
  selectedWorkspace.value = member.workspace
  showAssignWsModal.value = true
}

const closeAssignWsModal = () => {
  showAssignWsModal.value = false
  assigningMember.value = null
}

const assignToWorkspace = () => {
  if (assigningMember.value && selectedWorkspace.value) {
    assigningMember.value.workspace = selectedWorkspace.value
  }
  closeAssignWsModal()
}

// ── Change Team ──
const showChangeTeamModal = ref(false)
const changingMember = ref(null)
const selectedTeam = ref('')

const openChangeTeamModal = (member) => {
  changingMember.value = member
  selectedTeam.value = member.team
  showChangeTeamModal.value = true
}

const closeChangeTeamModal = () => {
  showChangeTeamModal.value = false
  changingMember.value = null
}

const changeTeam = () => {
  if (changingMember.value && selectedTeam.value) {
    changingMember.value.team = selectedTeam.value
  }
  closeChangeTeamModal()
}
</script>

<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-3xl font-black text-ink mb-1">Manage Workspace</h1>
        <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">Administer workspaces, teams, and member access.</p>
      </div>
    </div>

    <!-- Tab Bar -->
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

    <!-- ═══════════════════════════════════════════ -->
    <!-- TAB A: WORKSPACES LIST                      -->
    <!-- ═══════════════════════════════════════════ -->
    <div v-if="activeTab === 'workspaces'" class="space-y-4">
      <!-- Actions -->
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">{{ workspaces.length }} WORKSPACES</span>
        <button
          id="add-workspace-btn"
          @click="openWsModal"
          class="flex items-center gap-2 px-5 py-2.5 bg-ink text-white brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer"
          style="border-color: var(--border-color);"
        >
          + ADD WORKSPACE
        </button>
      </div>

      <!-- Workspace Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="ws in workspaces"
          :key="ws.id"
          class="workspace-card"
        >
          <div :class="['ws-icon', ws.color, 'text-ink']">
            {{ getWsInitials(ws.name) }}
          </div>
          <div class="ws-info">
            <div class="ws-name">{{ ws.name }}</div>
            <div class="ws-meta">{{ ws.members }} members · {{ ws.status }}</div>
          </div>
          <span
            :class="ws.status === 'active' ? 'badge-low' : 'badge-high'"
          >
            {{ ws.status.toUpperCase() }}
          </span>
        </div>
      </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- TAB B: USER DIRECTORY                       -->
    <!-- ═══════════════════════════════════════════ -->
    <div v-if="activeTab === 'directory'" class="space-y-4">
      <!-- Actions -->
      <div class="flex items-center justify-between">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">{{ directoryMembers.length }} MEMBERS</span>
        <button
          id="invite-member-btn"
          @click="openInviteModal"
          class="flex items-center gap-2 px-5 py-2.5 bg-ink text-white brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer"
          style="border-color: var(--border-color);"
        >
          + CREATE ACCOUNT / INVITE
        </button>
      </div>

      <!-- Members Table -->
      <div class="brut-border brut-shadow bg-neoCard overflow-x-auto">
        <table class="neo-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Team</th>
              <th>Workspace</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="member in directoryMembers" :key="member.id">
              <td class="font-bold">{{ member.name }}</td>
              <td class="text-neoMuted">{{ member.email }}</td>
              <td>
                <span :class="member.role === 'admin' ? 'badge-admin' : 'badge-user'">
                  {{ member.role.toUpperCase() }}
                </span>
              </td>
              <td>{{ member.team }}</td>
              <td>{{ member.workspace }}</td>
              <td class="text-right">
                <div class="flex items-center justify-end gap-1.5">
                  <button class="neo-action-btn" @click="openAssignWsModal(member)">
                    ADD TO WS
                  </button>
                  <button class="neo-action-btn" @click="openChangeTeamModal(member)">
                    CHANGE TEAM
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- MODAL: Add Workspace                        -->
    <!-- ═══════════════════════════════════════════ -->
    <transition name="modal">
      <div
        v-if="showWsModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
        @click.self="closeWsModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-md mx-4" @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">New Workspace</h2>
            <button
              @click="closeWsModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <!-- Body -->
          <div class="p-5 space-y-4">
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Workspace Name *</label>
              <input
                v-model="newWsName"
                type="text"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="Enter workspace name"
                @keyup.enter="createWorkspace"
              />
            </div>
          </div>
          <!-- Footer -->
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              @click="closeWsModal"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >Cancel</button>
            <button
              @click="createWorkspace"
              class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
            >Create</button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ═══════════════════════════════════════════ -->
    <!-- MODAL: Invite Member                        -->
    <!-- ═══════════════════════════════════════════ -->
    <transition name="modal">
      <div
        v-if="showInviteModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
        @click.self="closeInviteModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-lg mx-4" @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">Invite Member</h2>
            <button
              @click="closeInviteModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <!-- Body -->
          <div class="p-5 space-y-4">
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Full Name *</label>
              <input
                v-model="inviteForm.name"
                type="text"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="Enter full name"
              />
            </div>
            <div>
              <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Email *</label>
              <input
                v-model="inviteForm.email"
                type="email"
                class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
                placeholder="name@company.io"
              />
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Role</label>
                <select
                  v-model="inviteForm.role"
                  class="neo-select w-full"
                >
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
              <div>
                <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Team</label>
                <select
                  v-model="inviteForm.team"
                  class="neo-select w-full"
                >
                  <option v-for="t in availableTeams" :key="t" :value="t">{{ t }}</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Footer -->
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              @click="closeInviteModal"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >Cancel</button>
            <button
              @click="createMember"
              class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
            >Invite Member</button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ═══════════════════════════════════════════ -->
    <!-- MODAL: Assign to Workspace                  -->
    <!-- ═══════════════════════════════════════════ -->
    <transition name="modal">
      <div
        v-if="showAssignWsModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
        @click.self="closeAssignWsModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-sm mx-4" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-sm font-black uppercase tracking-wide text-ink">Assign to Workspace</h2>
            <button
              @click="closeAssignWsModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <div class="p-5 space-y-3">
            <p class="text-xs font-bold text-neoMuted">
              Assigning <span class="text-ink font-black">{{ assigningMember?.name }}</span>
            </p>
            <select v-model="selectedWorkspace" class="neo-select w-full">
              <option v-for="ws in workspaces" :key="ws.id" :value="ws.name">{{ ws.name }}</option>
            </select>
          </div>
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button @click="closeAssignWsModal" class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30">Cancel</button>
            <button @click="assignToWorkspace" class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer">Assign</button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ═══════════════════════════════════════════ -->
    <!-- MODAL: Change Team                          -->
    <!-- ═══════════════════════════════════════════ -->
    <transition name="modal">
      <div
        v-if="showChangeTeamModal"
        class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
        @click.self="closeChangeTeamModal"
      >
        <div class="bg-neoCard brut-border brut-shadow w-full max-w-sm mx-4" @click.stop>
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <h2 class="text-sm font-black uppercase tracking-wide text-ink">Change Team</h2>
            <button
              @click="closeChangeTeamModal"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
          <div class="p-5 space-y-3">
            <p class="text-xs font-bold text-neoMuted">
              Reassigning <span class="text-ink font-black">{{ changingMember?.name }}</span>
            </p>
            <select v-model="selectedTeam" class="neo-select w-full">
              <option v-for="t in availableTeams" :key="t" :value="t">{{ t }}</option>
            </select>
          </div>
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button @click="closeChangeTeamModal" class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30">Cancel</button>
            <button @click="changeTeam" class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer">Save</button>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>
