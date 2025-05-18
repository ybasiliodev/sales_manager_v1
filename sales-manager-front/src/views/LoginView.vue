<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6">Login</h2>
      <form @submit.prevent="login" class="space-y-4">
        <input type="email" id="email" v-model="email" required placeholder="Email"
          class="mb-4 w-full p-2 border rounded" />
        <input type="password" id="password" v-model="password" required placeholder="Password"
          class="mb-4 w-full p-2 border rounded" />
        <button @click="login" type="button" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
        <p v-if="error" class="text-red-400 text-sm text-center mt-2">
          {{ error }}
        </p>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref<string | null>(null)
const router = useRouter()

async function login() {
  try {
    const response = await axios.post('http://localhost:8080/api/v1/login', {
      email: email.value,
      password: password.value,
    })

    sessionStorage.setItem('access_token', response.data.access_token)
    router.push('/dashboard')
  } catch (err) {
    error.value = 'Email ou senha inválidos'
    console.error(err)
  }
}
</script>
