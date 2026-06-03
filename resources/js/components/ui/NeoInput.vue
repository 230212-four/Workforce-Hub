<script setup>
defineProps({ modelValue: { type: [String, Number], default: '' }, label: { type: String, required: true }, type: { type: String, default: 'text' }, placeholder: { type: String, default: '' }, required: { type: Boolean, default: false } })
defineEmits(['update:modelValue'])
</script>
<template>
  <div class="flex flex-col gap-1">
    <label class="uppercase-label text-ink">{{ label }}</label>
    <input :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :required="required" :placeholder="placeholder" class="brut-border brut-shadow-sm bg-input-background text-ink p-3 focus:outline-none focus:brut-shadow transition-shadow w-full">
  </div>
</template>
