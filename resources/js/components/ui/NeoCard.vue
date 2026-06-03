<script setup>
defineProps({ colorClass: { type: String, default: 'bg-white' }, paddingClass: { type: String, default: 'p-6' }, interactive: { type: Boolean, default: false } })
</script>
<template>
  <div class="brut-border" :class="[colorClass, paddingClass, interactive ? 'brut-shadow brut-hover cursor-pointer' : 'brut-shadow']">
    <slot />
  </div>
</template>
