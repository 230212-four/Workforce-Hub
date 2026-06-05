<script setup>
import { ref, inject } from 'vue'
import { useDarkMode } from '../../composables/useDarkMode'
import { useToast } from '../../composables/useToast'

const { isDarkMode, toggleDarkMode } = useDarkMode()
const { addToast } = useToast()

const simulateError = () => {
  addToast({
    message: 'Connection failed — could not save settings.',
    type: 'error',
    duration: 5000
  })
}
</script>

<template>
  <div class="space-y-6 max-w-2xl">
    <!-- Header -->
    <div>
      <h1 class="text-3xl font-black text-ink mb-1">Settings</h1>
      <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">Customize your application preferences.</p>
    </div>

    <!-- Settings Card -->
    <div class="bg-neoCard brut-border brut-shadow">
      <!-- Display Settings -->
      <div class="p-5 brut-border border-l-0 border-r-0 border-t-0">
        <h2 class="text-sm font-black uppercase tracking-wider text-ink mb-5">Display</h2>
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-bold text-ink text-sm">Dark Mode</h3>
            <p class="text-xs text-neoMuted mt-0.5">Enable dark theme for the application</p>
          </div>
          <!-- Toggle Switch -->
          <label class="relative inline-flex items-center cursor-pointer">
            <input
              type="checkbox"
              :checked="isDarkMode"
              @change="toggleDarkMode"
              class="sr-only peer"
            />
            <div class="w-14 h-8 bg-gray-300 peer-focus:outline-none brut-border peer-checked:after:translate-x-6 after:content-[''] after:absolute after:top-1 after:left-1 after:bg-neoCard after:brut-border after:h-6 after:w-6 after:transition-all peer-checked:bg-neoIndigo"></div>
          </label>
        </div>
      </div>

      <!-- General Settings -->
      <div class="p-5 brut-border border-l-0 border-r-0 border-t-0">
        <h2 class="text-sm font-black uppercase tracking-wider text-ink mb-5">General</h2>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Timezone</label>
            <select class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none">
              <option>UTC</option>
              <option>EST</option>
              <option>CST</option>
              <option>PST</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Language</label>
            <select class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none">
              <option>English</option>
              <option>Spanish</option>
              <option>French</option>
              <option>German</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Notification Settings -->
      <div class="p-5">
        <h2 class="text-sm font-black uppercase tracking-wider text-ink mb-5">Notifications</h2>
        <div class="space-y-3">
          <div class="flex items-center">
            <input type="checkbox" id="email-notif" checked class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="email-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Email Notifications</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="push-notif" checked class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="push-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Push Notifications</label>
          </div>
        <div class="flex items-center">
            <input type="checkbox" id="task-notif" checked class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="task-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Task Updates</label>
          </div>
        </div>

        <!-- Error Toast Demo -->
        <div class="mt-5 pt-5 brut-border border-l-0 border-r-0 border-b-0">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="font-bold text-ink text-sm">Error State Demo</h3>
              <p class="text-xs text-neoMuted mt-0.5">Simulate a failed server action to preview the error toast notification.</p>
            </div>
            <button
              id="simulate-error-btn"
              @click="simulateError"
              class="flex-shrink-0 px-4 py-2 brut-border font-black text-xs uppercase tracking-wide text-white bg-red-600 border-ink shadow-[3px_3px_0_0_#1a1a1a] hover:shadow-[5px_5px_0_0_#1a1a1a] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all cursor-pointer"
            >
              ⚠ Simulate Error
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end gap-3">
      <button class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30">Cancel</button>
      <button class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer">Save Changes</button>
    </div>
  </div>
</template>