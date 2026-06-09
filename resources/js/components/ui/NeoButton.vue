<script setup>
defineProps({
  type: { type: String, default: 'button' },
  variant: { type: String, default: 'primary' },
  fullWidth: { type: Boolean, default: false },
  disabled: { type: Boolean, default: false }
})
</script>
<template>
  <button
    :type="type"
    :disabled="disabled"
    class="brut-border brut-shadow brut-hover uppercase-label px-6 py-3 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
    :class="[fullWidth ? 'w-full' : '', variant === 'primary' ? 'bg-neoIndigo text-white' : '', variant === 'secondary' ? 'bg-white text-ink' : '']"
  >
    <slot />
  </button>
</template>
