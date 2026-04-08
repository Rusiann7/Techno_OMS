<template>
  <div class="admin-dashboard-container">
    <!-- Navbar -->
    <nav class="admin-navbar">
      <div class="nav-brand">
        <div class="logo-icon-box">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <line x1="12" y1="8" x2="12" y2="16" />
            <line x1="8" y1="12" x2="16" y2="12" />
          </svg>
        </div>
        <div class="brand-text">
          <h1>DevSparks Admin</h1>
          <p>Order Management System</p>
        </div>
      </div>
      <div class="nav-controls">
        <div class="admin-badge">Administrator</div>
        <button class="logout-btn" @click="logout">
          <svg
            width="18"
            height="18"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
          <span>Logout</span>
        </button>
      </div>
    </nav>

    <div class="dashboard-content">
      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card revenue">
          <div class="stat-info">
            <label>Total Revenue</label>
            <h2 class="stat-value">${{ revenueNumber }}</h2>
          </div>
          <div class="stat-icon-box">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
              <polyline points="17 6 23 6 23 12" />
            </svg>
          </div>
        </div>

        <div class="stat-card orders">
          <div class="stat-info">
            <label>Total Orders</label>
            <h2 class="stat-value">{{ orderNumber }}</h2>
          </div>
          <div class="stat-icon-box">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
              <path d="M3 6h18" />
              <path d="M16 10a4 4 0 0 1-8 0" />
            </svg>
          </div>
        </div>

        <div class="stat-card customers">
          <div class="stat-info">
            <label>Total Customers</label>
            <h2 class="stat-value">{{ customerNumber }}</h2>
          </div>
          <div class="stat-icon-box">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
        </div>

        <div class="stat-card products">
          <div class="stat-info">
            <label>Products</label>
            <h2 class="stat-value">4</h2>
          </div>
          <div class="stat-icon-box">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path
                d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"
              />
              <path d="m3.3 7 8.7 5 8.7-5" />
              <path d="M12 22V12" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Main Section -->
      <div class="management-section">
        <div class="section-header">
          <h2 class="section-title">Management Dashboard</h2>
          <p class="section-subtitle">View and manage orders, customers, and products</p>
        </div>

        <!-- Section Navigation Tabs -->
        <div class="tabs-navigation">
          <button
            :class="['nav-tab', { active: currentTab === 'orders' }]"
            @click="currentTab = 'orders'"
          >
            Orders
          </button>
          <button
            :class="['nav-tab', { active: currentTab === 'customers' }]"
            @click="currentTab = 'customers'"
          >
            Customers
          </button>
          <button
            :class="['nav-tab', { active: currentTab === 'products' }]"
            @click="currentTab = 'products'"
          >
            Products
          </button>
        </div>

        <!-- Orders Table -->
        <div v-if="currentTab === 'orders'" class="table-container">
          <table class="management-table">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Request</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Placed On</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="order in orders" :key="order.cartId">
                <td class="font-bold">Temp Data</td>
                <td class="font-bold" style="color: #1e293b">{{ order.product_name }}</td>
                <td
                  class="text-muted"
                  style="
                    max-width: 200px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                  "
                >
                  {{ order.request || 'None' }}
                </td>
                <td>
                  <span class="order-count-pill">{{ order.quantity }}</span>
                </td>
                <td class="font-bold" style="color: #a855f7">${{ order.total }}</td>
                <td>
                  <span :class="['status-badge', order.status.toLowerCase()]">
                    {{ order.status }}
                  </span>
                </td>
                <td class="text-muted">{{ order.created_at }}</td>
                <td>
                  <div class="action-buttons">
                    <button
                      class="action-btn success-btn"
                      @click.prevent="orderStatus(order.cartId, 'done')"
                    >
                      Done
                    </button>
                    <button
                      class="action-btn danger-btn"
                      @click.prevent="orderStatus(order.cartId, 'deleted')"
                    >
                      Cancel
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Customers Table -->
        <div v-if="currentTab === 'customers'" class="table-container">
          <table class="management-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Orders</th>
                <th>Total Spent</th>
                <th>Join Date</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="customer in customers" :key="customer.email">
                <td class="font-bold">{{ customer.fullname }}</td>
                <td>{{ customer.email }}</td>
                <td>
                  <span class="order-count-pill">{{ customer.total_orders }}</span>
                </td>
                <td class="font-bold" style="color: #1e293b">Temp Data</td>
                <td class="text-muted">{{ customer.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Products Grid (Matches homePage.vue) -->
        <div v-if="currentTab === 'products'" class="product-grid">
          <div class="product-card" v-for="product in items" :key="product.product_id">
            <div class="image-container">
              <img src="../asset/teto.jpg" :alt="product.product_name" />
              <div class="category-chip">{{ product.product_cat || 'Category' }}</div>
            </div>
            <div class="card-details">
              <div class="card-top">
                <h3 class="p-name">{{ product.product_name }}</h3>
                <span class="p-price">${{ product.product_price }}</span>
              </div>
              <p class="p-desc">{{ product.product_desc }}</p>

              <div class="stock-stats">
                <span class="stat-badge">Stock: {{ product.product_stock }}</span>
                <span class="stat-badge sold">Sold: {{ product.product_sold }}</span>
              </div>

              <button class="primary-btn-gradient">
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                  <path d="m15 5 4 4" />
                </svg>
                <span>Manage Product</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
//const url2 = "https://rusiann7.helioho.st";
const url2 = 'https://star-panda-literally.ngrok-free.app'
//const url2 = "http://localhost:8000";
//const url2 = "http://localhost";

export default {
  data() {
    return {
      currentTab: 'orders',
      items: [],
      itemsAPI: `${url2}/productGetterAdmin.php`,
      isLoading: false,
      is_admin: localStorage.getItem('is_admin'),
      customerAPI: `${url2}/getCustomer.php`,
      customers: [],
      orders: [],
      orderAPI: `${url2}/getOrdersAdmin.php`,
      orderStatusAPI: `${url2}/statusChange.php`,
    }
  },
  methods: {
    async getItems() {
      try {
        this.isLoading = true

        const response = await fetch(this.itemsAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'getProducts',
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.items = result.products
          this.isLoading = false
        } else {
          console.log('error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    async getCustomers() {
      try {
        this.isLoading = true

        const response = await fetch(this.customerAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'getCustomers',
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.customers = result.customers
        }
      } catch (error) {
        console.log(error)
      }
    },

    async getOrders() {
      try {
        this.isLoading = true

        const response = await fetch(this.orderAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'getOrders',
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.orders = result.orders
          this.isLoading = false
        } else {
          console.log('Error')
          this.isLoading = false
        }
      } catch (error) {
        console.log(error)
      }
    },

    async orderStatus(cartId, work) {
      try {
        this.isLoading = true

        const response = await fetch(this.orderStatusAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'status',
            id: cartId,
            work: work,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.getOrders()
        }
      } catch (error) {
        console.log(error)
      }
    },

    adminCheck() {
      if (this.is_admin != 1) {
        this.$router.replace('/login-admin')
      }
    },

    logout() {
      this.$router.replace('/login-admin')
      localStorage.setItem('user_id', 0)
      localStorage.setItem('fullName', 0)
      localStorage.setItem('is_admin', 0)
    },
  },
  mounted() {
    this.getItems()
    this.adminCheck()
    this.getCustomers()
    this.getOrders()
  },
  computed: {
    productNumber() {
      return this.items.length
    },

    customerNumber() {
      return this.customers.length
    },

    revenueNumber() {
      return this.orders.reduce((sum, order) => sum + Number(order.total), 0)
    },

    orderNumber() {
      return this.orders.length
    },
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.admin-dashboard-container {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: #f8fafc;
  min-height: 100vh;
  color: #1e293b;
}

/* Navbar Style */
.admin-navbar {
  background: white;
  padding: 1rem 4rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  position: sticky;
  top: 0;
  z-index: 50;
}

.nav-brand {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.logo-icon-box {
  background: linear-gradient(135deg, #a21caf, #db2777);
  color: white;
  padding: 0.5rem;
  border-radius: 10px;
}

.brand-text h1 {
  font-size: 1.15rem;
  font-weight: 800;
  margin: 0;
  color: #db2777;
}

.brand-text p {
  font-size: 0.75rem;
  color: #64748b;
  margin: 0;
}

.nav-controls {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.admin-badge {
  background: #10b981;
  color: white;
  padding: 0.35rem 1rem;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 700;
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: transparent;
  border: none;
  font-weight: 700;
  color: #1e293b;
  cursor: pointer;
  font-size: 0.85rem;
  transition: opacity 0.2s;
}

.logout-btn:hover {
  opacity: 0.7;
}

/* Dashboard Content Section */
.dashboard-content {
  max-width: 1300px;
  margin: 0 auto;
  padding: 2.5rem 2rem;
}

/* Starts Grid System */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.stat-card {
  background: white;
  padding: 1.5rem;
  border-radius: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
}

.revenue {
  border-left: 5px solid #a855f7;
}
.orders {
  border-left: 5px solid #3b82f6;
}
.customers {
  border-left: 5px solid #10b981;
}
.products {
  border-left: 5px solid #f97316;
}

.stat-info label {
  font-size: 0.85rem;
  color: #64748b;
  font-weight: 600;
}

.stat-value {
  font-size: 1.75rem;
  font-weight: 800;
  margin: 0.25rem 0;
  color: #1e293b;
}

.stat-trend {
  font-size: 0.75rem;
  font-weight: 600;
  color: #64748b;
}

.trend-up {
  color: #10b981;
}

.stat-icon-box {
  background: #f1f5f9;
  padding: 0.75rem;
  border-radius: 12px;
  color: inherit;
}

.revenue .stat-icon-box {
  color: #a855f7;
}
.orders .stat-icon-box {
  color: #3b82f6;
}
.customers .stat-icon-box {
  color: #10b981;
}
.products .stat-icon-box {
  color: #f97316;
}

/* Management Section Selection */
.management-section {
  background: white;
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
}

.section-header {
  margin-bottom: 2rem;
}

.section-title {
  font-size: 1.5rem;
  font-weight: 800;
  color: #a855f7;
  margin-bottom: 0.45rem;
}

.section-subtitle {
  color: #64748b;
  font-size: 0.95rem;
}

.tabs-navigation {
  display: flex;
  background: #f1f5f9;
  border-radius: 12px;
  padding: 0.35rem;
  margin-bottom: 2rem;
}

.nav-tab {
  flex: 1;
  padding: 0.75rem;
  border: none;
  background: transparent;
  font-weight: 700;
  color: #64748b;
  cursor: pointer;
  border-radius: 9px;
  transition: all 0.2s;
}

.nav-tab.active {
  background: white;
  color: #1e293b;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

/* Management Table Styles */
.table-container {
  overflow-x: auto;
}

.management-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.management-table th {
  padding: 1rem;
  font-size: 0.85rem;
  font-weight: 700;
  color: #64748b;
  border-bottom: 1px solid #f1f5f9;
}

.management-table td {
  padding: 1.25rem 1rem;
  font-size: 0.9rem;
  border-bottom: 1px solid #f8fafc;
}

.management-table tr:hover {
  background: #fdfdfd;
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  padding: 0.35rem 0.85rem;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: capitalize;
}

.completed {
  background: #ecfdf5;
  color: #059669;
}
.processing {
  background: #eff6ff;
  color: #2563eb;
}
.pending {
  background: #fff7ed;
  color: #ea580c;
}

.deleted {
  background: #fef2f2;
  color: #dc2626;
}

.font-bold {
  font-weight: 700;
}
.text-muted {
  color: #64748b;
  font-size: 0.85rem;
}

.order-count-pill {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 24px;
  height: 24px;
  padding: 0 0.5rem;
  border-radius: 6px;
  border: 1px solid #e2e8f0;
  font-size: 0.75rem;
  font-weight: 700;
  color: #475569;
  background: white;
}

/* Empty State / Placeholder */
.placeholder-view {
  padding: 4rem 2rem;
  text-align: center;
  background: #f8fafc;
  border-radius: 16px;
  border: 1px dashed #cbd5e1;
}

.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.empty-state svg {
  color: #94a3b8;
}

.empty-state h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #334155;
  margin: 0;
}

.empty-state p {
  color: #64748b;
  margin: 0;
}

/* Product Grid Match from Home Page */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
  margin-top: 1.5rem;
}

.product-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  border-color: #e2e8f0;
}

.image-container {
  height: 200px;
  position: relative;
  background: #f8fafc;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.category-chip {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  padding: 0.3rem 0.8rem;
  border-radius: 99px;
  font-size: 0.7rem;
  font-weight: 800;
  color: #a855f7;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.card-details {
  padding: 1.5rem;
}

.card-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 0.75rem;
}

.p-name {
  font-size: 1.15rem;
  font-weight: 800;
  margin: 0;
  color: #0f172a;
}

.p-price {
  font-size: 1.15rem;
  font-weight: 800;
  color: #a855f7;
}

.p-desc {
  color: #64748b;
  font-size: 0.85rem;
  line-height: 1.5;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.stock-stats {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

/* Action Buttons for Tables */
.action-buttons {
  display: flex;
  gap: 0.5rem;
}

.action-btn {
  padding: 0.4rem 0.85rem;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 700;
  cursor: pointer;
  border: none;
  transition: all 0.2s;
}

.action-btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.action-btn:active {
  transform: translateY(0);
}

.success-btn {
  background: #ecfdf5;
  color: #059669;
}

.danger-btn {
  background: #fef2f2;
  color: #dc2626;
}

.stat-badge {
  background: #f1f5f9;
  color: #475569;
  font-size: 0.7rem;
  font-weight: 700;
  padding: 0.35rem 0.75rem;
  border-radius: 9px;
}

.stat-badge.sold {
  background: #fed7aa;
  color: #c2410c;
}

.primary-btn-gradient {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.85rem;
  border-radius: 12px;
  border: none;
  background: linear-gradient(135deg, #a855f7 0%, #db2777 100%);
  color: white;
  font-weight: 800;
  cursor: pointer;
  transition:
    transform 0.2s,
    opacity 0.2s;
}

.primary-btn-gradient:hover {
  opacity: 0.9;
}

.primary-btn-gradient:active {
  transform: scale(0.98);
}

@media (max-width: 768px) {
  .admin-navbar {
    padding: 1rem 1.5rem;
  }
  .dashboard-content {
    padding: 1.5rem 1rem;
  }
  .stats-grid {
    grid-template-columns: 1fr;
  }
  .product-grid {
    grid-template-columns: 1fr;
  }
}
</style>
