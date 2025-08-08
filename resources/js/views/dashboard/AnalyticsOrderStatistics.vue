<script setup>
const moreList = [
  {
    title: 'Last 28 Days',
    value: 'Last 28 Days',
  },
  {
    title: 'Last Month',
    value: 'Last Month',
  },
  {
    title: 'Last Year',
    value: 'Last Year',
  },
]
</script>

<template>
  <VCard>
    <VCardText class="d-flex align-center pb-0">
      <span class="text-sm text-disabled">Order Statistics</span>
      <VSpacer />
      <MoreBtn
        class="me-n3 mt-n4"
        :menu-list="moreList"
      />
    </VCardText>

    <VCardText class="text-center">
      <VBtn
        variant="outlined"
        size="small"
        class="mb-4"
      >
        2023
        <VIcon
          icon="bx-chevron-down"
          size="16"
          class="ms-1"
        />
      </VBtn>

      <!-- Placeholder for radial chart -->
      <div class="chart-placeholder d-flex align-center justify-center" style="height: 200px; background: #f5f5f5; border-radius: 50%; margin: 0 auto; width: 200px;">
        <div class="text-center">
          <h4 class="text-h4 text-primary">78%</h4>
          <span class="text-sm text-disabled">Growth</span>
        </div>
      </div>

      <div class="d-flex align-center justify-space-between mt-6">
        <div class="d-flex align-center">
          <VIcon
            icon="bx-dollar"
            color="primary"
            size="20"
            class="me-2"
          />
          <div>
            <span class="text-sm text-disabled d-block">2023</span>
            <h6 class="text-h6">
              $2.54k
            </h6>
          </div>
        </div>

        <div class="d-flex align-center">
          <VIcon
            icon="bx-wallet"
            color="info"
            size="20"
            class="me-2"
          />
          <div>
            <span class="text-sm text-disabled d-block">2022</span>
            <h6 class="text-h6">
              $4.21k
            </h6>
          </div>
        </div>
      </div>

      <p class="text-center text-sm text-disabled mt-4">
        62% Company Growth
      </p>
    </VCardText>
  </VCard>
</template>
