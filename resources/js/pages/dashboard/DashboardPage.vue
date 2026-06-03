<script setup>
import { computed, ref } from 'vue'
import StatsCard from '../../components/dashboard/StatsCard.vue'
import NeoButton from '../../components/ui/NeoButton.vue'

// Mock Data
const stats = ref({ total: 24, completed: 18, pending: 4, overdue: 2 })
const recentTasks = ref([
  { id: 1, title: 'Update UI components', status: 'Done' },
  { id: 2, title: 'Fix routing bug', status: 'In Progress' },
  { id: 3, title: 'Prepare presentation', status: 'To Do' }
])

const greeting = computed(() => {
  const hour = new Date().getHours()
  if (hour < 12) return 'Good morning'
  if (hour < 18) return 'Good afternoon'
  return 'Good evening'
})

const completionRate = computed(() => {
  if (stats.value.total === 0) return 0
  return Math.round((stats.value.completed / stats.value.total) * 100)
})
</script>

<template>
  <div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-black uppercase text-ink mb-2">
          {{ greeting }}, Admin.
        </h1>
        <p class="text-sm uppercase-label text-ink/60">
          Here is your team's current status.
        </p>
      </div>
      <NeoButton variant="primary">
        + New Task (N)
      </NeoButton>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <StatsCard title="Total Tasks" :count="stats.total" colorClass="bg-white" />
      <StatsCard title="Completed" :count="stats.completed" colorClass="bg-neoMint" />
      <StatsCard title="Pending" :count="stats.pending" colorClass="bg-neoYellow" />
      <StatsCard title="Overdue" :count="stats.overdue" colorClass="bg-neoPink" />
    </div>

    <!-- Completion Rate -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 brut-border brut-shadow bg-white p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-xl font-black uppercase text-ink">Daily Momentum</h2>
          <div class="text-4xl font-black text-neoIndigo">{{ completionRate }}%</div>
        </div>
        <div class="w-full bg-white brut-border h-4">
          <div
            class="h-full bg-neoIndigo transition-all duration-300"
            :style="{ width: completionRate + '%' }"
          ></div>
        </div>
      </div>

      <div class="brut-border brut-shadow bg-neoSidebar p-6">
        <p class="text-sm uppercase-label text-ink/60">Team Efficiency</p>
        <p class="text-3xl font-black text-ink mt-4">85%</p>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="brut-border brut-shadow bg-white p-6">
      <h2 class="text-xl font-black uppercase text-ink mb-4">Recent Activity</h2>
      <div class="space-y-3">
        <div
          v-for="task in recentTasks"
          :key="task.id"
          class="flex items-center justify-between pb-3 border-b-2 border-ink last:border-b-0"
        >
          <p class="font-black text-ink">{{ task.title }}</p>
          <span
            :class="[
              'uppercase-label px-3 py-1 brut-border',
              task.status === 'Done' ? 'bg-neoMint text-ink' : '',
              task.status === 'In Progress' ? 'bg-neoYellow text-ink' : '',
              task.status === 'To Do' ? 'bg-white text-ink' : ''
            ]"
          >
            {{ task.status }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
