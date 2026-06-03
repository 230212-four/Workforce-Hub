<script setup>
import Sidebar from './Sidebar.vue'
import Navbar from './Navbar.vue'
</script>
<template>
  <div class="flex h-screen bg-neoBg">
    <Sidebar/>
    <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">
      <Navbar/>
      <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
