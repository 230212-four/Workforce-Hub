<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import NeoCard from '../../components/ui/NeoCard.vue'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'
import { useAuth } from '../../composables/useAuth'

const router = useRouter()
const { registerAdmin } = useAuth()

const form = reactive({
  name: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const errors = reactive({
  name: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  form: ''
})

const isSubmitting = ref(false)

const clearErrors = () => {
  errors.name = ''
  errors.username = ''
  errors.email = ''
  errors.password = ''
  errors.password_confirmation = ''
  errors.form = ''
}

const handleRegister = async () => {
  clearErrors()
  isSubmitting.value = true

  try {
    await registerAdmin({
      name: form.name.trim(),
      username: form.username.trim(),
      email: form.email.trim(),
      password: form.password,
      password_confirmation: form.password_confirmation
    })

    router.push('/login')
  } catch (error) {
    const responseErrors = error?.response?.data?.errors || {}
    errors.name = responseErrors.name?.[0] || ''
    errors.username = responseErrors.username?.[0] || ''
    errors.email = responseErrors.email?.[0] || ''
    errors.password = responseErrors.password?.[0] || ''
    errors.password_confirmation = responseErrors.password_confirmation?.[0] || ''
    errors.form = error?.response?.data?.message || 'We could not create the administrator account.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-neoBg p-4">
    <div class="w-full max-w-2xl">
      <NeoCard colorClass="bg-white" paddingClass="p-8">
        <div class="mb-8">
          <p class="text-xs font-black uppercase tracking-[0.2em] text-neoIndigo mb-3">Admin Registration</p>
          <h1 class="text-3xl font-black uppercase text-ink mb-2">Create Admin Access</h1>
          <p class="text-sm text-ink/60 uppercase-label">
            This form creates administrator accounts only. Employee accounts are created later from the admin user management screen.
          </p>
        </div>

        <form @submit.prevent="handleRegister" class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <NeoInput
            v-model="form.name"
            label="Full Name"
            type="text"
            placeholder="Full name"
            :error="errors.name"
            required
          />
          <NeoInput
            v-model="form.username"
            label="Username"
            type="text"
            placeholder="admin_name"
            :error="errors.username"
            required
          />
          <NeoInput
            v-model="form.email"
            label="Email Address"
            type="email"
            placeholder="name@company.com"
            :error="errors.email"
            required
          />
          <div class="md:col-span-2">
            <NeoInput
              v-model="form.password"
              label="Password"
              type="password"
              placeholder="••••••••"
              hint="Required: 8+ characters, uppercase, lowercase, number, and special character."
              :error="errors.password"
              required
            />
          </div>
          <div class="md:col-span-2">
            <NeoInput
              v-model="form.password_confirmation"
              label="Confirm Password"
              type="password"
              placeholder="••••••••"
              :error="errors.password_confirmation"
              required
            />
          </div>

          <p
            v-if="errors.form"
            class="md:col-span-2 text-sm font-medium text-red-600 bg-red-50 border-[3px] border-red-600 px-4 py-3"
          >
            {{ errors.form }}
          </p>

          <div class="md:col-span-2 flex flex-col sm:flex-row gap-3 sm:justify-between sm:items-center">
            <router-link
              to="/login"
              class="inline-flex items-center justify-center brut-border brut-shadow-sm bg-neoCard px-5 py-3 font-black uppercase-label text-ink brut-hover"
            >
              Back to Login
            </router-link>
            <NeoButton type="submit" variant="primary" :fullWidth="false" :disabled="isSubmitting">
              {{ isSubmitting ? 'Creating Account...' : 'Create Admin Account' }}
            </NeoButton>
          </div>
        </form>
      </NeoCard>
    </div>
  </div>
</template>
