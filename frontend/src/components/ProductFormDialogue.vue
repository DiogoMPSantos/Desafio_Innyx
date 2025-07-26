<template>
  <v-dialog v-model="dialogVisible" max-width="600px" persistent>
    <v-card>
      <v-card-title class="text-h6">
        {{ isEditMode ? 'Editar Produto' : 'Cadastrar Produto' }}
      </v-card-title>

      <v-card-text>
        <v-form ref="formRef" v-model="formValid" lazy-validation>
          <v-text-field
            v-model="form.nome"
            label="Nome"
            :rules="[v => !!v || 'Obrigatório', v => v.length <= 50 || 'Máximo 50 caracteres']"
          />

          <v-textarea
            v-model="form.descricao"
            label="Descrição"
            :rules="[v => !!v || 'Obrigatório', v => v.length <= 200 || 'Máximo 200 caracteres']"
          />

          <v-text-field
            v-model.number="form.preco"
            label="Preço"
            type="number"
            :rules="[v => !!v || 'Obrigatório', v => v > 0 || 'Deve ser maior que zero']"
          />

          <v-text-field
            v-model="form.data_validade"
            label="Data de validade"
            type="date"
            :rules="[v => !!v || 'Obrigatório', v => new Date(v) >= new Date().setHours(0,0,0,0) || 'Data inválida']"
          />
            

          <div v-if="isEditMode && imagemUrl" class="mb-4">
                <span class="text-subtitle-2">Imagem atual:</span>
                <v-img
                    :src="imagemUrl"
                    max-width="200"
                    max-height="150"
                    class="mt-2 rounded"
                    cover
                />
          </div>

          <v-file-input
            v-model="form.imagem"
            label="Imagem do Produto"
            accept="image/*"
            show-size
            :rules="isEditMode ? [] : []"
          />

          <v-select
            v-model="form.categoria_id"
            :items="categorias"
            item-title="nome"
            item-value="id"
            label="Categoria"
            :rules="[v => !!v || 'Obrigatório']"
            />

        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="close">Cancelar</v-btn>
        <v-btn color="primary" :loading="saving" @click="submitForm">
          {{ isEditMode ? 'Atualizar' : 'Salvar' }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import api from '../axios'
import { getImagemUrl } from '../utils/imageHelper.js'

const props = defineProps({
  modelValue: Boolean,
  editData: Object 
})
const emit = defineEmits(['update:modelValue', 'saved'])

const dialogVisible = ref(false)

watch(() => props.modelValue, (val) => {
  dialogVisible.value = val
})

watch(dialogVisible, async (val) => {
  emit('update:modelValue', val)
  if (val) {

    if (!isEditMode.value) {
      form.value = {
        nome: '',
        descricao: '',
        preco: null,
        data_validade: '',
        imagem: null,
        categoria_id: null,
      }
    }

    await fetchCategorias()
  }
})

const formRef = ref(null)
const formValid = ref(false)
const saving = ref(false)

const form = ref({
  nome: '',
  descricao: '',
  preco: null,
  data_validade: '',
  imagem: null,
  categoria_id: null,
})

const isEditMode = computed(() => !!props.editData?.id)

const categorias = ref([])

const imagemUrl = computed(() => {
  return getImagemUrl(props.editData?.imagem)
})

const fetchCategorias = async () => {
  try {
    const { data } = await api.get('/categorias')
    categorias.value = data
  } catch (err) {
    console.error('Erro ao carregar categorias:', err)
  }
}

watch(() => props.editData, (val) => {
  if (val) {
    form.value = {
      nome: val.nome || '',
      descricao: val.descricao || '',
      preco: val.preco || null,
      data_validade: val.data_validade || '',
      imagem: null,
      categoria_id: val.categoria_id || null,
    }
  }
}, { immediate: true })

const close = () => {
  emit('update:modelValue', false)
}

const submitForm = async () => {
  const isValid = await formRef.value?.validate()
  if (!isValid) return

  saving.value = true

  const formData = new FormData()
  formData.append('nome', form.value.nome)
  formData.append('descricao', form.value.descricao)
  formData.append('preco', form.value.preco)
  formData.append('data_validade', form.value.data_validade)
  formData.append('categoria_id', form.value.categoria_id)
  if (form.value.imagem) {
    const uniqueName = `${Date.now()}_${form.value.imagem.name}`
    formData.append('imagem', form.value.imagem, uniqueName)
  }

  try {
    if (isEditMode.value) {
      await api.put(`/produtos/${props.editData.id}`, formData)
    } else {
      await api.post('/produtos', formData)
    }

    emit('saved', isEditMode.value ? 'Produto atualizado com sucesso' : 'Produto cadastrado com sucesso')
    close()
  } catch (err) {
    emit('error', 'Erro ao salvar o produto. Tente novamente mais tarde.')
  } finally {
    saving.value = false
  }
}
</script>
