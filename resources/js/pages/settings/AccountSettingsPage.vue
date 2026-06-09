<script setup>
import { computed, ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuth } from '../../composables/useAuth'
import { useToast } from '../../composables/useToast'
import AccountSettingsModal from '../../components/settings/AccountSettingsModal.vue'

const { currentUser, syncCurrentUser } = useAuth()
const { addToast } = useToast()

const isSaving = ref(false)
const showPasswordModal = ref(false)

const formData = ref({
  name: '',
  email: '',
  phone: '',
  department: '',
  role: ''
})

function loadFromUser() {
  const user = currentUser.value
  if (!user) return
  formData.value.name = user.name || ''
  formData.value.email = user.email || ''
  formData.value.phone = user.phone || ''
  formData.value.department = user.department || user.team?.name || ''
  formData.value.role = user.role || 'user'
}

onMounted(() => {
  loadFromUser()
})

const profileInitials = computed(() => {
  const name = formData.value.name || ''
  return name.split(/\s+/).filter(Boolean).map(part => part[0]).join('').toUpperCase().slice(0, 2)
})

const handleSave = async () => {
  isSaving.value = true
  try {
    await axios.put('/api/me', {
      name: formData.value.name,
      email: formData.value.email,
      phone: formData.value.phone || null
    })
    await syncCurrentUser()
    addToast({ message: 'Profile updated.', type: 'success' })
  } catch (error) {
    const msg = error?.response?.data?.message || 'Unable to update profile.'
    addToast({ message: msg, type: 'error' })
  } finally {
    isSaving.value = false
  }
}

const cancelChanges = () => {
  loadFromUser()
  addToast({ message: 'Changes reverted.', type: 'info', duration: 2000 })
}

const handlePasswordChange = () => {
  showPasswordModal.value = true
}
</script>

<template>
  <div class="space-y-6 max-w-2xl">
    <!-- Header -->
    <div>
      <h1 class="text-3xl font-black text-ink mb-1">Account Settings</h1>
      <p class="text-xs font-bold text-neoMuted uppercase tracking-wide">Manage your profile and account information.</p>
    </div>

    <!-- Profile Card -->
    <div class="bg-neoCard brut-border brut-shadow p-5">
      <!-- Avatar -->
      <div class="flex items-center gap-5 pb-5 brut-border border-l-0 border-r-0 border-t-0 mb-5">
        <div class="h-16 w-16 brut-border brut-shadow-sm bg-neoPink flex items-center justify-center text-ink font-black text-xl flex-shrink-0">
          {{ profileInitials || '—' }}
        </div>
        <div>
          <h3 class="font-black text-ink uppercase text-sm mb-1">{{ formData.name || 'Account Profile' }}</h3>
          <p class="text-[0.65rem] font-bold text-neoMuted uppercase tracking-wide">{{ formData.role }}</p>
        </div>
      </div>

      <!-- Personal Info -->
      <div class="mb-5">
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Personal Information</h3>
        <div>
          <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Full Name</label>
          <input v-model="formData.name" type="text" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]" />
        </div>
      </div>

      <!-- Contact Info -->
      <div class="mb-5">
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Contact Information</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Email</label>
            <input v-model="formData.email" type="email" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]" />
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Phone</label>
            <input v-model="formData.phone" type="tel" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]" />
          </div>
        </div>
      </div>

      <!-- Organization -->
      <div class="mb-5 pb-5 brut-border border-l-0 border-r-0 border-t-0">
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Organization</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Department</label>
            <input v-model="formData.department" type="text" disabled class="w-full px-3 py-2 brut-border font-semibold text-neoMuted bg-neoCard text-sm opacity-60" />
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Role</label>
            <input v-model="formData.role" type="text" disabled class="w-full px-3 py-2 brut-border font-semibold text-neoMuted bg-neoCard text-sm opacity-60" />
          </div>
        </div>
      </div>

      <!-- Security -->
      <div>
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Security</h3>
        <button
          @click="handlePasswordChange"
          class="px-5 py-2 brut-border brut-shadow-sm font-bold text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer"
        >
          Change Password
        </button>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end gap-3">
      <button
        @click="cancelChanges"
        class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
      >Cancel</button>
      <button
        @click="handleSave"
        :disabled="isSaving"
        class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed"
      >{{ isSaving ? 'Saving...' : 'Save Changes' }}</button>
    </div>

    <!-- Password Change Modal -->
    <AccountSettingsModal
      :isOpen="showPasswordModal"
      @close="showPasswordModal = false"
    />
  </div>
</template>
