<template>
  <aside class="w-64 h-screen bg-neoSidebar brut-border border-t-0 border-l-0 border-b-0 flex flex-col hidden md:flex fixed z-20">
    <div class="h-16 flex items-center justify-center bg-white brut-border border-l-0 border-t-0 border-r-0">
      <h1 class="text-xl font-black uppercase tracking-tight text-ink">Workforce Hub</h1>
    </div>
    <nav class="flex-1 py-6 px-4 space-y-3">
      <router-link to="/dashboard" class="flex items-center space-x-3 px-4 py-3 bg-white brut-border brut-shadow brut-hover font-black text-ink uppercase-label">Dashboard</router-link>
      <router-link to="/kanban" class="flex items-center space-x-3 px-4 py-3 bg-white brut-border brut-shadow brut-hover font-black text-ink uppercase-label">Kanban</router-link>
    </nav>
  </aside>
</template>
