<script setup>
import { ref, watch, computed } from 'vue'
import { renderMarkdown } from '../../composables/useMarkdown'

const props = defineProps({
  isOpen: { type: Boolean, default: false },
  task: { type: Object, default: null }
})

const emit = defineEmits(['close', 'save'])

const formData = ref({
  id: '',
  title: '',
  description: '',
  status: 'todo',
  priority: 'medium',
  dueDate: '',
  assignee: 'Admin'
})

// ── Markdown preview toggle ──
const showPreview = ref(false)

const parsedDescription = computed(() => {
  return renderMarkdown(formData.value.description)
})

const priorities = [
  { value: 'low', label: 'LOW', activeClass: 'bg-neoMint' },
  { value: 'medium', label: 'MEDIUM', activeClass: 'bg-neoYellow' },
  { value: 'high', label: 'HIGH', activeClass: 'bg-neoPink' }
]

const statuses = [
  { value: 'todo', label: 'TO DO' },
  { value: 'in-progress', label: 'IN PROGRESS' },
  { value: 'review', label: 'REVIEW' },
  { value: 'done', label: 'DONE' }
]

// Populate form when task prop changes
watch(() => props.task, (newTask) => {
  if (newTask) {
    formData.value = { ...newTask }
    showPreview.value = false
  }
}, { immediate: true })

const handleSubmit = () => {
  if (!formData.value.title.trim()) return
  emit('save', { ...formData.value })
}
</script>

<template>
  <transition name="modal">
    <div
      v-if="isOpen"
      class="fixed inset-0 z-[100] w-full h-full bg-black/50 flex items-center justify-center"
      @click.self="$emit('close')"
    >
      <div
        class="bg-neoCard brut-border brut-shadow w-full max-w-lg mx-4"
        @click.stop
      >
        <!-- Header -->
        <div class="flex items-center justify-between p-5 brut-border border-l-0 border-r-0 border-t-0">
          <h2 class="text-lg font-black uppercase tracking-wide text-ink">Edit Task</h2>
          <button
            @click="$emit('close')"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
          >✕</button>
        </div>

        <!-- Body -->
        <form @submit.prevent="handleSubmit" class="p-5 space-y-4">
          <!-- Title -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Task Title *</label>
            <input
              v-model="formData.title"
              type="text"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              placeholder="Enter task title"
              required
            />
          </div>

          <!-- Description with Edit/Preview toggle -->
          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label class="block text-xs font-black text-ink uppercase tracking-wide">Description</label>
              <div class="neo-toggle-group" style="border-width: 1px;">
                <button
                  type="button"
                  :class="[
                    'px-2 py-0.5 text-[0.55rem] font-black uppercase tracking-wide cursor-pointer transition-colors',
                    !showPreview ? 'bg-ink text-white' : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                  ]"
                  style="border: none; border-right: 1px solid var(--border-color);"
                  @click="showPreview = false"
                >
                  Edit
                </button>
                <button
                  type="button"
                  :class="[
                    'px-2 py-0.5 text-[0.55rem] font-black uppercase tracking-wide cursor-pointer transition-colors',
                    showPreview ? 'bg-ink text-white' : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                  ]"
                  style="border: none;"
                  @click="showPreview = true"
                >
                  Preview
                </button>
              </div>
            </div>

            <!-- Edit mode: textarea -->
            <textarea
              v-if="!showPreview"
              v-model="formData.description"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)] resize-none"
              placeholder="Supports **bold**, *italic*, # headings, - bullet lists"
              rows="4"
            ></textarea>

            <!-- Preview mode: rendered markdown -->
            <div
              v-else
              class="w-full px-3 py-2 brut-border bg-neoCard min-h-[6rem]"
            >
              <div
                v-if="parsedDescription"
                class="md-rendered"
                v-html="parsedDescription"
              ></div>
              <p v-else class="text-xs text-neoMuted italic py-2">
                No description to preview.
              </p>
            </div>
          </div>

          <!-- Priority (Horizontal Buttons) -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-2">Priority</label>
            <div class="flex gap-2">
              <button
                v-for="p in priorities"
                :key="p.value"
                type="button"
                @click="formData.priority = p.value"
                :class="[
                  'flex-1 px-3 py-2 brut-border font-black text-xs uppercase tracking-wide transition-all cursor-pointer',
                  formData.priority === p.value
                    ? p.activeClass + ' brut-shadow-sm text-ink'
                    : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                ]"
              >
                {{ p.label }}
              </button>
            </div>
          </div>

          <!-- Status (Horizontal Buttons) -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-2">Status</label>
            <div class="flex gap-2">
              <button
                v-for="s in statuses"
                :key="s.value"
                type="button"
                @click="formData.status = s.value"
                :class="[
                  'flex-1 px-2 py-2 brut-border font-black text-[0.6rem] uppercase tracking-wide transition-all cursor-pointer',
                  formData.status === s.value
                    ? 'bg-ink text-white brut-shadow-sm'
                    : 'bg-neoCard text-ink hover:bg-neoYellow/30'
                ]"
              >
                {{ s.label }}
              </button>
            </div>
          </div>

          <!-- Due Date -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Due Date</label>
            <input
              v-model="formData.dueDate"
              type="date"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
            />
          </div>

          <!-- Assignee -->
          <div>
            <label class="block text-xs font-black text-ink uppercase tracking-wide mb-1.5">Assignee</label>
            <input
              v-model="formData.assignee"
              type="text"
              class="w-full px-3 py-2 brut-border font-semibold text-ink bg-neoCard text-sm focus:outline-none focus:shadow-[3px_3px_0_0_var(--shadow-color)]"
              placeholder="Assignee name"
            />
          </div>
        </form>

        <!-- Footer -->
        <div class="flex items-center justify-end gap-3 p-5 brut-border border-l-0 border-r-0 border-b-0">
          <button
            @click="$emit('close')"
            class="px-5 py-2 brut-border font-black text-xs uppercase tracking-wide text-ink bg-neoCard brut-hover cursor-pointer hover:bg-neoPink/30"
          >
            Cancel
          </button>
          <button
            @click="handleSubmit"
            class="px-5 py-2 brut-border brut-shadow font-black text-xs uppercase tracking-wide text-white bg-ink brut-hover cursor-pointer"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>
