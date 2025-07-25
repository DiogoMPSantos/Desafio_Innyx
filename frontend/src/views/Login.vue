<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card>
          <v-card-title class="text-h5">Login</v-card-title>
          <v-card-text>
            <v-form @submit.prevent="submitLogin" ref="form">
              <v-text-field
                v-model="email"
                label="Email"
                type="email"
                required
                :rules="[rules.required, rules.email]"
              />
              <v-text-field
                v-model="password"
                label="Senha"
                type="password"
                required
                :rules="[rules.required]"
              />
              <v-btn
                :disabled="loading"
                type="submit"
                color="primary"
                block
              >
                <span v-if="!loading">Entrar</span>
                <v-progress-circular
                  v-else
                  indeterminate
                  color="white"
                  size="20"
                ></v-progress-circular>
              </v-btn>
            </v-form>
            <v-alert v-if="error" type="error" dense outlined class="mt-3">
              {{ error }}
            </v-alert>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../axios' 
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const loading = ref(false)
const error = ref('')
const form = ref(null)

const rules = {
  required: (v: string) => !!v || 'Campo obrigatório',
  email: (v: string) => /.+@.+\..+/.test(v) || 'Email inválido',
}

const router = useRouter()

const submitLogin = async () => {
  
  if (!form.value?.validate()) return

  error.value = ''
  loading.value = true

  try {

    const response = await api.post('/auth/login', {
      email: email.value,
      password: password.value,
    })

    console.log(response.data);
    

    const token = response.data.token
    localStorage.setItem('token', token)

    router.push('/dashboard')
  } catch (err: any) {
    error.value =
      err.response?.data?.message || 'Erro ao fazer login. Tente novamente.'
  } finally {
    loading.value = false
  }
}
</script>
