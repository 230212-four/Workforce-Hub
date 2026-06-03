<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import NeoCard from '../../components/ui/NeoCard.vue'
import NeoInput from '../../components/ui/NeoInput.vue'
import NeoButton from '../../components/ui/NeoButton.vue'

const router = useRouter()
const form = reactive({ name: '', email: '', password: '', role: 'Employee' })

const handleRegister = () => {
  console.log("Mock Register Data:", form)
  router.push('/login')
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-neoBg p-4">
    <div class="w-full max-w-md">
      <NeoCard colorClass="bg-white" paddingClass="p-8">
        <div class="mb-8">
          <h1 class="text-3xl font-black uppercase text-ink mb-2">Create Account</h1>
          <p class="text-sm text-ink/60 uppercase-label">Join the team</p>
        </div>

        <form @submit.prevent="handleRegister" class="space-y-5">
          <NeoInput
            v-model="form.name"
            label="Full Name"
            type="text"
            placeholder="John Doe"
            required
          />
          <NeoInput
            v-model="form.email"
            label="Email Address"
            type="email"
            placeholder="john@example.com"
            required
          />
          <NeoInput
            v-model="form.password"
            label="Password"
            type="password"
            placeholder="••••••••"
            required
          />

          <div class="flex flex-col gap-1">
            <label class="uppercase-label text-ink">Account Role (Demo)</label>
            <select
              v-model="form.role"
              class="brut-border brut-shadow-sm bg-white text-ink p-3 focus:outline-none focus:brut-shadow transition-shadow w-full font-black uppercase-label"
            >
              <option value="Employee">Employee</option>
              <option value="Administrator">Administrator</option>
            </select>
          </div>

          <NeoButton type="submit" variant="primary" fullWidth>
            Register
          </NeoButton>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-ink/60">
            <router-link
              to="/login"
              class="font-black uppercase-label text-neoIndigo brut-hover inline-block"
            >
              Back to Login
            </router-link>
          </p>
        </div>
      </NeoCard>
    </div>
  </div>
</template>
