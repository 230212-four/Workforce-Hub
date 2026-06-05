<script setup>
defineProps({
  modelValue: { type: [String, Number], default: '' },
  label:      { type: String, required: true },
  type:       { type: String, default: 'text' },
  placeholder:{ type: String, default: '' },
  required:   { type: Boolean, default: false },
  /**
   * Validation error — pass a non-empty string to show the message,
   * or `true` for a generic error state without a message.
   */
  error:      { type: [String, Boolean], default: '' }
})
defineEmits(['update:modelValue'])
</script>

<template>
  <div class="flex flex-col gap-1">
    <label
      :class="['uppercase-label', error ? 'text-red-600' : 'text-ink']"
    >
      {{ label }}
    </label>
    <input
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :required="required"
      :placeholder="placeholder"
      :class="[
        'p-3 focus:outline-none transition-shadow w-full bg-neoCard font-semibold text-sm',
        error
          ? 'border-[3px] border-red-600 text-red-600 shadow-[3px_3px_0_0_#dc2626]'
          : 'brut-border brut-shadow-sm text-ink focus:shadow-[3px_3px_0_0_var(--shadow-color)]'
      ]"
    >
    <!-- Error message -->
    <span
      v-if="error && typeof error === 'string' && error.length"
      class="text-[0.6rem] font-black uppercase tracking-wide text-red-600 mt-0.5"
    >
      {{ error }}
    </span>
  </div>
</template>
