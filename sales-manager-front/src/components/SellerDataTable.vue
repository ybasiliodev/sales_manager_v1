<template>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">Name</th>
          <th class="border p-2">Email</th>
          <th class="border p-2">Phone</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="seller in sellers" :key="seller.id">
          <td class="border p-2">{{ seller.name }}</td>
          <td class="border p-2">{{ seller.email }}</td>
          <td class="border p-2">{{ seller.phone }}</td>
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

const sellers = ref<Seller[]>([])
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

onMounted(() => {
    fetchSellers()
})
</script>