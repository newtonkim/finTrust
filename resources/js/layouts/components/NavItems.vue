<script setup>
import VerticalNavSectionTitle from '@/@layouts/components/VerticalNavSectionTitle.vue'
import VerticalNavGroup from '@layouts/components/VerticalNavGroup.vue'
import VerticalNavLink from '@layouts/components/VerticalNavLink.vue'
</script>

<template>
  <!-- 👉 Dashboards -->
  <VerticalNavGroup
    :item="{
      title: 'Dashboards',
        to: '/dashboard',
      icon: 'bx-home-smile',
    }"
  >
    <!-- <VerticalNavLink
      :item="{
        title: 'Analytics',
        to: '/dashboard',
      }"
    /> -->

  </VerticalNavGroup>

   <!-- 👉 Apps & Pages -->
  <VerticalNavSectionTitle
    :item="{
      heading: 'Reports',
    }"
  />
  <VerticalNavGroup
    :item="{
      title: 'Finacial Reports',
      icon: 'bx-file',
    }"
  >
    <VerticalNavLink
      :item="{
        title: 'Trial Balance',
        target: '_blank',
      }"
    />
    <VerticalNavLink
      :item="{
        title: 'Income Statement',
        target: '_blank',
      }"
    />
    <VerticalNavLink
      :item="{
        title: 'Balance Sheet',
        target: '_blank',
      }"
    />
  
    <VerticalNavLink
      :item="{
        title: 'Cash Flow Statement',
        target: '_blank',
      }"
    />
    <VerticalNavLink
      :item="{
        title: 'Aging Report',
        target: '_blank',
      }"
    />
  </VerticalNavGroup>


  <VerticalNavLink
    :item="{
      title: 'Chart Of Accounts',
      icon: 'bx-envelope',
      target: '_blank',
    }"
  />
  <VerticalNavLink
    :item="{
      title: 'General Ledgers',
      icon: 'bx-chat',
      target: '_blank',
    }"
  />
  <VerticalNavLink
    :item="{
      title: 'Calendar',
      icon: 'bx-calendar',
      target: '_blank',
    }"
  />

  <VerticalNavLink
    :item="{
      title: 'Account Settings',
      icon: 'bx-user',
      to: '/account-settings',
    }"
  />

  <VerticalNavLink
    :item="{
      title: 'Login',
      icon: 'bx-log-in',
      to: '/login',
    }"
  />
  <VerticalNavLink
    :item="{
      title: 'Register',
      icon: 'bx-user-plus',
      to: '/register',
    }"
  />
  

  <!-- 👉 User Interface -->
  <VerticalNavSectionTitle
    :item="{
      heading: 'Integrations',
    }"
  />
  
  <VerticalNavLink
    :item="{
      title: 'Cards',
      icon: 'bx-credit-card',
      to: '/cards',
    }"
  />

  <!-- 👉 Forms & Tables -->
  <VerticalNavSectionTitle
    :item="{
      heading: 'Forms & Tables',
    }"
  />
  <VerticalNavLink
    :item="{
      title: 'Form Layouts',
      icon: 'bx-layout',
      to: '/form-layouts',
    }"
  />
  
  <VerticalNavLink
    :item="{
      title: 'Tables',
      icon: 'bx-table',
      to: '/tables',
    }"
  />
  
</template>
