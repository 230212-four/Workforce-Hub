<script setup>
import { computed, ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '../../composables/useAuth'
import { useTaskStore } from '../../composables/useTaskStore'
import { useToast } from '../../composables/useToast'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close'])

const router = useRouter()
const { currentUser, isAdmin, switchWorkspace } = useAuth()
const { workspaces, loadWorkspaces, isLoadingWorkspaces } = useTaskStore()
const { addToast } = useToast()

const selectedWorkspaceId = ref('')
const error = ref('')
const isSaving = ref(false)

const workspaceList = computed(() =>
  [...workspaces.value].sort((left, right) => left.name.localeCompare(right.name))
)

const currentWorkspaceName = computed(() => currentUser.value.workspace?.name || 'No workspace assigned')

function setInitialSelection() {
  const currentId = currentUser.value.workspace?.id
  selectedWorkspaceId.value = currentId ? String(currentId) : ''

  if (!selectedWorkspaceId.value) {
    const firstActiveWorkspace = workspaceList.value.find(workspace => workspace.status === 'active') || workspaceList.value[0]
    selectedWorkspaceId.value = firstActiveWorkspace ? String(firstActiveWorkspace.id) : ''
  }
}

async function prepareModal() {
  if (!isAdmin.value) return

  error.value = ''
  await loadWorkspaces()
  setInitialSelection()
}

watch(
  () => props.isOpen,
  async (isOpen) => {
    if (isOpen) {
      await prepareModal()
    } else {
      error.value = ''
      isSaving.value = false
    }
  }
)

function close() {
  error.value = ''
  isSaving.value = false
  emit('close')
}

async function openWorkspaceManager() {
  close()
  await router.push('/workspace')
}

async function handleSwitchWorkspace() {
  if (!selectedWorkspaceId.value) {
    error.value = 'Choose a workspace first.'
    return
  }

  isSaving.value = true
  error.value = ''

  try {
    await switchWorkspace(Number(selectedWorkspaceId.value))
    addToast({ message: 'Workspace switched.', type: 'success' })
    close()
  } catch (switchError) {
    error.value = switchError?.response?.data?.message || 'Unable to switch workspaces.'
  } finally {
    isSaving.value = false
  }
}
</script>

<template>
  <transition name="modal">
    <div
      v-if="isOpen"
      class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm"
      @click.self="close"
    >
      <div class="bg-neoCard w-full max-w-lg mx-4 brut-border brut-shadow" @click.stop>
        <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
          <div>
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">Switch Workspace</h2>
            <p class="text-[0.6rem] font-black uppercase tracking-widest text-neoMuted mt-0.5">
              Admin workspace context
            </p>
          </div>
          <button
            @click="close"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
          >
            ✕
          </button>
        </div>

        <div class="p-5 space-y-4">
          <div class="bg-neoYellow/20 brut-border p-3">
            <p class="text-xs font-bold text-ink">
              Current workspace:
              <span class="font-black uppercase">{{ currentWorkspaceName }}</span>
            </p>
            <p class="mt-1 text-[0.65rem] font-bold uppercase tracking-wide text-neoMuted">
              Switching updates your admin workspace context for navigation and task defaults.
            </p>
          </div>

          <div v-if="workspaceList.length === 0" class="brut-border bg-neoCard p-4">
            <p class="text-xs font-black uppercase tracking-wide text-ink">
              No workspaces available yet.
            </p>
            <p class="mt-1 text-[0.65rem] font-bold uppercase tracking-wide text-neoMuted">
              Create a workspace first, then come back to switch into it.
            </p>
          </div>

          <div v-else class="space-y-2">
            <label class="block text-xs font-black uppercase tracking-wide text-ink">
              Workspace
            </label>
            <select
              v-model="selectedWorkspaceId"
              class="neo-select w-full"
              :disabled="isLoadingWorkspaces || isSaving"
            >
              <option value="" disabled>Select Workspace</option>
              <option
                v-for="workspace in workspaceList"
                :key="workspace.id"
                :value="String(workspace.id)"
              >
                {{ workspace.name }}{{ workspace.status === 'archived' ? ' (Archived)' : '' }}
              </option>
            </select>
            <p class="text-[0.65rem] font-bold uppercase tracking-wide text-neoMuted">
              Pick the workspace you want your admin account to act from.
            </p>
          </div>

          <p v-if="error" class="text-sm font-medium text-red-600 bg-red-50 border-[3px] border-red-600 px-4 py-3">
            {{ error }}
          </p>
        </div>

        <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
          <button
            type="button"
            class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            @click="close"
          >
            Cancel
          </button>
          <button
            type="button"
            class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
            :disabled="!workspaceList.length || !selectedWorkspaceId || isSaving || isLoadingWorkspaces"
            @click="handleSwitchWorkspace"
          >
            {{ isSaving ? 'Switching...' : 'Switch Workspace' }}
          </button>
          <button
            v-if="workspaceList.length > 0"
            type="button"
            class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoYellow/40"
            @click="openWorkspaceManager"
          >
            Manage Workspaces
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>
