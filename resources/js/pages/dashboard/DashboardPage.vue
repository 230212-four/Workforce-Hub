<script setup>
import { computed, inject } from 'vue'
import StatsCard from '../../components/dashboard/StatsCard.vue'
import { useTaskStore } from '../../composables/useTaskStore'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'

const openCreateModal = inject('openCreateModal')
const openEditModal = inject('openEditModal')
const { addToast } = useToast()

const { currentUser, isAdmin } = useAuth()

const {
  tasks,
  userTasks,
  totalTasks,
  completedTasks,
  inProgressTasks,
  overdueTasks,
  completionRate,
  userTotalTasks,
  userCompletedTasks,
  userInProgressTasks,
  userOverdueTasks,
  userCompletionRate,
  toggleComplete,
  canEditTask,
  canMoveTask,
  statusLabels
} = useTaskStore()

// ── Role-aware stats ──
const displayTotal = computed(() => isAdmin.value ? totalTasks.value : userTotalTasks.value)
const displayCompleted = computed(() => isAdmin.value ? completedTasks.value : userCompletedTasks.value)
const displayInProgress = computed(() => isAdmin.value ? inProgressTasks.value : userInProgressTasks.value)
const displayOverdue = computed(() => isAdmin.value ? overdueTasks.value : userOverdueTasks.value)
const displayRate = computed(() => isAdmin.value ? completionRate.value : userCompletionRate.value)
const statsPeriod = computed(() => isAdmin.value ? 'ALL WORKSPACE' : 'ALL TASKS')

const greeting = computed(() => {
  const hour = new Date().getHours()
  if (hour < 12) return 'Good morning'
  if (hour < 18) return 'Good afternoon'
  return 'Good evening'
})

const userFirstName = computed(() => {
  const trimmedName = currentUser.value.name?.trim() || ''
  return trimmedName.split(/\s+/)[0] || ''
})

const dateString = computed(() => {
  const now = new Date()
  const days = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY']
  const months = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER']
  return `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}`
})

const recentTasks = computed(() => {
  const pool = isAdmin.value
    ? tasks.value
    : userTasks.value
  return pool.slice().sort((a, b) => {
    if (a.completed !== b.completed) return a.completed ? 1 : -1
    return 0
  })
})

const handleToggleComplete = async (e, taskId) => {
  e.stopPropagation()

  const task = recentTasks.value.find(item => item.id === taskId)
  if (!task || !canMoveTask(task)) {
    addToast({
      message: 'Permission Denied: You can only complete your own tasks.',
      type: 'error'
    })
    return
  }

  try {
    await toggleComplete(taskId)
    addToast({ message: 'Task updated successfully.', type: 'success' })
  } catch (error) {
    addToast({ message: error?.message || 'Unable to update the task.', type: 'error' })
  }
}

const handleRowClick = (task) => {
  if (canEditTask(task)) {
    openEditModal(task)
    return
  }

  addToast({
    message: 'You can only open tasks assigned to you or created by you.',
    type: 'error'
  })
}

const getPriorityClass = (priority) => {
  const map = { high: 'badge-high', medium: 'badge-medium', low: 'badge-low' }
  return map[priority] || 'badge-medium'
}

const getStatusLabel = (status) => {
  return statusLabels[status] || status.toUpperCase()
}
</script>

<template>
  <div class="space-y-6">
    <!-- Top Row: Date, Greeting, New Task Button -->
    <div class="flex items-start justify-between">
      <div>
        <p class="text-xs font-black uppercase tracking-wider text-neoMuted mb-1">{{ dateString }}</p>
        <h1 class="text-3xl font-black text-ink mb-1.5">
          {{ greeting }}{{ userFirstName ? ', ' + userFirstName : '' }}.
        </h1>
        <p class="text-sm text-neoMuted font-medium">
          You have
          <span class="bg-neoYellow px-1.5 py-0.5 brut-border text-ink font-black text-xs">{{ displayTotal }}</span>
          open tasks{{ isAdmin ? ' across the workspace' : ' visible to you' }}.
        </p>
      </div>
      <button
        v-if="currentUser.id"
        id="new-task-btn"
        @click="openCreateModal"
        class="flex items-center gap-2 px-5 py-2.5 bg-ink text-white brut-border brut-hover font-black text-xs uppercase tracking-wide cursor-pointer flex-shrink-0"
        style="border-color: var(--border-color);"
      >
        + NEW TASK
        <span class="bg-neoIndigo text-white w-5 h-5 flex items-center justify-center text-[0.6rem] font-black brut-border" style="border-color: rgba(255,255,255,0.3);">N</span>
      </button>
    </div>

    <!-- Weekly Momentum -->
    <div>
      <div class="flex items-center justify-between mb-2">
        <span class="text-xs font-black uppercase tracking-wider text-ink">Weekly Momentum</span>
        <span class="text-xs font-black text-neoMuted">{{ displayRate }}% / 100%</span>
      </div>
      <div class="neo-progress-track">
        <div class="neo-progress-fill" :style="{ width: Math.max(displayRate, 5) + '%' }">
          <span>KEEP GOING ›</span>
        </div>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <StatsCard title="Total" :count="displayTotal" colorClass="bg-neoCard" :period="statsPeriod" />
      <StatsCard title="Completed" :count="displayCompleted" colorClass="bg-neoMint" :period="statsPeriod" />
      <StatsCard title="In Progress" :count="displayInProgress" colorClass="bg-neoYellow" :period="statsPeriod" />
      <StatsCard title="Overdue" :count="displayOverdue" colorClass="bg-neoPink" :period="statsPeriod" />
    </div>

    <div v-if="recentTasks.length === 0" class="brut-border brut-shadow bg-neoCard p-5 text-center">
      <p class="text-xs font-black uppercase tracking-wider text-neoMuted">No tasks yet</p>
    </div>

    <!-- Recent Tasks -->
    <div v-else class="brut-border brut-shadow bg-neoCard p-5">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-black text-ink">Recent Tasks</h2>
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">{{ recentTasks.length }} ITEMS</span>
      </div>

      <div>
        <div
          v-for="task in recentTasks"
          :key="task.id"
          @click="handleRowClick(task)"
          :class="['task-row', task.completed ? 'completed' : '']"
        >
          <!-- Check Circle -->
          <button
            @click="handleToggleComplete($event, task.id)"
            :class="['check-circle mr-4', task.completed ? 'checked' : '']"
          >
            <svg v-if="task.completed" class="w-3.5 h-3.5 text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
              <polyline points="20,6 9,17 4,12" />
            </svg>
          </button>

          <!-- Task Info -->
          <div class="flex-1 min-w-0 mr-4">
            <p class="task-title text-sm font-bold text-ink leading-tight">{{ task.title }}</p>
            <p class="text-[0.65rem] font-bold text-neoMuted uppercase tracking-wide mt-0.5">
              {{ getStatusLabel(task.status) }}
              <span v-if="task.dueDate" class="ml-1">· DUE {{ task.dueDate }}</span>
              <span v-if="isAdmin && task.assigneeSummary" class="ml-1">· {{ task.assigneeSummary }}</span>
            </p>
          </div>

          <!-- Priority Badge -->
          <span :class="getPriorityClass(task.priority)" class="flex-shrink-0">
            {{ task.priority.toUpperCase() }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
