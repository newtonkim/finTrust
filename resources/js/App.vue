<script setup>
import { VApp } from 'vuetify/components'
import UpgradeToPro from '@/components/UpgradeToPro.vue'
</script>

<template>
  <VApp>
    <slot />
    <UpgradeToPro />
  </VApp>
</template>
