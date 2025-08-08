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
      <h5 class="text-h5">
        Total Revenue
      </h5>
      <VSpacer />
      <MoreBtn
        class="me-n3 mt-n4"
        :menu-list="moreList"
      />
    </VCardText>

    <VCardText>
      <div class="d-flex align-center justify-space-between mb-4">
        <div>
          <h4 class="text-h4 mb-1">
            $42,845
          </h4>
          <p class="text-sm text-success mb-0">
            +2.34% from last month
          </p>
        </div>
      </div>
      
      <!-- Placeholder for chart -->
      <div class="chart-placeholder d-flex align-center justify-center" style="height: 300px; background: #f5f5f5; border-radius: 8px;">
        <div class="text-center">
          <VIcon icon="bx-bar-chart-alt-2" size="48" color="primary" class="mb-2" />
          <p class="text-disabled">Revenue Chart</p>
        </div>
      </div>
    </VCardText>
  </VCard>
</template>
