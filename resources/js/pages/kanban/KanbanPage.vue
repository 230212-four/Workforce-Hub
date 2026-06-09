<script setup>
import { ref, inject, computed } from 'vue'
import KanbanTaskCard from '../../components/kanban/KanbanTaskCard.vue'
import { useTaskStore } from '../../composables/useTaskStore'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'

const openCreateModal = inject('openCreateModal')
const openEditModal = inject('openEditModal')
const { addToast } = useToast()

const {
  tasks,
  moveTask,
  deleteTask,
  canEditTask,
  canDeleteTask,
  canMoveTask,
  teams,
  members,
  getFilteredColumns,
  getUserColumns
} = useTaskStore()
const { isAdmin, isAuthenticated } = useAuth()

// ── Admin filters ──
const adminTeamFilter = ref('all')
const adminUserFilter = ref('all')
const adminColumns = getFilteredColumns(adminTeamFilter, adminUserFilter)

// ── User toggle ──
const showOnlyMine = ref(false)
const userColumns = getUserColumns(showOnlyMine)

// Pick the right columns based on role
const activeColumns = computed(() => {
  return isAdmin.value ? adminColumns.value : userColumns.value
})

const hasTasks = computed(() => activeColumns.value.some(column => column.tasks.length > 0))

const dragOverColumn = ref(null)

const handleDragOver = (e, columnId) => {
  e.preventDefault()
  e.dataTransfer.dropEffect = 'move'
  dragOverColumn.value = columnId
}

const handleDragEnter = (e, columnId) => {
  e.preventDefault()
  dragOverColumn.value = columnId
}

const handleDragLeave = (e, columnId) => {
  // Only clear if we're actually leaving the column area
  const relatedTarget = e.relatedTarget
  const currentTarget = e.currentTarget
  if (currentTarget && !currentTarget.contains(relatedTarget)) {
    dragOverColumn.value = null
  }
}

const handleDrop = async (e, columnId) => {
  e.preventDefault()
  const taskId = e.dataTransfer.getData('text/plain')
  const task = tasks.value.find(item => String(item.id) === String(taskId))
  if (taskId && task && canMoveTask(task)) {
    try {
      await moveTask(task.id, columnId)
      addToast({ message: 'Task status updated.', type: 'success' })
    } catch (error) {
      addToast({ message: error?.message || 'Unable to move the task.', type: 'error' })
    }
  }
  dragOverColumn.value = null
}

const handleCardClick = (task) => {
  if (canEditTask(task)) {
    openEditModal(task)
    return
  }

  addToast({
    message: 'You can only open tasks assigned to you or created by you.',
    type: 'error'
  })
}

const handleTaskDelete = async (task) => {
  if (!canDeleteTask(task)) {
    return
  }

  if (!window.confirm(`Delete task "${task.title}"? This action cannot be undone.`)) {
    return
  }

  try {
    await deleteTask(task.id)
    addToast({ message: 'Task deleted successfully.', type: 'success' })
  } catch (error) {
    addToast({ message: error?.message || 'Unable to delete the task.', type: 'error' })
  }
}

const getColumnHeaderBg = (colId) => {
  const map = {
    'todo': 'bg-neoCard',
    'in-progress': 'bg-neoYellow',
    'review': 'bg-neoPink',
    'done': 'bg-neoMint'
  }
  return map[colId] || 'bg-neoCard'
}

const getColumnBodyBg = (colId) => {
  const map = {
    'todo': 'bg-white/50',
    'in-progress': 'bg-neoYellow/20',
    'review': 'bg-neoPink/20',
    'done': 'bg-neoMint/20'
  }
  return map[colId] || ''
}
</script>

<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-black text-ink mb-1">Kanban Board</h1>
        <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">Drag and drop tasks between columns to update status.</p>
      </div>
      <button
        v-if="isAuthenticated"
        @click="openCreateModal"
        class="flex items-center gap-2 px-5 py-2.5 bg-ink text-white brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer flex-shrink-0"
        style="border-color: var(--border-color);"
      >
        + NEW TASK
        <span class="bg-neoIndigo text-white w-5 h-5 flex items-center justify-center text-[0.6rem] font-black brut-border" style="border-color: rgba(255,255,255,0.3);">N</span>
      </button>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- ADMIN: God View Filter Bar                  -->
    <!-- ═══════════════════════════════════════════ -->
    <div v-if="isAdmin" class="neo-filter-bar">
      <svg class="w-4 h-4 text-neoMuted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
      </svg>
      <label>GOD VIEW</label>
      <span class="text-neoMuted text-xs font-bold">|</span>

      <label>Team</label>
      <select id="filter-team" v-model="adminTeamFilter" class="neo-select">
        <option value="all">All Teams</option>
        <option v-for="t in teams" :key="t.id" :value="t.name">{{ t.name }}</option>
      </select>

      <label>User</label>
      <select id="filter-user" v-model="adminUserFilter" class="neo-select">
        <option value="all">All Users</option>
        <option v-for="m in members" :key="m" :value="m">{{ m }}</option>
      </select>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- USER: Team/My Tasks Toggle                  -->
    <!-- ═══════════════════════════════════════════ -->
    <div v-else class="flex items-center gap-3">
      <svg class="w-4 h-4 text-neoMuted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />
      </svg>
      <span class="text-xs font-black uppercase tracking-wider text-neoMuted">TEAM VIEW</span>
      <div class="neo-toggle-group">
        <button
          id="toggle-all-team"
          :class="['neo-toggle-btn', !showOnlyMine ? 'active' : '']"
          @click="showOnlyMine = false"
        >
          All Team Tasks
        </button>
        <button
          id="toggle-my-tasks"
          :class="['neo-toggle-btn', showOnlyMine ? 'active' : '']"
          @click="showOnlyMine = true"
        >
          Only My Tasks
        </button>
      </div>
    </div>

    <!-- Kanban Columns
         Mobile:  horizontal scroll with snap — each column ~88vw wide
         Desktop: standard 4-column grid
    -->
    <div class="flex flex-nowrap overflow-x-auto gap-4 snap-x snap-mandatory pb-4 md:grid md:grid-cols-2 md:flex-wrap md:overflow-x-visible lg:grid-cols-4 -mx-1 px-1">
      <div v-if="!hasTasks" class="col-span-full brut-border brut-shadow bg-neoCard p-6 text-center">
        <p class="text-xs font-black uppercase tracking-wider text-neoMuted">No tasks available</p>
      </div>
      <div
        v-for="column in activeColumns"
        :key="column.id"
        class="flex flex-col flex-shrink-0 snap-start w-[88vw] md:w-auto md:flex-shrink"
      >
        <!-- Column Header -->
        <div
          :class="[
            getColumnHeaderBg(column.id),
            'brut-border brut-shadow p-3.5 mb-0 flex items-center justify-between'
          ]"
          style="border-bottom: none;"
        >
          <h2 class="text-xs font-black uppercase tracking-wider text-ink">{{ column.title }}</h2>
          <span class="bg-neoCard brut-border px-2 py-0.5 font-black text-ink text-[0.65rem]">
            {{ column.tasks.length }}
          </span>
        </div>

        <!-- Column Body (Drop Zone) -->
        <div
          :class="[
            'kanban-column-drop brut-border p-3 space-y-3 flex-1',
            getColumnBodyBg(column.id),
            dragOverColumn === column.id ? 'drag-over' : ''
          ]"
          style="border-top: none;"
          @dragover="handleDragOver($event, column.id)"
          @dragenter="handleDragEnter($event, column.id)"
          @dragleave="handleDragLeave($event, column.id)"
          @drop="handleDrop($event, column.id)"
        >
          <KanbanTaskCard
            v-for="task in column.tasks"
            :key="task.id"
            :task="task"
            :draggable="canMoveTask(task)"
            :can-delete="canDeleteTask(task)"
            @click="handleCardClick"
            @delete="handleTaskDelete"
          />

          <!-- Empty state -->
          <div
            v-if="column.tasks.length === 0"
            class="flex items-center justify-center py-8 text-neoMuted"
          >
            <p class="text-xs font-bold uppercase tracking-wide">Drop tasks here</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
