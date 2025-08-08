<script setup>
const props = defineProps({
  menuList: {
    type: Array,
    required: false,
  },
  itemProps: {
    type: Boolean,
    required: false,
  },
  iconSize: {
    type: String,
    required: false,
  },
})
</script>

<template>
  <VBtn
    icon
    variant="text"
    size="small"
  >
    <VIcon
      :size="props.iconSize"
      icon="bx-dots-vertical-rounded"
    />

    <VMenu
      v-if="props.menuList"
      activator="parent"
    >
      <VList
        :items="props.menuList"
        :item-props="props.itemProps"
      />
    </VMenu>
  </VBtn>
</template>
