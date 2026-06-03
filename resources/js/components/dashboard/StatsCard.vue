<script setup>
import NeoCard from '../ui/NeoCard.vue'

defineProps({
  title: String,
  count: Number,
  colorClass: { type: String, default: 'bg-white' }
})
</script>

<template>
  <NeoCard :colorClass="colorClass" paddingClass="p-6">
    <div class="text-center">
      <p class="text-sm uppercase-label text-ink/60 mb-2">{{ title }}</p>
      <p class="text-4xl font-black text-ink">{{ count }}</p>
    </div>
  </NeoCard>
</template>
