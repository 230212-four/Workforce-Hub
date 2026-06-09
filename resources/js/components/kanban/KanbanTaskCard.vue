<script setup>
const props = defineProps({
  task: { type: Object, required: true },
  draggable: { type: Boolean, default: true },
  canDelete: { type: Boolean, default: false }
})

const emit = defineEmits(['click', 'dragstart', 'delete'])

const getPriorityClass = (priority) => {
  const map = { high: 'badge-high', medium: 'badge-medium', low: 'badge-low' }
  return map[priority] || 'badge-medium'
}

const handleDragStart = (e) => {
  if (!props.draggable) {
    e.preventDefault()
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
</script>

<template>
  <div
    :class="[
      'bg-neoCard brut-border brut-shadow-sm p-3.5 brut-hover',
      draggable ? 'cursor-grab active:cursor-grabbing' : 'cursor-default opacity-90'
    ]"
    :draggable="draggable"
    @dragstart="handleDragStart"
    @dragend="handleDragEnd"
    @click="$emit('click', task)"
  >
    <div class="flex items-start justify-between gap-3 mb-3">
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
