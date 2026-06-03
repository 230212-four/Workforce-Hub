<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import NeoCard from '../../components/ui/NeoCard.vue'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'

const router = useRouter()
const form = reactive({ email: '', password: '' })

const handleLogin = () => {
  console.log("Mock Login Data:", form)
  router.push('/dashboard') // Temporarily route straight to dashboard
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-neoBg p-4">
    <div class="w-full max-w-md">
      <NeoCard colorClass="bg-white" paddingClass="p-8">
        <div class="mb-8">
          <h1 class="text-3xl font-black uppercase text-ink mb-2">Workforce Hub</h1>
          <p class="text-sm text-ink/60 uppercase-label">Sign in to continue</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-5">
          <NeoInput
            v-model="form.email"
            label="Email Address"
            type="email"
            placeholder="admin@example.com"
            required
          />
          <NeoInput
            v-model="form.password"
            label="Password"
            type="password"
            placeholder="••••••••"
            required
          />

          <NeoButton type="submit" variant="primary" fullWidth>
            Sign In
          </NeoButton>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-ink/60">
            Need an account?
            <router-link
              to="/register"
              class="font-black uppercase-label text-neoIndigo brut-hover inline-block"
            >
              Register
            </router-link>
          </p>
        </div>
      </NeoCard>
    </div>
  </div>
</template>
