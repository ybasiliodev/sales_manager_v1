<template>
    <div class="flex">
        <!-- Sidebar -->
        <aside :class="[
            'h-screen bg-gray-800 text-white transition-all duration-300 ease-in-out',
            collapsed ? 'w-16' : 'w-64'
        ]" class="flex flex-col">
            <!-- Toggle Button -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <span v-if="!collapsed" class="text-lg font-bold">Menu</span>
                <button @click="toggleSidebar" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg v-if="collapsed" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-2 p-4">
                <RouterLink to="/dashboard" class="flex items-center space-x-3 hover:bg-gray-700 rounded p-2">
                    <span v-if="!collapsed">Vendas</span>
                </RouterLink>
                <RouterLink to="/sellers" class="flex items-center space-x-3 hover:bg-gray-700 rounded p-2">
                    <span v-if="!collapsed">Vendedores</span>
                </RouterLink>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const collapsed = ref(false)

const toggleSidebar = () => {
    collapsed.value = !collapsed.value
}
</script>