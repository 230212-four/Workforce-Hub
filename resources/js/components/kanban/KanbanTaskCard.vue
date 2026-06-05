<script setup>
const props = defineProps({
  task: { type: Object, required: true }
})

const emit = defineEmits(['click', 'dragstart'])

const getPriorityClass = (priority) => {
  const map = { high: 'badge-high', medium: 'badge-medium', low: 'badge-low' }
  return map[priority] || 'badge-medium'
}

const handleDragStart = (e) => {
  e.dataTransfer.effectAllowed = 'move'
  e.dataTransfer.setData('text/plain', props.task.id)
  e.target.classList.add('kanban-card-dragging')
  emit('dragstart', props.task.id)
}

const handleDragEnd = (e) => {
  e.target.classList.remove('kanban-card-dragging')
}
</script>

<template>
  <div
    class="bg-neoCard brut-border brut-shadow-sm p-3.5 cursor-grab brut-hover active:cursor-grabbing"
    draggable="true"
    @dragstart="handleDragStart"
    @dragend="handleDragEnd"
    @click="$emit('click', task)"
  >
    <p class="text-sm font-bold text-ink leading-tight mb-3">{{ task.title }}</p>

    <div class="flex items-center justify-between pt-2.5" style="border-top: 1px solid var(--border-color); opacity: 0.15;">
    </div>
    <div class="flex items-center justify-between">
      <span :class="getPriorityClass(task.priority)" class="flex-shrink-0">
        {{ task.priority.toUpperCase() }}
      </span>
      <span v-if="task.dueDate" class="text-[0.6rem] font-bold text-neoMuted uppercase">
        {{ task.dueDate }}
      </span>
    </div>
  </div>
</template>
