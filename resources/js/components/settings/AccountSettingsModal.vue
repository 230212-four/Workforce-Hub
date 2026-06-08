<script setup>
import { ref, computed } from 'vue'
import { useToast } from '../../composables/useToast'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close'])

const { addToast } = useToast()

// ── Form state ──────────────────────────────────────────────────────────────
const currentPassword = ref('')
const newPassword      = ref('')
const confirmPassword  = ref('')
const error            = ref('')

// ── Validation ──────────────────────────────────────────────────────────────
const isValid = computed(() =>
  currentPassword.value.trim().length > 0 &&
  newPassword.value.trim().length > 0 &&
  confirmPassword.value.trim().length > 0
)

const reset = () => {
  currentPassword.value = ''
  newPassword.value      = ''
  confirmPassword.value  = ''
  error.value            = ''
}

const close = () => {
  reset()
  emit('close')
}

const saveChanges = () => {
  error.value = ''

  if (!currentPassword.value.trim()) {
    error.value = 'Current password is required.'
    return
  }
  if (newPassword.value.length < 6) {
    error.value = 'New password must be at least 6 characters.'
    return
  }
  if (newPassword.value !== confirmPassword.value) {
    error.value = 'Passwords do not match.'
    return
  }

  // ── Mock success ─────────────────────────────────────────────────────────
  addToast({ message: 'PASSWORD UPDATED', type: 'success', duration: 3500 })
  close()
}
</script>

<template>
  <transition name="modal">
    <div
      v-if="isOpen"
      class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm"
      @click.self="close"
    >
      <div
        class="bg-neoCard w-full max-w-md mx-4 brut-border brut-shadow"
        @click.stop
      >
        <!-- ── Header ───────────────────────────────────────────────────── -->
        <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
          <div>
            <h2 class="text-lg font-black uppercase tracking-wide text-ink">
              Account Settings
            </h2>
            <p class="text-[0.6rem] font-black uppercase tracking-widest text-neoMuted mt-0.5">
              Change your login password
            </p>
          </div>
          <button
            id="account-settings-close"
            @click="close"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
          >✕</button>
        </div>

        <!-- ── Body ────────────────────────────────────────────────────── -->
        <div class="p-5 space-y-4">

          <!-- Error banner -->
          <div
            v-if="error"
            class="flex items-center gap-2 p-3 bg-destructive/10 brut-border border-destructive"
          >
            <span class="text-destructive text-xs font-black uppercase tracking-wide">⚠ {{ error }}</span>
          </div>

          <!-- Current Password -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
              Current Password *
            </label>
            <input
              v-model="currentPassword"
              type="password"
              id="current-password"
              class="w-full px-3 py-2.5 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              placeholder="Enter current password"
              autocomplete="current-password"
            />
          </div>

          <!-- Divider -->
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full h-px bg-neoBorder opacity-30"></div>
            </div>
            <div class="relative flex justify-center">
              <span class="px-2 bg-neoCard text-[0.6rem] font-black uppercase tracking-widest text-neoMuted">
                New Password
              </span>
            </div>
          </div>

          <!-- New Password -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
              New Password *
            </label>
            <input
              v-model="newPassword"
              type="password"
              id="new-password"
              class="w-full px-3 py-2.5 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              placeholder="Minimum 6 characters"
              autocomplete="new-password"
            />
          </div>

          <!-- Confirm New Password -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">
              Confirm New Password *
            </label>
            <input
              v-model="confirmPassword"
              type="password"
              id="confirm-password"
              class="w-full px-3 py-2.5 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              :class="confirmPassword && newPassword !== confirmPassword
                ? '!border-destructive shadow-[3px_3px_0_0_#fb7185]'
                : ''"
              placeholder="Re-enter new password"
              autocomplete="new-password"
            />
            <p
              v-if="confirmPassword && newPassword !== confirmPassword"
              class="mt-1 text-[0.6rem] font-black uppercase tracking-wide text-destructive"
            >
              Passwords do not match
            </p>
          </div>

          <!-- Password strength hint -->
          <div class="bg-neoYellow/20 brut-border p-3 flex items-start gap-2">
            <span class="text-sm flex-shrink-0">💡</span>
            <p class="text-xs font-bold text-ink">
              Use at least <span class="font-black">6 characters</span>, mixing letters, numbers, and symbols for a strong password.
            </p>
          </div>
        </div>

        <!-- ── Footer ──────────────────────────────────────────────────── -->
        <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
          <button
            @click="close"
            class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
          >
            Cancel
          </button>
          <button
            id="save-password-btn"
            @click="saveChanges"
            :disabled="!isValid"
            class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-neoCard bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>
