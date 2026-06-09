<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useDarkMode } from '../../composables/useDarkMode'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'

const { isDarkMode, toggleDarkMode } = useDarkMode()
const { currentUser } = useAuth()
const { addToast } = useToast()

const isSaving = ref(false)

const timezoneOptions = ['UTC', 'EST', 'CST', 'PST', 'GMT', 'CET', 'IST', 'JST', 'AEST']
const languageOptions = [
  { value: 'en', label: 'English' },
  { value: 'es', label: 'Spanish' },
  { value: 'fr', label: 'French' },
  { value: 'de', label: 'German' }
]

// ── Preferences state ──
const timezone = ref('UTC')
const language = ref('en')
const emailNotif = ref(true)
const pushNotif = ref(true)
const taskUpdates = ref(true)

function loadFromUser() {
  const prefs = currentUser.value?.preferences || {}
  timezone.value = prefs.timezone || 'UTC'
  language.value = prefs.language || 'en'
  emailNotif.value = prefs.notifications?.email ?? true
  pushNotif.value = prefs.notifications?.push ?? true
  taskUpdates.value = prefs.notifications?.task_updates ?? true
}

onMounted(() => {
  loadFromUser()
})

const savePreferences = async () => {
  isSaving.value = true
  try {
    await axios.put('/api/me/preferences', {
      timezone: timezone.value,
      language: language.value,
      notifications: {
        email: emailNotif.value,
        push: pushNotif.value,
        task_updates: taskUpdates.value
      }
    })
    addToast({ message: 'Preferences saved.', type: 'success' })
  } catch (error) {
    addToast({ message: error?.response?.data?.message || 'Unable to save preferences.', type: 'error' })
  } finally {
    isSaving.value = false
  }
}

const cancelChanges = () => {
  loadFromUser()
  addToast({ message: 'Changes reverted.', type: 'info', duration: 2000 })
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
            <select v-model="timezone" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none">
              <option v-for="tz in timezoneOptions" :key="tz" :value="tz">{{ tz }}</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Language</label>
            <select v-model="language" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none">
              <option v-for="lang in languageOptions" :key="lang.value" :value="lang.value">{{ lang.label }}</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Notification Settings -->
      <div class="p-5">
        <h2 class="text-sm font-black uppercase tracking-wider text-ink mb-5">Notifications</h2>
        <div class="space-y-3">
          <div class="flex items-center">
            <input type="checkbox" id="email-notif" v-model="emailNotif" class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="email-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Email Notifications</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="push-notif" v-model="pushNotif" class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="push-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Push Notifications</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="task-notif" v-model="taskUpdates" class="w-4 h-4 brut-border bg-neoCard accent-neoIndigo" />
            <label for="task-notif" class="ml-3 text-sm font-semibold text-ink normal-case tracking-normal">Task Updates</label>
          </div>
        </div>
      </div>
    </div>

    <!-- Save / Cancel Buttons -->
    <div class="flex justify-end gap-3">
      <button
        @click="cancelChanges"
        class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
      >Cancel</button>
      <button
        @click="savePreferences"
        :disabled="isSaving"
        class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
      >{{ isSaving ? 'Saving...' : 'Save Changes' }}</button>
    </div>
  </div>
</template>