import { ref, watch } from 'vue'

const isDarkMode = ref(false)

// Initialize from localStorage
if (typeof window !== 'undefined') {
  const stored = localStorage.getItem('darkMode')
  if (stored !== null) {
    isDarkMode.value = JSON.parse(stored)
  } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
    isDarkMode.value = true
  }
}

// Watch for changes and update DOM
watch(isDarkMode, (newVal) => {
  if (typeof document !== 'undefined') {
    if (newVal) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
    localStorage.setItem('darkMode', JSON.stringify(newVal))
  }
}, { immediate: true })

export function useDarkMode() {
  const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value
  }

  return {
    isDarkMode,
    toggleDarkMode
  }
}
