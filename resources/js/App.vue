<script setup>
import AppLayout from './components/layout/AppLayout.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<template>
  <AppLayout v-if="route.meta.layout === 'app'">
    <router-view />
  </AppLayout>
  <router-view v-else />
</template>
