
<script setup>
import { RouterLink } from 'vue-router'
import { ref } from 'vue'
// import { useDisplay } from 'vuetify'
import logo from '@/images/logo.svg?url'
import AuthProvider from '@/pages/AuthProvider.vue'
import authV1BottomShape from '@/images/svg/auth-v1-bottom-shape.svg?url'
import authV1TopShape from '@/images/svg/auth-v1-top-shape.svg?url'

const form = ref({
  email: '',
  password: '',
  remember: false,
})

const isPasswordVisible = ref(false)

// const display = useDisplay()
</script>


<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <div class="position-relative my-sm-16">
       <!-- 👉 Top shape -->
      <VImg
        :src="authV1TopShape"
        class="text-primary auth-v1-top-shape d-none d-sm-block"
      />
      <h1>Login Page</h1>
    </div>
  </div>
</template>