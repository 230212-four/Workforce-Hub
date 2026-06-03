<script setup>
defineProps({ type: { type: String, default: 'button' }, variant: { type: String, default: 'primary' }, fullWidth: { type: Boolean, default: false } })
</script>
<template>
  <button :type="type" class="brut-border brut-shadow brut-hover uppercase-label px-6 py-3" :class="[fullWidth ? 'w-full' : '', variant === 'primary' ? 'bg-neoIndigo text-white' : '', variant === 'secondary' ? 'bg-white text-ink' : '']">
    <slot />
  </button>
</template>
