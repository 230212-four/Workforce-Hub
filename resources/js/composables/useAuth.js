import axios from 'axios'
import { computed, ref } from 'vue'

const STORAGE_TOKEN_KEY = 'workforceHubToken'
const STORAGE_USER_KEY = 'workforceHubUser'

const emptyUser = () => ({
  id: null,
  name: '',
  username: '',
  email: '',
  initials: '',
  role: 'user',
  is_active: false
})

const currentUser = ref(loadPersistedUser())
const token = ref(localStorage.getItem(STORAGE_TOKEN_KEY) || '')
const authReady = ref(false)
let hydratePromise = null

setAxiosToken(token.value)

function loadPersistedUser() {
  try {
    const raw = localStorage.getItem(STORAGE_USER_KEY)
    return raw ? { ...emptyUser(), ...JSON.parse(raw) } : emptyUser()
  } catch {
    return emptyUser()
  }
}

function setAxiosToken(nextToken) {
  if (nextToken) {
    axios.defaults.headers.common.Authorization = `Bearer ${nextToken}`
  } else {
    delete axios.defaults.headers.common.Authorization
  }
}

function persistAuth(nextToken, user) {
  token.value = nextToken || ''
  setAxiosToken(token.value)

  if (nextToken) {
    localStorage.setItem(STORAGE_TOKEN_KEY, nextToken)
  } else {
    localStorage.removeItem(STORAGE_TOKEN_KEY)
  }

  currentUser.value = normalizeUser(user)
  localStorage.setItem(STORAGE_USER_KEY, JSON.stringify(currentUser.value))
}

function normalizeUser(user) {
  if (!user) {
    return emptyUser()
  }

  const initials = user.initials || buildInitials(user.name || user.username)

  return {
    ...emptyUser(),
    ...user,
    initials
  }
}

function buildInitials(value) {
  if (!value) return ''

  return value
    .split(/\s+/)
    .filter(Boolean)
    .map(part => part[0])
    .join('')
    .slice(0, 2)
    .toUpperCase()
}

function clearAuth() {
  token.value = ''
  setAxiosToken('')
  currentUser.value = emptyUser()
  localStorage.removeItem(STORAGE_TOKEN_KEY)
  localStorage.removeItem(STORAGE_USER_KEY)
}

export async function hydrateAuth() {
  if (hydratePromise) {
    return hydratePromise
  }

  hydratePromise = (async () => {
    if (!token.value) {
      authReady.value = true
      return currentUser.value
    }

    if (!currentUser.value.id) {
      currentUser.value = loadPersistedUser()
    }

    try {
      const { data } = await axios.get('/api/me')
      persistAuth(token.value, data.user)
    } catch (error) {
      clearAuth()
      throw error
    } finally {
      authReady.value = true
      hydratePromise = null
    }

    return currentUser.value
  })()

  return hydratePromise
}

export async function syncCurrentUser() {
  if (!token.value) {
    return currentUser.value
  }

  const { data } = await axios.get('/api/me')
  currentUser.value = normalizeUser(data.user)
  localStorage.setItem(STORAGE_USER_KEY, JSON.stringify(currentUser.value))

  return currentUser.value
}

export function useAuth() {
  const isAdmin = computed(() => currentUser.value.role === 'admin')
  const isAuthenticated = computed(() => Boolean(token.value && currentUser.value.id))
  const displayName = computed(() => currentUser.value.name?.trim() || currentUser.value.username || '')
  const avatarInitial = computed(() => currentUser.value.initials || buildInitials(displayName.value) || (isAdmin.value ? 'A' : 'U'))
  const roleLabel = computed(() => (isAdmin.value ? 'Administrator' : 'User'))

  async function login(credentials) {
    const { data } = await axios.post('/api/login', credentials)
    persistAuth(data.token, data.user)
    return data
  }

  async function registerAdmin(payload) {
    const { data } = await axios.post('/api/register', payload)
    return data
  }

  async function logout() {
    try {
      if (token.value) {
        await axios.post('/api/logout')
      }
    } finally {
      clearAuth()
    }
  }

  async function switchWorkspace(workspaceId) {
    const { data } = await axios.put('/api/me/workspace', {
      workspace_id: workspaceId
    })

    currentUser.value = normalizeUser(data.user)
    localStorage.setItem(STORAGE_USER_KEY, JSON.stringify(currentUser.value))

    return currentUser.value
  }

  async function fetchUsers(params = {}) {
    const { data } = await axios.get('/api/users', { params })
    return data.data
  }

  async function createUser(payload) {
    const { data } = await axios.post('/api/users', payload)
    return data.data
  }

  async function updateUser(userId, payload) {
    const { data } = await axios.put(`/api/users/${userId}`, payload)
    return data.data
  }

  async function deleteUser(userId) {
    const { data } = await axios.delete(`/api/users/${userId}`)
    return data
  }

  return {
    authReady,
    currentUser,
    isAdmin,
    isAuthenticated,
    displayName,
    avatarInitial,
    roleLabel,
    login,
    registerAdmin,
    logout,
    switchWorkspace,
    fetchUsers,
    createUser,
    updateUser,
    deleteUser
  }
}
