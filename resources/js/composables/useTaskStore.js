import axios from 'axios'
import { computed, ref } from 'vue'
import { syncCurrentUser, useAuth } from './useAuth'

const tasks = ref([])
const workspaces = ref([])
const users = ref([])
const teams = ref([])
const tasksLoaded = ref(false)
const workspacesLoaded = ref(false)
const usersLoaded = ref(false)
const teamsLoaded = ref(false)
const isLoadingTasks = ref(false)
const isLoadingWorkspaces = ref(false)
const isLoadingUsers = ref(false)
const isLoadingTeams = ref(false)
const MAX_TASK_ASSIGNEES = 5

const statusLabels = {
  todo: 'TO DO',
  'in-progress': 'IN PROGRESS',
  review: 'REVIEW',
  done: 'DONE'
}

const statusColors = {
  todo: 'bg-white',
  'in-progress': 'bg-neoYellow',
  review: 'bg-neoPink',
  done: 'bg-neoMint'
}

function normalizeUser(user) {
  return {
    id: user.id,
    name: user.name,
    username: user.username || '',
    email: user.email || '',
    role: user.role || 'user',
    is_active: Boolean(user.is_active),
    workspaceId: user.workspace_id || null,
    workspaceName: user.workspace?.name || '',
    teamId: user.team_id || null,
    teamName: user.team?.name || '',
    department: user.department || user.team?.name || ''
  }
}

function normalizeTask(task) {
  const assignedUsers = Array.isArray(task.assigned_users)
    ? task.assigned_users.map(normalizeUser)
    : []

  const assigneeNames = assignedUsers.map(user => user.name).filter(Boolean)

  return {
    id: task.id,
    title: task.title,
    description: task.description || '',
    status: task.status || 'todo',
    priority: task.priority || 'medium',
    dueDate: task.due_date || '',
    completed: Boolean(task.completed),
    completedAt: task.completed_at || null,
    workspaceId: task.workspace_id || null,
    teamId: task.team_id || null,
    createdByUserId: task.created_by_user_id || null,
    assignedToUserId: task.assigned_to_user_id || null,
    assignedUsers,
    assigneeNames,
    assigneeSummary: assigneeNames.length ? assigneeNames.join(', ') : 'Add a Member',
    assignedTo: assigneeNames[0] || 'Add a Member',
    workspace: task.workspace?.name || '',
    team: task.team?.name || '',
    creator: task.creator?.name || '',
    updatedAt: task.updated_at || null,
    createdAt: task.created_at || null
  }
}

function normalizeWorkspace(workspace) {
  return {
    id: workspace.id,
    name: workspace.name,
    description: workspace.description || '',
    status: workspace.status || 'active',
    color: workspace.color || '',
    teamsCount: workspace.teams_count ?? workspace.teamsCount ?? 0,
    tasksCount: workspace.tasks_count ?? workspace.tasksCount ?? 0,
    usersCount: workspace.users_count ?? workspace.usersCount ?? 0,
    creator: workspace.creator?.name || '',
    createdByUserId: workspace.created_by_user_id || null
  }
}

function normalizeTeam(team) {
  return {
    id: team.id,
    name: team.name,
    status: team.status || 'active',
    workspaceId: team.workspace_id || null,
    workspaceName: team.workspace?.name || '',
    createdAt: team.created_at || null,
    updatedAt: team.updated_at || null
  }
}

function resolveWorkspaceIdFromUser(user) {
  return user?.workspaceId ?? user?.workspace_id ?? user?.workspace?.id ?? null
}

function canUserModifyTask(task, userId) {
  if (!task || !userId) return false

  const isAssigned = Array.isArray(task.assignedUsers)
    && task.assignedUsers.some(user => user.id === userId)

  return isAssigned
}

function canUserDeleteTask(task, userId) {
  const isAssigned = Array.isArray(task?.assignedUsers)
    && task.assignedUsers.some(user => user.id === userId)

  return Boolean(task && userId && isAssigned)
}

function toTaskPayload(payload) {
  return {
    workspace_id: payload.workspace_id ?? payload.workspaceId ?? null,
    team_id: payload.team_id ?? payload.teamId ?? null,
    assignee_ids: payload.assignee_ids ?? payload.assignedUserIds ?? [],
    title: payload.title,
    description: payload.description || null,
    status: payload.status || 'todo',
    priority: payload.priority || 'medium',
    due_date: payload.due_date ?? payload.dueDate ?? null,
    completed: payload.completed ?? false
  }
}

function toTaskUpdatePayload(payload) {
  const request = {}

  const workspaceId = payload.workspace_id ?? payload.workspaceId
  const teamId = payload.team_id ?? payload.teamId
  const assigneeIds = payload.assignee_ids ?? payload.assignedUserIds

  if (workspaceId !== undefined) request.workspace_id = workspaceId
  if (teamId !== undefined) request.team_id = teamId
  if (assigneeIds !== undefined) request.assignee_ids = assigneeIds
  if (payload.title !== undefined) request.title = payload.title
  if (payload.description !== undefined) request.description = payload.description
  if (payload.status !== undefined) request.status = payload.status
  if (payload.priority !== undefined) request.priority = payload.priority
  if (payload.due_date !== undefined) request.due_date = payload.due_date
  if (payload.completed !== undefined) request.completed = payload.completed

  return request
}

function toWorkspacePayload(payload) {
  return {
    name: payload.name,
    description: payload.description || null,
    status: payload.status || 'active',
    color: payload.color || null
  }
}

async function loadTasks() {
  if (isLoadingTasks.value) return tasks.value

  isLoadingTasks.value = true
  try {
    const { data } = await axios.get('/api/tasks')
    tasks.value = (data.data || []).map(normalizeTask)
    tasksLoaded.value = true
    return tasks.value
  } finally {
    isLoadingTasks.value = false
  }
}

async function loadWorkspaces() {
  const { isAdmin } = useAuth()

  if (!isAdmin.value) {
    workspaces.value = []
    workspacesLoaded.value = true
    return workspaces.value
  }

  if (isLoadingWorkspaces.value) return workspaces.value

  isLoadingWorkspaces.value = true
  try {
    const { data } = await axios.get('/api/workspaces')
    workspaces.value = (data.data || []).map(normalizeWorkspace)
    workspacesLoaded.value = true
    return workspaces.value
  } finally {
    isLoadingWorkspaces.value = false
  }
}

async function loadUsers() {
  const { isAdmin } = useAuth()

  if (!isAdmin.value) {
    users.value = []
    usersLoaded.value = true
    return users.value
  }

  if (isLoadingUsers.value) return users.value

  isLoadingUsers.value = true
  try {
    const { data } = await axios.get('/api/users')
    users.value = (data.data || []).map(normalizeUser)
    usersLoaded.value = true
    return users.value
  } finally {
    isLoadingUsers.value = false
  }
}

async function loadTeams() {
  const { isAdmin } = useAuth()

  if (!isAdmin.value) {
    teams.value = []
    teamsLoaded.value = true
    return teams.value
  }

  if (isLoadingTeams.value) return teams.value

  isLoadingTeams.value = true
  try {
    const { data } = await axios.get('/api/teams')
    teams.value = (data.data || []).map(normalizeTeam)
    teamsLoaded.value = true
    return teams.value
  } finally {
    isLoadingTeams.value = false
  }
}

async function loadInitialData() {
  await loadTasks()
  await Promise.all([loadWorkspaces(), loadUsers(), loadTeams()])
}

function requireAdmin() {
  const { isAdmin } = useAuth()
  if (!isAdmin.value) {
    throw new Error('Admin access required.')
  }
}

async function createTask(payload) {
  const { data } = await axios.post('/api/tasks', toTaskPayload(payload))
  const task = normalizeTask(data.data)
  tasks.value = [task, ...tasks.value]
  return task
}

async function updateTask(taskId, payload) {
  const { currentUser, isAdmin } = useAuth()
  const localTask = tasks.value.find(item => item.id === taskId)

  if (localTask && !canUserModifyTask(localTask, currentUser.value.id, isAdmin.value)) {
    throw new Error('You are not allowed to update this task.')
  }

  const { data } = await axios.put(`/api/tasks/${taskId}`, toTaskUpdatePayload(payload))
  const task = normalizeTask(data.data)
  tasks.value = tasks.value.map(item => (item.id === task.id ? task : item))
  return task
}

async function deleteTask(taskId) {
  const { currentUser } = useAuth()
  const localTask = tasks.value.find(item => item.id === taskId)

  if (localTask && !canUserDeleteTask(localTask, currentUser.value.id)) {
    throw new Error('You are not allowed to delete this task.')
  }

  await axios.delete(`/api/tasks/${taskId}`)
  tasks.value = tasks.value.filter(task => task.id !== taskId)
}

async function toggleComplete(taskId) {
  const { currentUser, isAdmin } = useAuth()
  const task = tasks.value.find(item => item.id === taskId)
  if (!task) return null

  if (!canUserModifyTask(task, currentUser.value.id)) {
    throw new Error('You are not allowed to update this task.')
  }

  return updateTask(taskId, {
    completed: !task.completed,
    status: !task.completed ? 'done' : 'todo'
  })
}

async function moveTask(taskId, newStatus) {
  const { currentUser, isAdmin } = useAuth()
  const localTask = tasks.value.find(item => item.id === taskId)

  if (localTask && !canUserModifyTask(localTask, currentUser.value.id)) {
    throw new Error('You are not allowed to move this task.')
  }

  const updatedTask = await updateTask(taskId, {
    status: newStatus,
    completed: newStatus === 'done'
  })

  await loadTasks()
  return updatedTask
}

async function createWorkspace(payload) {
  requireAdmin()
  const { data } = await axios.post('/api/workspaces', toWorkspacePayload(payload))
  const workspace = normalizeWorkspace(data.data)
  workspaces.value = [workspace, ...workspaces.value]
  try {
    await syncCurrentUser()
  } catch {
    // The workspace already exists; the next auth refresh will pick up the new membership.
  }
  return workspace
}

async function createTeam(payload) {
  requireAdmin()
  const { data } = await axios.post('/api/teams', {
    workspace_id: payload.workspace_id ?? payload.workspaceId ?? null,
    name: payload.name,
    status: payload.status || 'active'
  })
  const team = normalizeTeam(data.data)
  teams.value = [team, ...teams.value]
  return team
}

async function updateTeam(teamId, payload) {
  requireAdmin()
  const { data } = await axios.put(`/api/teams/${teamId}`, {
    workspace_id: payload.workspace_id ?? payload.workspaceId ?? null,
    name: payload.name,
    status: payload.status || 'active'
  })
  const team = normalizeTeam(data.data)
  teams.value = teams.value.map(item => (item.id === team.id ? team : item))
  return team
}

async function deleteTeam(teamId) {
  requireAdmin()
  await axios.delete(`/api/teams/${teamId}`)
  teams.value = teams.value.filter(team => team.id !== teamId)
}

async function updateWorkspace(workspaceId, payload) {
  requireAdmin()
  const { data } = await axios.put(`/api/workspaces/${workspaceId}`, toWorkspacePayload(payload))
  const workspace = normalizeWorkspace(data.data)
  workspaces.value = workspaces.value.map(item => (item.id === workspace.id ? workspace : item))
  return workspace
}

async function deleteWorkspace(workspaceId) {
  requireAdmin()
  await axios.delete(`/api/workspaces/${workspaceId}`)
  workspaces.value = workspaces.value.filter(workspace => workspace.id !== workspaceId)
}

export function useTaskStore() {
  const { currentUser, isAdmin } = useAuth()

  const totalTasks = computed(() => tasks.value.filter(task => !task.completed).length)
  const completedTasks = computed(() => tasks.value.filter(task => task.completed).length)
  const inProgressTasks = computed(() => tasks.value.filter(task => task.status === 'in-progress' && !task.completed).length)
  const overdueTasks = computed(() => {
    const today = new Date().toISOString().split('T')[0]
    return tasks.value.filter(task => !task.completed && task.dueDate && task.dueDate < today).length
  })

  const completionRate = computed(() => {
    if (tasks.value.length === 0) return 0
    return Math.round((completedTasks.value / tasks.value.length) * 100)
  })

  const userTasks = computed(() => {
    return tasks.value
  })

  const userTotalTasks = computed(() => userTasks.value.filter(task => !task.completed).length)
  const userCompletedTasks = computed(() => userTasks.value.filter(task => task.completed).length)
  const userInProgressTasks = computed(() => userTasks.value.filter(task => task.status === 'in-progress' && !task.completed).length)
  const userOverdueTasks = computed(() => {
    const today = new Date().toISOString().split('T')[0]
    return userTasks.value.filter(task => !task.completed && task.dueDate && task.dueDate < today).length
  })
  const userCompletionRate = computed(() => {
    if (userTasks.value.length === 0) return 0
    return Math.round((userCompletedTasks.value / userTasks.value.length) * 100)
  })

  const openTasks = computed(() => tasks.value.filter(task => !task.completed))
  const columns = computed(() => buildColumns(tasks.value))

  function isTaskAssignedToCurrentUser(task) {
    return Array.isArray(task?.assignedUsers)
      && task.assignedUsers.some(user => user.id === currentUser.value.id)
  }

  function canEditTask(task) {
    if (!task || !currentUser.value.id) return false
    return isTaskAssignedToCurrentUser(task)
  }

  function canMoveTask(task) {
    return canEditTask(task)
  }

  function canDeleteTask(task) {
    if (!task || !currentUser.value.id) return false

    return isTaskAssignedToCurrentUser(task)
  }

  function getCurrentWorkspaceId() {
    return resolveWorkspaceIdFromUser(currentUser.value)
  }

  function getWorkspaceUsers(workspaceId) {
    if (!workspaceId) return []

    return users.value.filter(user => user.is_active && resolveWorkspaceIdFromUser(user) === workspaceId)
  }

  function getFilteredColumns(teamFilter, userFilter) {
    return computed(() => {
      let pool = tasks.value

      if (teamFilter.value && teamFilter.value !== 'all') {
        pool = pool.filter(task => task.team === teamFilter.value)
      }

      if (userFilter.value && userFilter.value !== 'all') {
        pool = pool.filter(task => task.assigneeNames.includes(userFilter.value))
      }

      return buildColumns(pool)
    })
  }

  function getUserColumns(showOnlyMine) {
    return computed(() => {
      let pool = userTasks.value

      if (showOnlyMine.value) {
        pool = pool.filter(task => canEditTask(task))
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
        tasks: taskList.filter(task => task.status === 'todo')
      },
      {
        id: 'in-progress',
        title: 'IN PROGRESS',
        color: 'bg-neoYellow',
        tasks: taskList.filter(task => task.status === 'in-progress')
      },
      {
        id: 'review',
        title: 'REVIEW',
        color: 'bg-neoPink',
        tasks: taskList.filter(task => task.status === 'review')
      },
      {
        id: 'done',
        title: 'DONE',
        color: 'bg-neoMint',
        tasks: taskList.filter(task => task.status === 'done')
      }
    ]
  }

  const members = computed(() => {
    const labels = users.value
      .map(user => user.name)
      .filter(Boolean)

    return [...new Set(labels)]
  })

  return {
    tasks,
    workspaces,
    users,
    tasksLoaded,
    workspacesLoaded,
    usersLoaded,
    teamsLoaded,
    isLoadingTasks,
    isLoadingWorkspaces,
    isLoadingUsers,
    isLoadingTeams,
    statusLabels,
    statusColors,
    teams,
    members,
    totalTasks,
    completedTasks,
    inProgressTasks,
    overdueTasks,
    completionRate,
    openTasks,
    columns,
    userTasks,
    userTotalTasks,
    userCompletedTasks,
    userInProgressTasks,
    userOverdueTasks,
    userCompletionRate,
    getFilteredColumns,
    getUserColumns,
    canEditTask,
    canMoveTask,
    canDeleteTask,
    getCurrentWorkspaceId,
    getWorkspaceUsers,
    loadTasks,
    loadWorkspaces,
    loadUsers,
    loadTeams,
    loadInitialData,
    createTask,
    updateTask,
    deleteTask,
    toggleComplete,
    moveTask,
    createWorkspace,
    updateWorkspace,
    deleteWorkspace,
    createTeam,
    updateTeam,
    deleteTeam
  }
}
