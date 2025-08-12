<template>
  <div class="landing-container">
    <div class="hero-section">
      <div class="hero-content">
        <h1 class="hero-title">
          <span class="text-primary">One dashboard</span> to <span class="text-secondary">manage</span><br>
          <span class="text-secondary">all your business</span>
        </h1>
        
        <p class="hero-subtitle">
          Production-ready & easy to use Admin Template for Reliability and<br>
          Customizability.
        </p>
        
        <div class="hero-actions">
          <!-- <Link v-if="canLogin" href="/login" class="btn btn-primary">Get Early Access</Link> -->
           <Link v-if="canLogin" href="/login" class="btn btn-primary">Login</Link>
           <Link v-if="canRegister" href="/register" class="btn btn-secondary ml-4">Register</Link>
          <a href="#community" class="community-link">
            Join Community
            <svg class="arrow-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M8 1L15 8L8 15M15 8H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
      </div>
      
      <div class="dashboard-preview">
        <div class="preview-container">
          <div class="preview-sidebar">
            <div class="sidebar-header">
              <div class="logo">
                <span class="logo-icon">📊</span>
                <span class="logo-text">Sneat King</span>
              </div>
            </div>
            <div class="sidebar-menu">
              <div class="menu-item active">
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
              </div>
              <div class="menu-item">
                <span class="menu-icon">🛒</span>
                <span>eCommerce</span>
              </div>
              <div class="menu-item">
                <span class="menu-icon">📊</span>
                <span>Analytics</span>
              </div>
              <div class="menu-item">
                <span class="menu-icon">📦</span>
                <span>Logistics</span>
              </div>
              <div class="menu-item">
                <span class="menu-icon">👥</span>
                <span>Users</span>
              </div>
            </div>
          </div>
          
          <div class="preview-main">
            <div class="main-header">
              <div class="search-bar">
                <span class="search-icon">🔍</span>
                <span class="search-text">Search</span>
              </div>
              <div class="header-actions">
                <span class="notification-icon">🔔</span>
                <div class="user-avatar"></div>
              </div>
            </div>
            
            <div class="main-content">
              <div class="congratulations-card">
                <div class="card-content">
                  <h3>Congratulations Karina! 🎉</h3>
                  <p>Best seller of the month</p>
                  <div class="stats">
                    <span class="stat-value">$42.8k</span>
                    <span class="stat-label">78% of target 🚀</span>
                  </div>
                  <button class="view-sales-btn">View Sales</button>
                </div>
                <div class="card-illustration">
                  <div class="trophy-icon">🏆</div>
                </div>
              </div>
              
              <div class="stats-grid">
                <div class="stat-card">
                  <div class="stat-header">
                    <span class="stat-title">New Visitors</span>
                    <span class="stat-period">Last Week</span>
                  </div>
                  <div class="stat-value">23%</div>
                  <div class="stat-chart">📈</div>
                </div>
                
                <div class="stat-card">
                  <div class="stat-header">
                    <span class="stat-title">Activity</span>
                    <span class="stat-period">Last Week</span>
                  </div>
                  <div class="stat-value">82%</div>
                  <div class="stat-chart">📊</div>
                </div>
              </div>
              
              <div class="revenue-section">
                <div class="revenue-card">
                  <h4>Total Income</h4>
                  <p>Yearly report overview</p>
                  <div class="revenue-chart">
                    <div class="chart-placeholder">📈</div>
                  </div>
                </div>
                
                <div class="transactions-card">
                  <h4>Report</h4>
                  <p>Monthly Avg. $45.578k</p>
                  <div class="transaction-items">
                    <div class="transaction-item">
                      <span class="transaction-icon">💰</span>
                      <span class="transaction-amount">$42,845</span>
                    </div>
                    <div class="transaction-item">
                      <span class="transaction-icon">📊</span>
                      <span class="transaction-amount">$38,658</span>
                    </div>
                    <div class="transaction-item">
                      <span class="transaction-icon">💳</span>
                      <span class="transaction-amount">$18,220</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
})
</script>

<style scoped>
.landing-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  padding: 2rem 1rem;
}

.hero-section {
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  gap: 4rem;
  min-height: calc(100vh - 4rem);
}

.hero-content {
  flex: 1;
  max-width: 600px;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 1.5rem;
}

.text-primary {
  color: #4ade80;
}

.text-secondary {
  color: #6366f1;
}

.hero-subtitle {
  font-size: 1.2rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 2.5rem;
}

.hero-actions {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.btn {
  display: inline-block;
  padding: 1rem 2rem;
  text-decoration: none;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 1.1rem;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-primary {
  background: #6366f1;
  color: white;
  box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.4);
}

.btn-primary:hover {
  background: #5855eb;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px 0 rgba(99, 102, 241, 0.5);
}

.community-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #64748b;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.community-link:hover {
  color: #6366f1;
}

.arrow-icon {
  transition: transform 0.3s ease;
}

.community-link:hover .arrow-icon {
  transform: translateX(4px);
}

.dashboard-preview {
  flex: 1;
  max-width: 700px;
}

.preview-container {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  overflow: hidden;
  display: flex;
  height: 500px;
}

.preview-sidebar {
  width: 200px;
  background: #f8fafc;
  border-right: 1px solid #e2e8f0;
  padding: 1rem;
}

.sidebar-header {
  margin-bottom: 2rem;
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 700;
  color: #1e293b;
}

.logo-icon {
  font-size: 1.5rem;
}

.sidebar-menu {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.menu-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  color: #64748b;
  cursor: pointer;
  transition: all 0.2s ease;
}

.menu-item.active {
  background: #6366f1;
  color: white;
}

.menu-item:hover:not(.active) {
  background: #e2e8f0;
}

.preview-main {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.main-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid #e2e8f0;
}

.search-bar {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #f8fafc;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  color: #64748b;
  font-size: 0.875rem;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.notification-icon {
  font-size: 1.2rem;
  cursor: pointer;
}

.user-avatar {
  width: 32px;
  height: 32px;
  background: #6366f1;
  border-radius: 50%;
  cursor: pointer;
}

.main-content {
  flex: 1;
  padding: 1.5rem;
  overflow-y: auto;
}

.congratulations-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 1.5rem;
  border-radius: 0.75rem;
  margin-bottom: 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-content h3 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.card-content p {
  opacity: 0.9;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.stats {
  margin-bottom: 1rem;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  display: block;
}

.stat-label {
  font-size: 0.75rem;
  opacity: 0.8;
}

.view-sales-btn {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  cursor: pointer;
  transition: background 0.2s ease;
}

.view-sales-btn:hover {
  background: rgba(255, 255, 255, 0.3);
}

.card-illustration {
  font-size: 3rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.stat-card {
  background: white;
  padding: 1rem;
  border-radius: 0.5rem;
  border: 1px solid #e2e8f0;
}

.stat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.stat-title {
  font-size: 0.875rem;
  color: #64748b;
}

.stat-period {
  font-size: 0.75rem;
  color: #94a3b8;
}

.stat-card .stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 0.5rem;
}

.stat-chart {
  font-size: 1.5rem;
}

.revenue-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.revenue-card,
.transactions-card {
  background: white;
  padding: 1rem;
  border-radius: 0.5rem;
  border: 1px solid #e2e8f0;
}

.revenue-card h4,
.transactions-card h4 {
  font-size: 1rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 0.25rem;
}

.revenue-card p,
.transactions-card p {
  font-size: 0.875rem;
  color: #64748b;
  margin-bottom: 1rem;
}

.chart-placeholder {
  font-size: 2rem;
  text-align: center;
  padding: 1rem;
}

.transaction-items {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.transaction-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.transaction-icon {
  font-size: 1.2rem;
}

.transaction-amount {
  font-weight: 600;
  color: #1e293b;
}

@media (max-width: 1024px) {
  .hero-section {
    flex-direction: column;
    text-align: center;
    gap: 3rem;
  }
  
  .hero-title {
    font-size: 2.5rem;
  }
  
  .preview-container {
    height: 400px;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-actions {
    flex-direction: column;
    gap: 1rem;
  }
  
  .preview-container {
    height: 300px;
  }
  
  .preview-sidebar {
    width: 150px;
  }
  
  .stats-grid,
  .revenue-section {
    grid-template-columns: 1fr;
  }
}
</style>
