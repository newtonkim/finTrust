<script setup>
defineOptions({
  layout: 'default',
})
</script>

<template>
  <div class="dashboard-container">
    <div class="welcome-section">
      <h1>Welcome to FinTrust Dashboard</h1>
      <p>You have successfully logged in!</p>
    </div>
    
    <div class="stats-grid">
      <div class="stat-card">
        <h3>Total Revenue</h3>
        <p class="stat-value">$12,628</p>
        <span class="stat-change positive">+72.80%</span>
      </div>
      
      <div class="stat-card">
        <h3>Sales</h3>
        <p class="stat-value">$4,679</p>
        <span class="stat-change positive">+28.42%</span>
      </div>
      
      <div class="stat-card">
        <h3>Payments</h3>
        <p class="stat-value">$2,468</p>
        <span class="stat-change negative">-14.82%</span>
      </div>
      
      <div class="stat-card">
        <h3>Transactions</h3>
        <p class="stat-value">$14,857</p>
        <span class="stat-change positive">+28.14%</span>
      </div>
    </div>
    
    <div class="actions">
      <a href="/profile" class="btn btn-primary">Profile Settings</a>
      <a href="/chart-of-accounts" class="btn btn-secondary">Chart of Accounts</a>
      <a href="/general-ledger" class="btn btn-secondary">General Ledger</a>
      <form method="POST" action="/logout" style="display: inline;">
        <input type="hidden" name="_token" :value="$page.props.csrf_token">
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.dashboard-container {
  padding: 2rem;
  max-width: 1200px;
  margin: 0 auto;
  background-color: rgba(100, 149, 237, 0.1); /* light blue background for debugging */
  border: 2px dashed #6495ed; /* dashed border for debugging */
}

.welcome-section {
  text-align: center;
  margin-bottom: 3rem;
}

.welcome-section h1 {
  color: #2d3748;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.welcome-section p {
  color: #718096;
  font-size: 1.1rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.stat-card {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
}

.stat-card h3 {
  color: #4a5568;
  font-size: 0.9rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.stat-value {
  color: #2d3748;
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.stat-change {
  font-size: 0.875rem;
  font-weight: 600;
}

.stat-change.positive {
  color: #38a169;
}

.stat-change.negative {
  color: #e53e3e;
}

.actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: center;
}

.btn {
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-primary {
  background: #667eea;
  color: white;
}

.btn-primary:hover {
  background: #5a67d8;
}

.btn-secondary {
  background: #718096;
  color: white;
}

.btn-secondary:hover {
  background: #4a5568;
}

.btn-danger {
  background: #e53e3e;
  color: white;
}

.btn-danger:hover {
  background: #c53030;
}
</style>
