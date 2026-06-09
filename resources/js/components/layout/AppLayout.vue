<script setup>
import { ref, onMounted, onUnmounted, provide } from 'vue'
import Sidebar from './Sidebar.vue'
import Navbar from './Navbar.vue'
import CreateTaskModal from '../modals/CreateTaskModal.vue'
import EditTaskModal from '../modals/EditTaskModal.vue'
import ToastContainer from '../ui/ToastContainer.vue'
import CommandPalette from '../ui/CommandPalette.vue'
import { useTaskStore } from '../../composables/useTaskStore'
import { useToast } from '../../composables/useToast'
import { useAuth } from '../../composables/useAuth'

const { createTask, updateTask, loadInitialData } = useTaskStore()
const { addToast } = useToast()
const { isAuthenticated } = useAuth()

// ── Modal state ──
const showCreateModal = ref(false)
const showEditModal   = ref(false)
const editingTask     = ref(null)

const openCreateModal = () => { showCreateModal.value = true }
const closeCreateModal = () => { showCreateModal.value = false }

const openEditModal = (task) => {
  editingTask.value = { ...task }
  showEditModal.value = true
}
const closeEditModal = () => {
  showEditModal.value = false
  editingTask.value = null
}

const handleCreateTask = async (taskData) => {
  try {
    await createTask(taskData)
    closeCreateModal()
    addToast({ message: 'Task created successfully!', type: 'success' })
  } catch (error) {
    addToast({ message: error?.response?.data?.message || error?.message || 'Unable to create the task.', type: 'error' })
  }
}

const handleSaveTask = async (taskData) => {
  if (!taskData.id) return

  try {
    await updateTask(taskData.id, taskData)
    closeEditModal()
    addToast({ message: 'Task updated successfully!', type: 'success' })
  } catch (error) {
    addToast({ message: error?.response?.data?.message || error?.message || 'Unable to update the task.', type: 'error' })
  }
}

// ── Mobile sidebar state ──
const sidebarOpen = ref(false)

// ── Command Palette ──
const showCommandPalette = ref(false)
const openCommandPalette = () => { showCommandPalette.value = true }
const closeCommandPalette = () => { showCommandPalette.value = false }

// ── Global hotkeys ──
const handleKeydown = (e) => {
  // Skip if inside form fields (but still allow Cmd/Ctrl+K)
  if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT') {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
      e.preventDefault()
      openCommandPalette()
    }
    return
  }

  // Command palette: Cmd+K / Ctrl+K
  if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
    e.preventDefault()
    openCommandPalette()
    return
  }

  // Don't handle other shortcuts when modals/palette are open or user is unauthenticated
  if (showCreateModal.value || showEditModal.value || showCommandPalette.value || !isAuthenticated.value) return

  // 'N' opens create task modal
  if (e.key === 'n' || e.key === 'N') {
    e.preventDefault()
    openCreateModal()
  }
}

onMounted(() => {
  loadInitialData()
  document.addEventListener('keydown', handleKeydown)
})
onUnmounted(() => { document.removeEventListener('keydown', handleKeydown) })

// Provide modal + toast controls to child pages
provide('openCreateModal', openCreateModal)
provide('openEditModal',   openEditModal)
provide('addToast',        addToast)
</script>

<template>
  <div class="flex h-screen bg-neoBg">
    <!-- Sidebar (handles both desktop fixed + mobile drawer internally) -->
    <Sidebar
      :isOpen="sidebarOpen"
      @close="sidebarOpen = false"
    />

    <!-- Main area shifted right on desktop to account for fixed sidebar -->
    <div class="flex-1 flex flex-col md:ml-56 overflow-hidden">
      <Navbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />
      <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
        <slot />
      </main>
    </div>

    <!-- Global Modals -->
    <CreateTaskModal
      :isOpen="showCreateModal"
      @close="closeCreateModal"
      @create="handleCreateTask"
    />
    <EditTaskModal
      :isOpen="showEditModal"
      :task="editingTask"
      @close="closeEditModal"
      @save="handleSaveTask"
    />

    <!-- Command Palette -->
    <CommandPalette
      :isOpen="showCommandPalette"
      @close="closeCommandPalette"
    />

    <!-- Global Toast Notifications -->
    <ToastContainer />
  </div>
</template>
