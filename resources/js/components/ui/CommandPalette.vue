<script setup>
import { ref, computed, watch, nextTick, inject } from 'vue'
import { useRouter } from 'vue-router'
import { useTaskStore } from '../../composables/useTaskStore'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close'])

const router = useRouter()
const { tasks } = useTaskStore()

const openCreateModal = inject('openCreateModal', null)
const openEditModal = inject('openEditModal', null)

const searchQuery = ref('')
const activeIndex = ref(0)
const inputRef = ref(null)

// ── Static navigation actions ──
const staticActions = [
  { id: 'nav-dashboard', label: 'Go to Dashboard', type: 'navigation', icon: '📊', path: '/dashboard' },
  { id: 'nav-kanban',    label: 'Go to Kanban',    type: 'navigation', icon: '📋', path: '/kanban' },
  { id: 'nav-settings',  label: 'Go to Settings',  type: 'navigation', icon: '⚙️', path: '/settings' },
  { id: 'nav-workspace', label: 'Go to Workspace',  type: 'navigation', icon: '🏢', path: '/workspace' },
  { id: 'action-create', label: 'Create New Task',  type: 'action',     icon: '✚', action: 'create-task' }
]

// ── Filtered results ──
const filteredResults = computed(() => {
  const q = searchQuery.value.toLowerCase().trim()

  // Filter static actions
  const matchedActions = staticActions.filter(a =>
    a.label.toLowerCase().includes(q)
  )

  // Search tasks by title
  const matchedTasks = q.length >= 2
    ? tasks.value
        .filter(t => t.title.toLowerCase().includes(q))
        .slice(0, 6)
        .map(t => ({
          id: `task-${t.id}`,
          label: t.title,
          type: 'task',
          icon: '📝',
          task: t
        }))
    : []

  return [...matchedActions, ...matchedTasks]
})

// Reset active index when results change
watch(filteredResults, () => {
  activeIndex.value = 0
})

// Autofocus input when opened
watch(() => props.isOpen, (val) => {
  if (val) {
    searchQuery.value = ''
    activeIndex.value = 0
    nextTick(() => {
      inputRef.value?.focus()
    })
  }
})

// ── Execute selected action ──
const executeAction = (item) => {
  if (item.type === 'navigation') {
    router.push(item.path)
  } else if (item.type === 'action' && item.action === 'create-task') {
    if (openCreateModal) openCreateModal()
  } else if (item.type === 'task' && item.task) {
    if (openEditModal) openEditModal(item.task)
  }
  emit('close')
}

// ── Keyboard navigation ──
const handleKeydown = (e) => {
  if (e.key === 'ArrowDown') {
    e.preventDefault()
    activeIndex.value = Math.min(activeIndex.value + 1, filteredResults.value.length - 1)
  } else if (e.key === 'ArrowUp') {
    e.preventDefault()
    activeIndex.value = Math.max(activeIndex.value - 1, 0)
  } else if (e.key === 'Enter') {
    e.preventDefault()
    const selected = filteredResults.value[activeIndex.value]
    if (selected) executeAction(selected)
  } else if (e.key === 'Escape') {
    emit('close')
  }
}

const getTypeLabel = (type) => {
  const map = { navigation: 'NAV', action: 'ACTION', task: 'TASK' }
  return map[type] || ''
}
</script>

<template>
  <Teleport to="body">
    <transition name="palette">
      <div
        v-if="isOpen"
        class="fixed inset-0 z-[10000] flex items-start justify-center pt-[15vh] bg-black/60 backdrop-blur-sm"
        @click.self="$emit('close')"
        @keydown="handleKeydown"
      >
        <div
          class="bg-neoCard brut-border w-full max-w-xl mx-4"
          style="box-shadow: 8px 8px 0 0 var(--shadow-color);"
          @click.stop
        >
          <!-- Search Input -->
          <div class="flex items-center gap-3 p-4" style="border-bottom: 2px solid var(--border-color);">
            <svg class="w-5 h-5 text-neoMuted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input
              ref="inputRef"
              v-model="searchQuery"
              type="text"
              class="flex-1 bg-transparent text-ink text-sm font-semibold placeholder-neoMuted focus:outline-none"
              placeholder="Search commands, pages, or tasks…"
              autocomplete="off"
            />
            <kbd class="text-[0.55rem] font-black uppercase tracking-wider text-neoMuted bg-neoBg px-2 py-1 brut-border flex-shrink-0">
              ESC
            </kbd>
          </div>

          <!-- Results -->
          <div class="max-h-72 overflow-y-auto">
            <div v-if="filteredResults.length === 0" class="px-4 py-8 text-center">
              <p class="text-xs font-black text-neoMuted uppercase tracking-wide">No results found</p>
            </div>

            <button
              v-for="(item, index) in filteredResults"
              :key="item.id"
              @click="executeAction(item)"
              @mouseenter="activeIndex = index"
              :class="[
                'w-full flex items-center gap-3 px-4 py-3 text-left transition-colors cursor-pointer',
                index === activeIndex
                  ? 'bg-neoYellow/30'
                  : 'hover:bg-neoYellow/10'
              ]"
              style="border-bottom: 1px solid var(--border-color);"
            >
              <span class="text-base flex-shrink-0">{{ item.icon }}</span>
              <span class="flex-1 text-sm font-bold text-ink">{{ item.label }}</span>
              <span class="text-[0.55rem] font-black uppercase tracking-wider text-neoMuted bg-neoBg brut-border px-1.5 py-0.5 flex-shrink-0">
                {{ getTypeLabel(item.type) }}
              </span>
            </button>
          </div>

          <!-- Footer hint -->
          <div class="flex items-center justify-between px-4 py-2.5" style="border-top: 2px solid var(--border-color);">
            <div class="flex items-center gap-2">
              <kbd class="text-[0.5rem] font-black text-neoMuted bg-neoBg px-1.5 py-0.5 brut-border">↑↓</kbd>
              <span class="text-[0.55rem] font-bold text-neoMuted uppercase">Navigate</span>
            </div>
            <div class="flex items-center gap-2">
              <kbd class="text-[0.5rem] font-black text-neoMuted bg-neoBg px-1.5 py-0.5 brut-border">↵</kbd>
              <span class="text-[0.55rem] font-bold text-neoMuted uppercase">Select</span>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </Teleport>
</template>
