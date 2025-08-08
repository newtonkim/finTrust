<script setup>
const transactions = [
  {
    title: 'Paypal',
    subtitle: 'Send money',
    amount: '+82.6',
    color: 'primary',
    icon: 'bxl-paypal',
  },
  {
    title: 'Wallet',
    subtitle: 'Mac\'D',
    amount: '+270.69',
    color: 'secondary',
    icon: 'bx-wallet',
  },
  {
    title: 'Transfer',
    subtitle: 'Refund',
    amount: '+637.91',
    color: 'success',
    icon: 'bx-trending-up',
  },
  {
    title: 'Credit Card',
    subtitle: 'Ordered Food',
    amount: '-838.71',
    color: 'error',
    icon: 'bx-credit-card',
  },
  {
    title: 'Wallet',
    subtitle: 'Starbucks',
    amount: '+203.33',
    color: 'warning',
    icon: 'bx-wallet',
  },
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
    <VCardText class="d-flex align-center pb-0">
      <h5 class="text-h5">
        Transactions
      </h5>
      <VSpacer />
      <MoreBtn
        class="me-n3 mt-n4"
        :menu-list="moreList"
      />
    </VCardText>

    <VCardText>
      <VList class="card-list">
        <VListItem
          v-for="transaction in transactions"
          :key="transaction.title"
          class="px-0"
        >
          <template #prepend>
            <VAvatar
              size="34"
              :color="transaction.color"
              variant="tonal"
            >
              <VIcon
                size="20"
                :icon="transaction.icon"
              />
            </VAvatar>
          </template>

          <VListItemTitle class="font-weight-medium">
            {{ transaction.title }}
          </VListItemTitle>
          <VListItemSubtitle class="text-disabled">
            {{ transaction.subtitle }}
          </VListItemSubtitle>

          <template #append>
            <span
              class="text-base font-weight-medium"
              :class="transaction.amount.startsWith('+') ? 'text-success' : 'text-error'"
            >
              {{ transaction.amount }}
            </span>
          </template>
        </VListItem>
      </VList>
    </VCardText>
  </VCard>
</template>

<style scoped>
.card-list {
  --v-card-list-gap: 16px;
}
</style>
