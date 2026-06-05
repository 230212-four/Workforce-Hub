import { ref, computed } from 'vue'

// User profiles for role switching
const profiles = {
  admin: { name: 'John Doe', initials: 'JD', role: 'admin' },
  user: { name: 'Jane Smith', initials: 'JS', role: 'user' }
}

// Singleton reactive state (shared across all component instances)
const currentUser = ref({ ...profiles.admin })

export function useAuth() {
  const isAdmin = computed(() => currentUser.value.role === 'admin')

  function toggleRole() {
    if (currentUser.value.role === 'admin') {
      currentUser.value = { ...profiles.user }
    } else {
      currentUser.value = { ...profiles.admin }
    }
  }

  return {
    currentUser,
    isAdmin,
    toggleRole
  }
}
