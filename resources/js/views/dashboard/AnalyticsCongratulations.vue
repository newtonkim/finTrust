<script setup>
// Import the congratulations illustration
import congratulationsJohn from '@/images/cards/illustration-john-light.png'
</script>

<template>
  <VCard class="position-relative overflow-hidden">
    <VCardText class="pb-0">
      <div class="d-flex align-center">
        <div class="flex-grow-1">
          <h4 class="text-h4 mb-1">
            Congratulations John! 🎉
          </h4>
          <p class="text-body-1 mb-3">
            You have done 72% more sales today.<br>
            Check your new raising badge in your profile.
          </p>
          <VBtn
            size="small"
            variant="outlined"
            color="primary"
          >
            View Badges
          </VBtn>
        </div>
        <div class="flex-shrink-0 text-end">
          <img
            :src="congratulationsJohn"
            alt="Congratulations John"
            height="140"
            class="congratulations-john"
          >
        </div>
      </div>
    </VCardText>
  </VCard>
</template>

<style scoped>
.congratulations-john {
  position: absolute;
  bottom: 0;
  right: 1rem;
}
</style>
