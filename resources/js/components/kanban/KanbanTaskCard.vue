<script setup>
import NeoCard from '../ui/NeoCard.vue'

defineProps({
  task: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <NeoCard colorClass="bg-white" paddingClass="p-4" interactive>
    <div class="space-y-3">
      <div class="flex items-center justify-between">
        <span
          :class="[
            'text-xs uppercase-label px-2 py-1 brut-border',
            task.priority === 'High' ? 'bg-neoPink' : 'bg-neoYellow'
          ]"
        >
          {{ task.priority }}
        </span>
        <span class="text-xs font-black text-ink/50">{{ task.id }}</span>
      </div>

      <p class="font-black text-ink text-sm leading-tight">{{ task.title }}</p>

      <div class="pt-2 border-t-2 border-ink">
        <p class="text-xs uppercase-label text-ink/60">{{ task.assignee }}</p>
      </div>
    </div>
  </NeoCard>
</template>
