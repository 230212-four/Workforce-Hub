import { ref, computed } from 'vue'
import { useAuth } from './useAuth'

// Centralized task state shared between Dashboard and Kanban
const tasks = ref([
  {
    id: 'TSK-001',
    title: 'Update user authentication system',
    description: 'Implement OAuth2 flow with refresh tokens',
    status: 'in-progress',
    priority: 'high',
    dueDate: '2026-06-05',
    assignee: 'Admin',
    assignedTo: 'John Doe',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-01'
  },
  {
    id: 'TSK-002',
    title: 'Design new dashboard layout',
    description: 'Create wireframes and mockups for the new dashboard',
    status: 'todo',
    priority: 'medium',
    dueDate: '2026-06-08',
    assignee: 'Admin',
    assignedTo: 'Jane Smith',
    team: 'Design',
    completed: false,
    createdAt: '2026-06-01'
  },
  {
    id: 'TSK-003',
    title: 'Fix bug in payment processing',
    description: 'Investigate and fix the double-charge issue',
    status: 'todo',
    priority: 'high',
    dueDate: '2026-06-04',
    assignee: 'Admin',
    assignedTo: 'John Doe',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-02'
  },
  {
    id: 'TSK-004',
    title: 'Write API documentation',
    description: 'Document all REST endpoints for v2 API',
    status: 'review',
    priority: 'low',
    dueDate: '2026-06-10',
    assignee: 'Admin',
    assignedTo: 'Jane Smith',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-02'
  },
  {
    id: 'TSK-005',
    title: 'Optimize database queries',
    description: 'Profile and optimize slow queries in reporting module',
    status: 'in-progress',
    priority: 'high',
    dueDate: '2026-06-03',
    assignee: 'Admin',
    assignedTo: 'John Doe',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-03'
  },
  {
    id: 'TSK-006',
    title: 'Set up CI/CD pipeline',
    description: 'Configure GitHub Actions for automated testing and deployment',
    status: 'done',
    priority: 'medium',
    dueDate: '2026-06-01',
    assignee: 'Admin',
    assignedTo: 'John Doe',
    team: 'Engineering',
    completed: true,
    createdAt: '2026-05-28'
  },
  {
    id: 'TSK-007',
    title: 'Create onboarding illustrations',
    description: 'Design 5 illustration assets for the onboarding flow',
    status: 'in-progress',
    priority: 'medium',
    dueDate: '2026-06-09',
    assignee: 'User',
    assignedTo: 'Jane Smith',
    team: 'Design',
    completed: false,
    createdAt: '2026-06-03'
  },
  {
    id: 'TSK-008',
    title: 'Refactor notification service',
    description: 'Extract notification logic into a dedicated microservice',
    status: 'todo',
    priority: 'low',
    dueDate: '2026-06-12',
    assignee: 'User',
    assignedTo: 'Alex Rivera',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-04'
  },
  {
    id: 'TSK-009',
    title: 'Brand style guide update',
    description: 'Update color palette and typography rules for 2026 rebrand',
    status: 'review',
    priority: 'medium',
    dueDate: '2026-06-07',
    assignee: 'User',
    assignedTo: 'Jane Smith',
    team: 'Design',
    completed: false,
    createdAt: '2026-06-02'
  },
  {
    id: 'TSK-010',
    title: 'Load testing for release',
    description: 'Run k6 load tests against staging environment before v2 launch',
    status: 'todo',
    priority: 'high',
    dueDate: '2026-06-06',
    assignee: 'Admin',
    assignedTo: 'Alex Rivera',
    team: 'Engineering',
    completed: false,
    createdAt: '2026-06-04'
  }
])

let nextId = 11

const statusLabels = {
  'todo': 'TO DO',
  'in-progress': 'IN PROGRESS',
  'review': 'REVIEW',
  'done': 'DONE'
}

const statusColors = {
  'todo': 'bg-white',
  'in-progress': 'bg-neoYellow',
  'review': 'bg-neoPink',
  'done': 'bg-neoMint'
}

// Available teams and members for filters
const teams = ['Engineering', 'Design']
const members = ['John Doe', 'Jane Smith', 'Alex Rivera']

export function useTaskStore() {
  const { currentUser } = useAuth()

  // ── Global stats (admin / workspace-wide) ──
  const totalTasks = computed(() => tasks.value.filter(t => !t.completed).length)
  const completedTasks = computed(() => tasks.value.filter(t => t.completed).length)
  const inProgressTasks = computed(() => tasks.value.filter(t => t.status === 'in-progress' && !t.completed).length)
  const overdueTasks = computed(() => {
    const today = new Date().toISOString().split('T')[0]
    return tasks.value.filter(t => !t.completed && t.dueDate < today).length
  })

  const completionRate = computed(() => {
    if (tasks.value.length === 0) return 0
    return Math.round((completedTasks.value / tasks.value.length) * 100)
  })

  // ── User-scoped stats (regular user) ──
  const userTasks = computed(() => tasks.value.filter(t => t.assignedTo === currentUser.value.name))

  const userTotalTasks = computed(() => userTasks.value.filter(t => !t.completed).length)
  const userCompletedTasks = computed(() => userTasks.value.filter(t => t.completed).length)
  const userInProgressTasks = computed(() => userTasks.value.filter(t => t.status === 'in-progress' && !t.completed).length)
  const userOverdueTasks = computed(() => {
    const today = new Date().toISOString().split('T')[0]
    return userTasks.value.filter(t => !t.completed && t.dueDate < today).length
  })
  const userCompletionRate = computed(() => {
    if (userTasks.value.length === 0) return 0
    return Math.round((userCompletedTasks.value / userTasks.value.length) * 100)
  })

  const openTasks = computed(() => tasks.value.filter(t => !t.completed))

  // ── Kanban columns (all tasks, unfiltered — default) ──
  const columns = computed(() => buildColumns(tasks.value))

  // ── Filtered columns for admin god-view ──
  function getFilteredColumns(teamFilter, userFilter) {
    return computed(() => {
      let pool = tasks.value
      if (teamFilter.value && teamFilter.value !== 'all') {
        pool = pool.filter(t => t.team === teamFilter.value)
      }
      if (userFilter.value && userFilter.value !== 'all') {
        pool = pool.filter(t => t.assignedTo === userFilter.value)
      }
      return buildColumns(pool)
    })
  }

  // ── Filtered columns for user team/my-tasks view ──
  function getUserColumns(showOnlyMine) {
    return computed(() => {
      let pool = tasks.value
      // User always sees their team's tasks by default
      const userTeams = [...new Set(tasks.value.filter(t => t.assignedTo === currentUser.value.name).map(t => t.team))]
      pool = pool.filter(t => userTeams.includes(t.team))
      if (showOnlyMine.value) {
        pool = pool.filter(t => t.assignedTo === currentUser.value.name)
      }
      return buildColumns(pool)
    })
  }

  function buildColumns(taskList) {
    return [
      {
        id: 'todo',
        title: 'TO DO',
        color: 'bg-white dark-card-col',
        tasks: taskList.filter(t => t.status === 'todo')
      },
      {
        id: 'in-progress',
        title: 'IN PROGRESS',
        color: 'bg-neoYellow',
        tasks: taskList.filter(t => t.status === 'in-progress')
      },
      {
        id: 'review',
        title: 'REVIEW',
        color: 'bg-neoPink',
        tasks: taskList.filter(t => t.status === 'review')
      },
      {
        id: 'done',
        title: 'DONE',
        color: 'bg-neoMint',
        tasks: taskList.filter(t => t.status === 'done')
      }
    ]
  }

  function addTask(taskData) {
    const id = `TSK-${String(nextId++).padStart(3, '0')}`
    tasks.value.push({
      id,
      title: taskData.title,
      description: taskData.description || '',
      status: taskData.status || 'todo',
      priority: taskData.priority || 'medium',
      dueDate: taskData.dueDate || '',
      assignee: taskData.assignee || 'Admin',
      assignedTo: taskData.assignedTo || currentUser.value.name,
      team: taskData.team || 'Engineering',
      completed: false,
      createdAt: new Date().toISOString().split('T')[0]
    })
    return id
  }

  function updateTask(taskId, updates) {
    const index = tasks.value.findIndex(t => t.id === taskId)
    if (index !== -1) {
      tasks.value[index] = { ...tasks.value[index], ...updates }
    }
  }

  function deleteTask(taskId) {
    const index = tasks.value.findIndex(t => t.id === taskId)
    if (index !== -1) {
      tasks.value.splice(index, 1)
    }
  }

  function toggleComplete(taskId) {
    const task = tasks.value.find(t => t.id === taskId)
    if (task) {
      task.completed = !task.completed
      if (task.completed) {
        task.status = 'done'
      }
    }
  }

  function moveTask(taskId, newStatus) {
    const task = tasks.value.find(t => t.id === taskId)
    if (task) {
      task.status = newStatus
      if (newStatus === 'done') {
        task.completed = true
      } else {
        task.completed = false
      }
    }
  }

  return {
    tasks,
    totalTasks,
    completedTasks,
    inProgressTasks,
    overdueTasks,
    completionRate,
    openTasks,
    columns,
    statusLabels,
    statusColors,
    teams,
    members,
    // User-scoped stats
    userTasks,
    userTotalTasks,
    userCompletedTasks,
    userInProgressTasks,
    userOverdueTasks,
    userCompletionRate,
    // Filtered column helpers
    getFilteredColumns,
    getUserColumns,
    // Mutations
    addTask,
    updateTask,
    deleteTask,
    toggleComplete,
    moveTask
  }
}
