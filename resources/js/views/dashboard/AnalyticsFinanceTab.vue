<script setup>
import { ref } from 'vue'

const currentTab = ref('income')

const tabs = [
  { title: 'Income', value: 'income' },
  { title: 'Expenses', value: 'expenses' },
  { title: 'Profit', value: 'profit' },
]

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
          Finance
        </h6>
        <MoreBtn
          class="me-n3 mt-n4"
          :menu-list="moreList"
        />
      </div>
    </VCardText>

    <VCardText>
      <VTabs
        v-model="currentTab"
        class="mb-4"
      >
        <VTab
          v-for="tab in tabs"
          :key="tab.value"
          :value="tab.value"
          size="small"
        >
          {{ tab.title }}
        </VTab>
      </VTabs>

      <VWindow v-model="currentTab">
        <VWindowItem value="income">
          <div class="mb-4">
            <h4 class="text-h4 mb-1">
              $42,845
            </h4>
            <p class="text-sm text-success mb-0">
              +2.34%
            </p>
          </div>
          <!-- Placeholder for income chart -->
          <div class="chart-placeholder d-flex align-center justify-center" style="height: 200px; background: #f5f5f5; border-radius: 8px;">
            <div class="text-center">
              <VIcon icon="bx-trending-up" size="32" color="primary" class="mb-2" />
              <p class="text-disabled">Income Chart</p>
            </div>
          </div>
        </VWindowItem>

        <VWindowItem value="expenses">
          <div class="mb-4">
            <h4 class="text-h4 mb-1">
              $28,634
            </h4>
            <p class="text-sm text-error mb-0">
              -1.15%
            </p>
          </div>
          <!-- Placeholder for expenses chart -->
          <div class="chart-placeholder d-flex align-center justify-center" style="height: 200px; background: #f5f5f5; border-radius: 8px;">
            <div class="text-center">
              <VIcon icon="bx-trending-down" size="32" color="error" class="mb-2" />
              <p class="text-disabled">Expenses Chart</p>
            </div>
          </div>
        </VWindowItem>

        <VWindowItem value="profit">
          <div class="mb-4">
            <h4 class="text-h4 mb-1">
              $14,211
            </h4>
            <p class="text-sm text-success mb-0">
              +5.67%
            </p>
          </div>
          <!-- Placeholder for profit chart -->
          <div class="chart-placeholder d-flex align-center justify-center" style="height: 200px; background: #f5f5f5; border-radius: 8px;">
            <div class="text-center">
              <VIcon icon="bx-line-chart" size="32" color="success" class="mb-2" />
              <p class="text-disabled">Profit Chart</p>
            </div>
          </div>
        </VWindowItem>
      </VWindow>
    </VCardText>
  </VCard>
</template>
