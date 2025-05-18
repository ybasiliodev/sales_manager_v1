import axios from 'axios'
import router from './router'

const instance = axios.create({
    baseURL: 'http://localhost:8080/api/v1'
  })
  
  // Adiciona o token em todas as requisições
  instance.interceptors.request.use(config => {
    const token = sessionStorage.getItem('access_token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  })

  instance.interceptors.response.use(
    response => response,
    error => {
      if (error.response && error.response.status === 401) {
        // Limpa sessão e redireciona para login
        sessionStorage.removeItem('access_token')
        router.push('/login')
      }
      return Promise.reject(error)
    }
  )
  
  export default instance