<script setup>
import { ref } from 'vue'

const formData = ref({
  firstName: 'Admin',
  lastName: 'User',
  email: 'admin@workforcehub.com',
  phone: '+1 (555) 123-4567',
  department: 'Management',
  role: 'Administrator'
})

const handleSave = () => {
  alert('Account settings saved successfully!')
}

const handlePasswordChange = () => {
  alert('Password change feature coming soon!')
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
          JD
        </div>
        <div>
          <h3 class="font-black text-ink uppercase text-sm mb-1">{{ formData.firstName }} {{ formData.lastName }}</h3>
          <button class="text-xs font-bold text-neoIndigo hover:underline cursor-pointer">Change Avatar</button>
        </div>
      </div>

      <!-- Personal Info -->
      <div class="mb-5">
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Personal Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">First Name</label>
            <input v-model="formData.firstName" type="text" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none" />
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Last Name</label>
            <input v-model="formData.lastName" type="text" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none" />
          </div>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="mb-5">
        <h3 class="text-sm font-black uppercase tracking-wider text-ink mb-4">Contact Information</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Email</label>
            <input v-model="formData.email" type="email" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none" />
          </div>
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Phone</label>
            <input v-model="formData.phone" type="tel" class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none" />
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
      <button class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30">Cancel</button>
      <button @click="handleSave" class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer">Save Changes</button>
    </div>
  </div>
</template>
