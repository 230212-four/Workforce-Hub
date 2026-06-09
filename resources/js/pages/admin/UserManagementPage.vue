<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

onMounted(() => {
  router.replace({ path: '/workspace', query: { tab: 'directory' } })
})
</script>

<template>
  <div class="space-y-4">
    <h1 class="text-3xl font-black text-ink">Redirecting...</h1>
    <p class="text-sm text-neoMuted font-medium">
      User management now lives inside Manage Workspace under the User Directory tab.
    </p>
  </div>
</template>
