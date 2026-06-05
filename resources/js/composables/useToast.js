import { ref } from 'vue'

const toasts = ref([])

let nextId = 1

/**
 * Add a toast notification.
 * @param {Object} options
 * @param {string} options.message   - Display text
 * @param {'success'|'error'|'info'} [options.type='success'] - Toast variant
 * @param {number} [options.duration=3500] - Auto-dismiss delay in ms
 */
function addToast({ message, type = 'success', duration = 3500 }) {
  const id = nextId++
  toasts.value.push({ id, message, type })

  setTimeout(() => {
    removeToast(id)
  }, duration)
}

function removeToast(id) {
  const idx = toasts.value.findIndex(t => t.id === id)
  if (idx !== -1) {
    toasts.value.splice(idx, 1)
  }
}

export function useToast() {
  return { toasts, addToast, removeToast }
}
