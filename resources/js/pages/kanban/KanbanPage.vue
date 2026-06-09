<script setup>
import { ref, inject, computed, nextTick } from 'vue'
import KanbanTaskCard from '../../components/kanban/KanbanTaskCard.vue'
import { useTaskStore } from '../../composables/useTaskStore'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'

const openCreateModal = inject('openCreateModal')
const openEditModal = inject('openEditModal')

const { moveTask, teams, members, getFilteredColumns, getUserColumns, tasks } = useTaskStore()
const { isAdmin, currentUser } = useAuth()
const { addToast } = useToast()

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

const handleDrop = (e, columnId) => {
  e.preventDefault()
  const taskId = e.dataTransfer.getData('text/plain')
  if (taskId) {
    // Double-check permission on drop side too
    const task = tasks.value.find(t => t.id === taskId)
    if (!isAdmin.value && task && task.assignedTo !== currentUser.value.name) {
      addToast({
        message: 'Permission Denied: You can only move your own tasks.',
        type: 'error'
      })
      dragOverColumn.value = null
      return
    }
    moveTask(taskId, columnId)
  }
  dragOverColumn.value = null
}

// ── Card click — with Shift for bulk selection ──
const selectedCards = ref(new Set())

const handleCardClick = (task, event) => {
  if (event && event.shiftKey) {
    // Toggle selection
    const newSet = new Set(selectedCards.value)
    if (newSet.has(task.id)) {
      newSet.delete(task.id)
    } else {
      newSet.add(task.id)
    }
    selectedCards.value = newSet
  } else {
    openEditModal(task)
  }
}

const clearSelection = () => {
  selectedCards.value = new Set()
}

// ── Bulk actions ──
const bulkArchive = () => {
  selectedCards.value.forEach(taskId => {
    moveTask(taskId, 'done')
  })
  addToast({ message: `${selectedCards.value.size} task(s) archived.`, type: 'success' })
  clearSelection()
}

const bulkReassign = () => {
  const { updateTask } = useTaskStore()
  selectedCards.value.forEach(taskId => {
    updateTask(taskId, { assignedTo: currentUser.value.name })
  })
  addToast({ message: `${selectedCards.value.size} task(s) reassigned to you.`, type: 'success' })
  clearSelection()
}

const hasSelection = computed(() => selectedCards.value.size > 0)

// ── Keyboard-driven column movement ──
const statusOrder = ['todo', 'in-progress', 'review', 'done']

const handleMoveLeft = (taskId) => {
  const task = tasks.value.find(t => t.id === taskId)
  if (!task) return
  // Permission check for users
  if (!isAdmin.value && task.assignedTo !== currentUser.value.name) {
    addToast({ message: 'Permission Denied: You can only move your own tasks.', type: 'error' })
    return
  }
  const currentIndex = statusOrder.indexOf(task.status)
  if (currentIndex > 0) {
    moveTask(taskId, statusOrder[currentIndex - 1])
    // Re-focus the card after Vue re-renders
    nextTick(() => {
      const card = document.querySelector(`[data-task-id="${taskId}"]`)
      if (card) card.focus()
    })
  }
}

const handleMoveRight = (taskId) => {
  const task = tasks.value.find(t => t.id === taskId)
  if (!task) return
  // Permission check for users
  if (!isAdmin.value && task.assignedTo !== currentUser.value.name) {
    addToast({ message: 'Permission Denied: You can only move your own tasks.', type: 'error' })
    return
  }
  const currentIndex = statusOrder.indexOf(task.status)
  if (currentIndex < statusOrder.length - 1) {
    moveTask(taskId, statusOrder[currentIndex + 1])
    nextTick(() => {
      const card = document.querySelector(`[data-task-id="${taskId}"]`)
      if (card) card.focus()
    })
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
    'todo': 'bg-white/50 dark:bg-white/5',
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
        @click="openCreateModal"
        class="flex items-center gap-2 px-5 py-2.5 bg-ink text-white brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer flex-shrink-0"
        style="border-color: var(--border-color);"
      >
        + NEW TASK
        <span class="bg-neoIndigo text-white w-5 h-5 flex items-center justify-center text-[0.6rem] font-black brut-border" style="border-color: rgba(255,255,255,0.3);">N</span>
      </button>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- BULK ACTIONS TOOLBAR                        -->
    <!-- ═══════════════════════════════════════════ -->
    <transition name="dropdown">
      <div v-if="hasSelection" class="bulk-toolbar">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <polyline points="9 11 12 14 22 4" /><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
        </svg>
        <span class="text-xs font-black uppercase tracking-wider flex-shrink-0">
          {{ selectedCards.size }} Selected
        </span>
        <span class="text-xs opacity-40">|</span>
        <button class="bulk-toolbar-btn" @click="bulkArchive">
          📦 Bulk Archive
        </button>
        <button class="bulk-toolbar-btn" @click="bulkReassign">
          👤 Reassign to Me
        </button>
        <button class="bulk-toolbar-btn danger" @click="clearSelection">
          ✕ Clear
        </button>
      </div>
    </transition>

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
        <option v-for="t in teams" :key="t" :value="t">{{ t }}</option>
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
            :isSelected="selectedCards.has(task.id)"
            @click="handleCardClick(task, $event)"
            @move-left="handleMoveLeft"
            @move-right="handleMoveRight"
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
