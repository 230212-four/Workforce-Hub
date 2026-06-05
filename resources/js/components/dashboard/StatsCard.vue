<script setup>
defineProps({
  title: { type: String, required: true },
  count: { type: Number, required: true },
  colorClass: { type: String, default: 'bg-white' },
  trend: { type: String, default: '↑ +12%' },
  period: { type: String, default: 'THIS WEEK' }
})
</script>

<template>
  <div :class="[colorClass, 'brut-border brut-shadow neo-stat-card']">
    <div class="stat-label">{{ title }}</div>
    <div class="stat-number">{{ count }}</div>
    <div class="stat-divider"></div>
    <div class="stat-footer">
      <span>{{ period }}</span>
      <span class="stat-trend">{{ trend }}</span>
    </div>
  </div>
</template>
