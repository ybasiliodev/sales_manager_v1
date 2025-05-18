<template>
  <AppLayout>
    <div class="p-4">
      <h1 class="text-2xl font-bold mb-4">Listagem de Vendas</h1>

      <div class="mb-4 flex items-center gap-4">
        <label>Vendedor:</label>
        <select v-model="selectedSeller" @change="fetchSales" class="border rounded px-2 py-1">
          <option value="">Todos</option>
          <option v-for="seller in sellers" :key="seller.id" :value="seller.id">
            {{ seller.name }}
          </option>
        </select>

        <label>Itens por página:</label>
        <select v-model="itemsPerPage" @change="fetchSales" class="border rounded px-2 py-1">
          <option :value="5">5</option>
          <option :value="10">10</option>
          <option :value="20">20</option>
        </select>
      </div>

      <table class="w-full border">
        <thead class="bg-gray-100">
          <tr>
            <th class="border p-2">ID</th>
            <th class="border p-2">Descrição</th>
            <th class="border p-2">Vendedor</th>
            <th class="border p-2">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in sales" :key="sale.id">
            <td class="border p-2">{{ sale.id }}</td>
            <td class="border p-2">{{ sale.description }}</td>
            <td class="border p-2">{{ sale.seller.name }}</td>
            <td class="border p-2">R$ {{ sale.value }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Paginação -->
      <div class="mt-4 flex gap-2">
        <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
          class="border px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">
          Anterior
        </button>
        <span>Página {{ currentPage }} de {{ totalPages }}</span>
        <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
          class="border px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">
          Próxima
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../axios'
import AppLayout from '../views/AppLayout.vue'

interface Seller {
  id: number
  name: string
}

interface Sale {
  id: number
  description: string
  value: number
  seller: Seller
}

const sales = ref<Sale[]>([])
const sellers = ref<Seller[]>([])
const selectedSeller = ref<string | number>('')
const itemsPerPage = ref(5)
const currentPage = ref(1)
const totalPages = ref(1)

async function fetchSellers() {
  try {
    const response = await api.get('http://localhost:8080/api/v1/sellers')
    sellers.value = response.data
  } catch (error) {
    console.error('Erro ao buscar vendedores:', error)
  }
}

async function fetchSales() {
  try {
    let url = `/sales?page=${currentPage.value}&per_page=${itemsPerPage.value}`

    if (selectedSeller.value) {
      url = `/sales/seller/${selectedSeller.value}?page=${currentPage.value}&per_page=${itemsPerPage.value}`
    }

    const response = await api.get(url)
    sales.value = response.data.data
    totalPages.value = response.data.last_page
    currentPage.value = response.data.current_page
  } catch (error) {
    console.error('Erro ao buscar vendas:', error)
  }
}

function changePage(page: number) {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
    fetchSales()
  }
}

onMounted(() => {
  fetchSellers()
  fetchSales()
})
</script>