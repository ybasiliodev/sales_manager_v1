<template>
  <div class="flex min-h-screen">
    <SideMenu />
    <div class="flex-1 p-4">
      <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
      <DataTable />
    </div>
  </div>
</template>

<script setup>
import SideMenu from '../components/SideMenu.vue';
import DataTable from '../components/DataTable.vue';
</script>