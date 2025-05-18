<template>
    <div :class="['sidebar', { collapsed }]">
        <!-- Botão para abrir/fechar o menu -->
        <div class="header">
            <button class="toggle-btn" @click="toggleSidebar">
                {{ collapsed ? '☰' : '×' }}
            </button>
        </div>

        <!-- Menu de navegação -->
        <ul v-show="!collapsed" class="menu">
            <li v-for="item in menuItems" :key="item.name">
                <a :href="item.link" :class="{ active: currentRoute === item.link }">
                    {{ item.name }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'

const collapsed = ref(false)
const emit = defineEmits(['update:collapsed'])

const toggleSidebar = () => {
    collapsed.value = !collapsed.value
}

watch(collapsed, (val) => {
    emit('update:collapsed', val)
})

const menuItems = ref([
    { name: 'Dashboard', link: '/' },
    { name: 'Usuários', link: '/usuarios' },
    { name: 'Configurações', link: '/configuracoes' }
])

const route = useRoute()
const currentRoute = ref(route.path)

watch(() => route.path, (newPath) => {
    currentRoute.value = newPath
})
</script>


<style scoped>
.sidebar {
    width: 220px;
    height: 100vh;
    background-color: #2c3e50;
    position: fixed;
    top: 0;
    left: 0;
    color: white;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    transition: width 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.sidebar.collapsed {
    width: 60px;
}

.header {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #1a252f;
}

.toggle-btn {
    font-size: 24px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex-grow: 1;
    overflow-y: auto;
}

.menu li {
    margin-bottom: 10px;
}

.menu a {
    display: block;
    padding: 12px 20px;
    color: white;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.menu a:hover {
    background-color: #34495e;
}

.menu a.active {
    background-color: #1abc9c;
    font-weight: bold;
}
</style>