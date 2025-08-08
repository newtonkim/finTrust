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
    <VCardText class="pb-0">
      <div class="d-flex align-center justify-space-between">
        <h6 class="text-h6">
          Profit Report
        </h6>
        <MoreBtn
          class="me-n3 mt-n4"
          :menu-list="moreList"
        />
      </div>
      <p class="text-sm text-disabled mb-0">
        Year 2022
      </p>
    </VCardText>

    <VCardText>
      <div class="d-flex align-center mb-3">
        <h4 class="text-h4 me-2">
          $84,686k
        </h4>
        <span class="text-success d-flex align-center text-sm">
          <VIcon
            icon="bx-up-arrow-alt"
            size="16"
          />
          68.2%
        </span>
      </div>

      <!-- Placeholder for line chart -->
      <div class="chart-placeholder d-flex align-center justify-center" style="height: 100px; background: #f5f5f5; border-radius: 8px;">
        <div class="d-flex align-center">
          <VIcon icon="bx-trending-up" size="24" color="warning" class="me-2" />
          <span class="text-disabled">Profit Trend</span>
        </div>
      </div>
    </VCardText>
  </VCard>
</template>
