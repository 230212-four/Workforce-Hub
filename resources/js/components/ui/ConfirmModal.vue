<script setup>
import { watch, nextTick, ref } from 'vue'

const props = defineProps({
  isOpen: { type: Boolean, default: false },
  title: { type: String, default: 'Confirm Action' },
  message: { type: String, default: 'Are you sure?' },
  confirmLabel: { type: String, default: 'Confirm' },
  cancelLabel: { type: String, default: 'Cancel' },
  variant: { type: String, default: 'default' } // 'default' | 'danger'
})

const emit = defineEmits(['confirm', 'cancel'])
const cancelBtnRef = ref(null)

watch(() => props.isOpen, (val) => {
  if (val) {
    nextTick(() => cancelBtnRef.value?.focus())
  }
})

const handleKeydown = (e) => {
  if (e.key === 'Escape') emit('cancel')
}
</script>

<template>
  <Teleport to="body">
    <transition name="modal">
      <div
        v-if="isOpen"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm"
        @click.self="$emit('cancel')"
        @keydown="handleKeydown"
      >
        <div
          class="bg-neoCard w-full max-w-sm mx-4 brut-border brut-shadow"
          @click.stop
        >
          <!-- Header -->
          <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
            <div class="flex items-center gap-2">
              <span v-if="variant === 'danger'" class="text-lg">⚠️</span>
              <span v-else class="text-lg">❓</span>
              <h2 class="text-sm font-black uppercase tracking-wide text-ink">{{ title }}</h2>
            </div>
            <button
              @click="$emit('cancel')"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>

          <!-- Body -->
          <div class="p-5">
            <p class="text-sm font-semibold text-ink leading-relaxed" v-html="message"></p>
          </div>

          <!-- Footer -->
          <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
            <button
              ref="cancelBtnRef"
              @click="$emit('cancel')"
              class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
            >
              {{ cancelLabel }}
            </button>
            <button
              @click="$emit('confirm')"
              :class="[
                'px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide brut-hover cursor-pointer',
                variant === 'danger'
                  ? 'bg-destructive text-white hover:bg-destructive/80'
                  : 'bg-ink text-neoCard'
              ]"
            >
              {{ confirmLabel }}
            </button>
          </div>
        </div>
      </div>
    </transition>
  </Teleport>
</template>
