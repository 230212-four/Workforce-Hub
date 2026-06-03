<script setup>
import { ref } from 'vue'
import KanbanTaskCard from '../../components/kanban/KanbanTaskCard.vue'
import NeoButton from '../../components/ui/NeoButton.vue'

// Mock Data
const columns = ref([
  {
    id: 'todo',
    title: 'To Do',
    color: 'bg-neoPink',
    tasks: [
      { id: 'TSK-01', title: 'Design database schema', assignee: 'Jane Doe', priority: 'High' },
      { id: 'TSK-02', title: 'Setup API endpoints', assignee: 'John Smith', priority: 'Normal' }
    ]
  },
  {
    id: 'in-progress',
    title: 'In Progress',
    color: 'bg-neoYellow',
    tasks: [
      { id: 'TSK-03', title: 'Fix Vue router bug', assignee: 'Admin', priority: 'High' }
    ]
  },
  {
    id: 'done',
    title: 'Done',
    color: 'bg-neoMint',
    tasks: [
      { id: 'TSK-04', title: 'Create layout components', assignee: 'Jane Doe', priority: 'Normal' },
      { id: 'TSK-05', title: 'Initialize Tailwind v3', assignee: 'Admin', priority: 'Normal' }
    ]
  }
])
</script>

<template>
  <div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-black uppercase text-ink mb-2">
          Kanban Board
        </h1>
        <p class="text-sm uppercase-label text-ink/60">
          Manage project tasks and workflow.
        </p>
      </div>
      <NeoButton variant="primary">
        + Add Task
      </NeoButton>
    </div>

    <!-- Kanban Columns -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div
        v-for="column in columns"
        :key="column.id"
        class="flex flex-col"
      >
        <!-- Column Header -->
        <div
          :class="[
            column.color,
            'brut-border brut-shadow p-4 mb-4 flex items-center justify-between'
          ]"
        >
          <h2 class="font-black uppercase text-ink">{{ column.title }}</h2>
          <span class="bg-white brut-border px-3 py-1 font-black text-ink text-sm">
            {{ column.tasks.length }}
          </span>
        </div>

        <!-- Column Tasks -->
        <div class="space-y-3 flex-1">
          <KanbanTaskCard
            v-for="task in column.tasks"
            :key="task.id"
            :task="task"
          />
        </div>
      </div>
    </div>
  </div>
</template>
