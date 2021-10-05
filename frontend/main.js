import { createApp } from 'vue'
import api from './api'
import App from './App.vue'
import './main.css'

api.init()

createApp(App).mount('#app')