<script setup>
</script>

<template>
  <div class="vertical-nav-layout">
    <!-- Navbar slot -->
    <header class="navbar">
      <slot name="navbar" />
    </header>

    <div class="main-wrapper">
      <!-- Vertical nav header slot -->
      <nav class="vertical-nav-header">
        <slot name="vertical-nav-header" />
      </nav>

      <!-- Vertical nav content slot -->
      <aside class="vertical-nav-content">
        <slot name="vertical-nav-content" />
      </aside>

      <!-- Main page content -->
      <main class="page-content">
        <slot />
      </main>
    </div>

    <!-- Footer slot -->
    <footer class="footer">
      <slot name="footer" />
    </footer>
  </div>
</template>

<style scoped>
.vertical-nav-layout {
  display: flex;
  flex-direction: column;
  height: 100vh;
  overflow: hidden;
}

.navbar {
  flex: 0 0 auto;
  height: 56px;
  background-color: #fff;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  padding: 0 1rem;
  z-index: 10;
}

.main-wrapper {
  display: flex;
  flex: 1 1 auto;
  overflow: hidden;
  height: calc(100vh - 56px);
}

.vertical-nav-header {
  width: 250px;
  background-color: #f8fafc;
  border-right: 1px solid #e2e8f0;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  padding: 0 1rem;
}

.vertical-nav-content {
  width: 250px;
  background-color: #ffffff;
  border-right: 1px solid #e2e8f0;
  overflow-y: auto;
  flex-shrink: 0;
}

.page-content {
  flex: 1 1 auto;
  overflow-y: auto;
  padding: 1rem;
  background-color: rgba(144, 238, 144, 0.1); /* light green background for debugging */
  border: 2px dashed #90ee90; /* dashed border for debugging */
}

.footer {
  flex: 0 0 auto;
  height: 48px;
  background-color: #fff;
  border-top: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 1rem;
  z-index: 10;
}
</style>
