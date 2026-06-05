<script setup>
import { useToast } from '../../composables/useToast'

const { toasts, removeToast } = useToast()
</script>

<template>
  <!-- Fixed bottom-right toast stack — above everything (z-[200]) -->
  <div
    class="fixed bottom-6 right-6 z-[200] flex flex-col gap-3 pointer-events-none"
    aria-live="polite"
    aria-atomic="false"
  >
    <transition-group name="toast" tag="div" class="flex flex-col gap-3">
      <div
        v-for="toast in toasts"
        :key="toast.id"
        :class="[
          'pointer-events-auto flex items-center gap-3 px-4 py-3 min-w-[260px] max-w-sm',
          'font-black text-xs uppercase tracking-wide',
          // Neo-Brutalist border + shadow — variant-specific colours
          toast.type === 'error'
            ? 'bg-red-600 text-white border-[3px] border-ink shadow-[4px_4px_0_0_#1a1a1a]'
            : toast.type === 'info'
              ? 'bg-neoYellow text-ink border-[3px] border-ink shadow-[4px_4px_0_0_#1a1a1a]'
              : 'bg-neoMint text-ink border-[3px] border-ink shadow-[4px_4px_0_0_#1a1a1a]'
        ]"
        role="alert"
      >
        <!-- Icon -->
        <span class="flex-shrink-0 text-base leading-none">
          <svg v-if="toast.type === 'error'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
            <circle cx="12" cy="12" r="10" /><line x1="15" y1="9" x2="9" y2="15" /><line x1="9" y1="9" x2="15" y2="15" />
          </svg>
          <svg v-else-if="toast.type === 'info'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
            <circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" />
          </svg>
          <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </span>

        <!-- Message -->
        <span class="flex-1 leading-snug">{{ toast.message }}</span>

        <!-- Dismiss button -->
        <button
          @click="removeToast(toast.id)"
          :class="[
            'flex-shrink-0 w-6 h-6 flex items-center justify-center border-2 cursor-pointer transition-opacity hover:opacity-70',
            toast.type === 'error' ? 'border-white/60 text-white' : 'border-ink/40 text-ink'
          ]"
          aria-label="Dismiss"
        >
          ✕
        </button>
      </div>
    </transition-group>
  </div>
</template>
