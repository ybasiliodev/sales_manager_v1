<template>
    <div class="app-layout">
      <Sidebar v-model:collapsed="sidebarCollapsed" />
      <main :class="['main-content', { expanded: sidebarCollapsed }]">
        <slot />
      </main>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import Sidebar from '../components/Sidebar.vue'
  
  const sidebarCollapsed = ref(false)
  </script>
  
  <style scoped>
  .app-layout {
    display: flex;
    min-height: 100vh;
  }
  
  .main-content {
    flex-grow: 1;
    padding: 20px;
    margin-left: 220px;
    transition: margin-left 0.3s ease;
  }
  
  /* Quando a sidebar estiver colapsada, reduzimos a margem para expandir conteúdo */
  .main-content.expanded {
    margin-left: 60px;
  }
  </style>
  