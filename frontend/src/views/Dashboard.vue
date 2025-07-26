<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Produtos</v-toolbar-title>

      <v-spacer></v-spacer>

      <span class="mr-4 d-none d-sm-inline">{{ user.name || 'Usuário' }}</span>

      <v-menu offset-y>
        <template #activator="{ props }">
          <v-btn icon v-bind="props">
            <v-icon>mdi-account</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item @click="logout">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" app temporary>
      <v-list nav>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h6">{{ user.name || 'Usuário' }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        <v-list-item @click="logout">
          <v-list-item-icon>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>
          <v-list-item-title>Sair</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container class="py-8">
        <ProductTable />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import ProductTable from '@/components/ProductTable.vue'
import api from '../axios' 

const drawer = ref(false)
const router = useRouter()
const user = ref([])

const logout = () => {
  localStorage.removeItem('token')
  router.push('/login')
}

const fetchUser = async () => {
  try {
    const response = await api.get('/me')
    user.value = response.data.user
    
  } catch (error) {
    console.error('Erro ao buscar usuário', error)
    logout()
  }
}

onMounted(() => {
  fetchUser()
})
</script>
