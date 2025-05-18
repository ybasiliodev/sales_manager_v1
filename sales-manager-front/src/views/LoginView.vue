<template>
    <div class="bg-blue-500 text-white p-4">
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Senha:</label>
          <input type="password" v-model="password" required />
        </div>
        <button type="submit">Entrar</button>
        <p v-if="error" class="error">{{ error }}</p>
      </form>
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
  
      // Armazena o token na sessionStorage
      sessionStorage.setItem('access_token', response.data.access_token)
  
      // Redireciona para a home ou rota protegida
      router.push('/dashboard')
    } catch (err) {
      error.value = 'Email ou senha inválidos'
      console.error(err)
    }
  }
  </script>
  
  <style scoped>
  .login-page {
    max-width: 400px;
    margin: auto;
  }
  
  .error {
    color: red;
  }
  </style>
  