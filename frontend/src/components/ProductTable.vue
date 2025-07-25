<template>
  <v-container>
    <v-row class="justify-space-between mb-4">
      <v-col cols="12" md="6">
        <v-text-field
          v-model="search"
          label="Buscar produto..."
          prepend-inner-icon="mdi-magnify"
          clearable
          hide-details
          :disabled="loading"
        />
      </v-col>
      <v-col cols="12" md="3" class="d-flex justify-end align-center">
        <v-btn color="primary" @click="handleCreate" :disabled="loading">
          <template v-if="loading">
            <v-progress-circular
              indeterminate
              color="white"
              size="20"
            ></v-progress-circular>
          </template>
          <template v-else>
            <v-icon left>mdi-plus</v-icon>
            Cadastrar
          </template>
        </v-btn>
      </v-col>
    </v-row>

    <v-alert
      v-if="error"
      type="error"
      dense
      outlined
      class="mb-4"
      dismissible
      @click:close="error = ''"
    >
      {{ error }}
    </v-alert>

    <v-data-table
      :headers="headers"
      :items="products"
      class="elevation-1"
      :items-per-page="perPage"
      :page="page"
      mobile-breakpoint="600"
      :loading="loading"
      :disabled="loading"
      @update:items-per-page="perPage = $event"
      @update:page="page = $event"
    >

    <template #item.imagem="{ item }">
        <v-img 
          v-if="item.imagem"
          :src="item.imagem"
          alt="Imagem do produto"
          max-width="80"
          max-height="60"
          contain
          class="rounded"
        />
        <span v-else>-</span>
      </template>

     <template #item.categoria.nome="{ item }">
        {{ item.categoria?.nome || '-' }}
      </template>

      <template #item.actions="{ item }">
        <v-icon small color="primary" class="mr-2" @click="handleEdit(item)">
          mdi-pencil
        </v-icon>
        <v-icon small color="red" @click="handleDelete(item)">
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
  </v-container>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import api from '../axios'
import debounce from 'lodash/debounce'

const search = ref('')
const products = ref([])
const loading = ref(false)
const error = ref('')
const perPage = ref(10)
const page = ref(1)

const headers = [
  { title: 'ID', value: 'id' },
  { title: 'Nome', value: 'nome' },
  { title: 'Descricao', value: 'descricao' },
  { title: 'Preço', value: 'preco' },
  { title: 'Data de Validade', value: 'data_validade' },
  { title: 'Imagem', value: 'imagem' },
  { title: 'Categoria', value: 'categoria.nome' },
  { title: 'Ações', value: 'actions', sortable: false },
]

const fetchProducts = async () => {
  loading.value = true
  error.value = ''
  try {
    const response = await api.get('/produtos', {
      params: {
        per_page: perPage.value,
        page: page.value,
      },
    })
    products.value = response.data.data
  } catch (err) {
    error.value = 'Erro ao carregar produtos. Tente novamente mais tarde.'
  } finally {
    loading.value = false
  }
}

const searchProducts = async () => {
  loading.value = true
  error.value = ''
  try {
    const response = await api.get('/produtos/search', {
      params: {
        term: search.value.trim(),
      },
    })
    products.value = response.data.data
    page.value = 1
  } catch (err) {
    error.value = 'Erro ao buscar produtos.'
  } finally {
    loading.value = false
  }
}


const handleSearch = debounce(() => {
  if (search.value.trim()) {
    searchProducts()
  } else {
    fetchProducts()
  }
}, 500)


onMounted(() => {
  fetchProducts()
})

watch(search, handleSearch)

watch([perPage, page], () => {
  if (!search.value.trim()) {
    fetchProducts()
  }
}, { immediate: false })



// const handleEdit = product => {
//   console.log(`Editar produto ID ${product.id}`)
// }

// const handleDelete = product => {
//   if (confirm(`Deseja excluir "${product.nome}"?`)) {
//     products.value = products.value.filter(p => p.id !== product.id)
//   }
// }

// const handleCreate = () => {
// }
</script>
