<script setup>
import { computed } from 'vue'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'
import { renderMarkdownTruncated } from '../../composables/useMarkdown'

const props = defineProps({
  task: { type: Object, required: true },
  isSelected: { type: Boolean, default: false },
  draggable: { type: Boolean, default: true },
  canDelete: { type: Boolean, default: false }
})

const emit = defineEmits(['click', 'dragstart', 'delete', 'move-left', 'move-right'])

const { currentUser, isAdmin } = useAuth()
const { addToast } = useToast()

const getPriorityClass = (priority) => {
  const map = { high: 'badge-high', medium: 'badge-medium', low: 'badge-low' }
  return map[priority] || 'badge-medium'
}

// ── Markdown snippet for description ──
const descriptionHtml = computed(() => {
  if (!props.task.description) return ''
  return renderMarkdownTruncated(props.task.description, 80)
})

// ── Permission-guarded drag ──
const handleDragStart = (e) => {
  if (!props.draggable) {
    e.preventDefault()
    return
  }

  // If user role and task is NOT assigned to them → deny
  if (!isAdmin.value && props.task.assignedTo !== currentUser.value.name) {
    e.preventDefault()
    addToast({
      message: 'Permission Denied: You can only move your own tasks.',
      type: 'error'
    })
    return
  }

  e.dataTransfer.effectAllowed = 'move'
  e.dataTransfer.setData('text/plain', props.task.id)
  e.currentTarget.classList.add('kanban-card-dragging')
  emit('dragstart', props.task.id)
}

const handleDragEnd = (e) => {
  e.currentTarget.classList.remove('kanban-card-dragging')
}

const handleDelete = (e) => {
  e.stopPropagation()
  emit('delete', props.task)
}

// ── Keyboard navigation: Arrow keys move columns ──
const handleKeydown = (e) => {
  if (e.key === 'ArrowLeft') {
    e.preventDefault()
    emit('move-left', props.task.id)
  } else if (e.key === 'ArrowRight') {
    e.preventDefault()
    emit('move-right', props.task.id)
  }
}
</script>

<template>
  <div
    :class="[
      'bg-neoCard brut-border brut-shadow-sm p-3.5 brut-hover kanban-card-focus',
      draggable ? 'cursor-grab active:cursor-grabbing' : 'cursor-default opacity-90',
      isSelected ? 'kanban-card-selected' : ''
    ]"
    :draggable="draggable"
    tabindex="0"
    :data-task-id="task.id"
    @dragstart="handleDragStart"
    @dragend="handleDragEnd"
    @click="$emit('click', task)"
    @keydown="handleKeydown"
  >
    <div class="flex items-start justify-between gap-3 mb-1">
      <p class="text-sm font-bold text-ink leading-tight">{{ task.title }}</p>
      <button
        v-if="canDelete"
        type="button"
        class="w-7 h-7 brut-border bg-white text-ink font-black brut-hover flex-shrink-0"
        title="Delete task"
        @click="handleDelete"
      >
        x
      </button>
    </div>

    <!-- Markdown description snippet -->
    <div
      v-if="descriptionHtml"
      class="md-snippet mb-2"
      v-html="descriptionHtml"
    ></div>

    <div class="flex items-center justify-between pt-2.5" style="border-top: 1px solid var(--border-color); opacity: 0.15;"></div>

    <div class="flex flex-wrap items-center justify-between gap-2">
      <span :class="getPriorityClass(task.priority)" class="flex-shrink-0">
        {{ task.priority.toUpperCase() }}
      </span>
      <span v-if="task.dueDate" class="text-[0.6rem] font-bold text-neoMuted uppercase">
        {{ task.dueDate }}
      </span>
    </div>

    <p class="mt-2 text-[0.65rem] font-black uppercase tracking-wide text-neoMuted">
      {{ task.assigneeSummary || 'Add a Member' }}
    </p>
  </div>
</template>
