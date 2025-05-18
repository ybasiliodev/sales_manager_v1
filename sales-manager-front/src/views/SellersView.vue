<template>
    <div class="flex min-h-screen">
        <SideMenu />
        <div class="flex-1 p-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold mb-4">Vendedores</h1>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-auto">
                    Novo vendedor
                </button>
            </div>
            <DataTable />
        </div>
    </div>
</template>

<script setup>
import SideMenu from '../components/SideMenu.vue';
import DataTable from '../components/SellerDataTable.vue';
</script>

