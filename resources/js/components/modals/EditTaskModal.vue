<script setup>
import { computed, ref, watch } from 'vue'
import { useAuth } from '../../composables/useAuth'
import { useTaskStore } from '../../composables/useTaskStore'

const props = defineProps({
  isOpen: { type: Boolean, default: false },
  task: { type: Object, default: null }
})

const emit = defineEmits(['close', 'save'])

const { isAdmin } = useAuth()
const { loadUsers, getCurrentWorkspaceId, getWorkspaceUsers } = useTaskStore()

const formData = ref({
  id: '',
  title: '',
  description: '',
  status: 'todo',
  priority: 'medium',
  dueDate: '',
  workspaceId: null,
  assigneeIds: []
})

const selectedAssigneeId = ref('')

const priorities = [
  { value: 'low', label: 'LOW', activeClass: 'bg-neoMint' },
  { value: 'medium', label: 'MEDIUM', activeClass: 'bg-neoYellow' },
  { value: 'high', label: 'HIGH', activeClass: 'bg-neoPink' }
]

const statuses = [
  { value: 'todo', label: 'TO DO' },
  { value: 'in-progress', label: 'IN PROGRESS' },
  { value: 'review', label: 'REVIEW' },
  { value: 'done', label: 'DONE' }
]

const workspaceId = computed(() => formData.value.workspaceId || getCurrentWorkspaceId())
const availableUsers = computed(() => getWorkspaceUsers(workspaceId.value))
const selectedAssignees = computed(() => {
  return availableUsers.value.filter(user => formData.value.assigneeIds.includes(user.id))
})

watch(() => props.task, (newTask) => {
  if (!newTask) return

  formData.value = {
    id: newTask.id,
    title: newTask.title || '',
    description: newTask.description || '',
    status: newTask.status || 'todo',
    priority: newTask.priority || 'medium',
    dueDate: newTask.dueDate || '',
    workspaceId: newTask.workspaceId || newTask.workspace_id || null,
    assigneeIds: newTask.assignedUsers?.length
      ? newTask.assignedUsers.map(user => user.id)
      : (newTask.assignedUserIds || [])
  }
  selectedAssigneeId.value = ''

  if (isAdmin.value) {
    loadUsers()
  }
}, { immediate: true })

const addAssignee = () => {
  if (!selectedAssigneeId.value) return

  const userId = Number(selectedAssigneeId.value)
  if (!formData.value.assigneeIds.includes(userId)) {
    formData.value.assigneeIds.push(userId)
  }

  selectedAssigneeId.value = ''
}

const removeAssignee = (userId) => {
  formData.value.assigneeIds = formData.value.assigneeIds.filter(id => id !== userId)
}

const handleSubmit = () => {
  if (!formData.value.title.trim()) return

  emit('save', {
    ...formData.value,
    workspace_id: workspaceId.value,
    assignee_ids: isAdmin.value ? formData.value.assigneeIds : undefined,
    due_date: formData.value.dueDate
  })
}
</script>

<template>
  <transition name="modal">
    <div
      v-if="isOpen"
      class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
      @click.self="$emit('close')"
    >
      <div
        class="bg-neoCard brut-border brut-shadow w-full max-w-lg mx-4"
        @click.stop
      >
        <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
          <h2 class="text-lg font-black uppercase tracking-wide text-ink">Edit Task</h2>
          <button
            @click="$emit('close')"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
          >
            X
          </button>
        </div>

        <form @submit.prevent="handleSubmit" class="p-5 space-y-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Task Title *</label>
            <input
              v-model="formData.title"
              type="text"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              placeholder="Enter task title"
              required
            />
          </div>

          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Description</label>
            <textarea
              v-model="formData.description"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)] resize-none"
              placeholder="Enter task description"
              rows="3"
            />
          </div>

          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-2">Priority</label>
            <div class="flex gap-2">
              <button
                v-for="p in priorities"
                :key="p.value"
                type="button"
                @click="formData.priority = p.value"
                :class="[
                  'flex-1 px-3 py-2 brut-border font-black text-xs uppercase tracking-wide transition-all cursor-pointer',
                  formData.priority === p.value
                    ? p.activeClass + ' brut-shadow-sm text-ink'
                    : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                ]"
              >
                {{ p.label }}
              </button>
            </div>
          </div>

          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-2">Status</label>
            <div class="flex gap-2">
              <button
                v-for="s in statuses"
                :key="s.value"
                type="button"
                @click="formData.status = s.value"
                :class="[
                  'flex-1 px-2 py-2 brut-border font-black text-[0.6rem] uppercase tracking-wide transition-all cursor-pointer',
                  formData.status === s.value
                    ? 'bg-ink text-white brut-shadow-sm'
                    : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                ]"
              >
                {{ s.label }}
              </button>
            </div>
          </div>

          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Due Date</label>
            <input
              v-model="formData.dueDate"
              type="date"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
            />
          </div>

          <div v-if="isAdmin">
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Assignees</label>
            <div class="flex items-center gap-2">
              <select
                v-model="selectedAssigneeId"
                class="neo-select w-full"
              >
                <option value="">Add a Member</option>
                <option v-for="user in availableUsers" :key="user.id" :value="user.id">
                  {{ user.name }}
                </option>
              </select>
              <button
                type="button"
                class="w-10 h-10 brut-border bg-neoCard font-black text-ink brut-hover"
                @click="addAssignee"
                aria-label="Add assignee"
              >
                +
              </button>
            </div>

            <div class="mt-3 flex flex-wrap gap-2">
              <span
                v-if="selectedAssignees.length === 0"
                class="text-xs font-black uppercase tracking-wide text-neoMuted"
              >
                Add a Member
              </span>
              <button
                v-for="user in selectedAssignees"
                :key="user.id"
                type="button"
                class="px-3 py-2 brut-border bg-neoCard font-black text-xs uppercase tracking-wide text-ink brut-hover"
                @click="removeAssignee(user.id)"
              >
                {{ user.name }} x
              </button>
            </div>
          </div>
        </form>

        <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
          <button
            @click="$emit('close')"
            class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
          >
            Cancel
          </button>
          <button
            @click="handleSubmit"
            class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>
