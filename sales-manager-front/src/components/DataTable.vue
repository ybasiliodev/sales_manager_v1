<template>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">ID</th>
          <th class="border p-2">Description</th>
          <th class="border p-2">Date</th>
          <th class="border p-2">Value</th>
          <th class="border p-2">Seller</th>
          <th class="border p-2">Send Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sale in sales" :key="sale.id">
          <td class="border p-2">{{ sale.id }}</td>
          <td class="border p-2">{{ sale.description }}</td>
          <td class="border p-2">{{ sale.date }}</td>
          <td class="border p-2">{{ sale.value }}</td>
          <td class="border p-2">{{ sale.seller.name }}</td>
          <td class="border p-2">
            <button class="bg-blue-500 text-white px-2 py-1 rounded text-sm" @click="sendEmail(sale.id)">Send</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>


<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../axios'

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

const sendEmail = (id: number) => {
  alert(`Send email for item ${id}`);
};

onMounted(() => {
    fetchSellers()
    fetchSales()
})
</script>