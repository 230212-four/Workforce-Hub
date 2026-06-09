<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import NeoCard from '../../components/ui/NeoCard.vue'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'
import { useAuth } from '../../composables/useAuth'

const router = useRouter()
const { login } = useAuth()

const form = reactive({
  identifier: '',
  password: ''
})

const errors = reactive({
  identifier: '',
  password: '',
  form: ''
})

const isSubmitting = ref(false)

const clearErrors = () => {
  errors.identifier = ''
  errors.password = ''
  errors.form = ''
}

const handleLogin = async () => {
  clearErrors()
  isSubmitting.value = true

  try {
    await login({
      identifier: form.identifier.trim(),
      password: form.password
    })
    router.push('/dashboard')
  } catch (error) {
    const responseErrors = error?.response?.data?.errors || {}
    errors.identifier = responseErrors.identifier?.[0] || ''
    errors.password = responseErrors.password?.[0] || ''
    errors.form = error?.response?.data?.message || 'We could not sign you in right now.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-neoBg p-4">
    <div class="w-full max-w-md">
      <NeoCard colorClass="bg-white" paddingClass="p-8">
        <div class="mb-8">
          <h1 class="text-3xl font-black uppercase text-ink mb-2">Workforce Hub</h1>
          <p class="text-sm text-ink/60 uppercase-label">Sign in with your email or username</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-5">
          <NeoInput
            v-model="form.identifier"
            label="Email or Username"
            type="text"
            placeholder="name@company.com or username"
            :error="errors.identifier"
            required
          />
          <NeoInput
            v-model="form.password"
            label="Password"
            type="password"
            placeholder="••••••••"
            hint="Required: minimum 8 characters."
            :error="errors.password"
            required
          />

          <p
            v-if="errors.form"
            class="text-sm font-medium text-red-600 bg-red-50 border-[3px] border-red-600 px-4 py-3"
          >
            {{ errors.form }}
          </p>

          <NeoButton type="submit" variant="primary" fullWidth :disabled="isSubmitting">
            {{ isSubmitting ? 'Signing In...' : 'Sign In' }}
          </NeoButton>
        </form>

        <div class="mt-6 space-y-3 text-center">
          <router-link
            to="/register"
            class="inline-flex items-center justify-center w-full brut-border brut-shadow-sm bg-neoCard px-4 py-3 font-black uppercase-label text-neoIndigo brut-hover"
          >
            Register Admin
          </router-link>
          <p class="text-sm text-ink/60">
            Employee accounts are created by administrators after sign in.
          </p>
        </div>
      </NeoCard>
    </div>
  </div>
</template>
