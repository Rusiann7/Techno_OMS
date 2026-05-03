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
            <h2 class="stat-value">{{ productNumber }}</h2>
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
          <button
            :class="['nav-tab', { active: currentTab === 'pos' }]"
            @click="currentTab = 'pos'"
          >
            Point of Sales
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
                <th>Design</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Placed On</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="order in orders" :key="order.cartId">
                <td class="font-bold">{{ order.customer_name }}</td>
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
                <td>{{ order.design }}</td>
                <td>
                  <span class="order-count-pill">{{ order.quantity }}</span>
                </td>
                <td class="font-bold" style="color: #a855f7">₱{{ order.total }}</td>
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
                      @click.prevent="orderStatus(order.cartId, 'done', order.quantity)"
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
                <td class="font-bold" style="color: #1e293b">₱{{ customer.total_spent }}</td>
                <td class="text-muted">{{ customer.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Products Grid (Matches homePage.vue) -->
        <div v-if="currentTab === 'products'" class="product-grid">
          <div class="product-card" v-for="product in items" :key="product.product_id">
            <div class="image-container">
              <img :src="'/' + product.product_image" :alt="product.product_name" />
              <div class="category-chip">{{ product.product_cat || 'Category' }}</div>
            </div>
            <div class="card-details">
              <div class="card-top">
                <h3 class="p-name">{{ product.product_name }}</h3>
                <span class="p-price">₱{{ product.product_price }}</span>
              </div>
              <p class="p-desc">{{ product.product_desc }}</p>

              <div class="stock-stats">
                <span class="stat-badge">Stock: {{ product.product_stock }}</span>
                <span class="stat-badge sold">Sold: {{ product.product_sold }}</span>
              </div>

              <button class="primary-btn-gradient" @click="editProduct(product.product_id)">
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

          <!-- Product Edit Modal -->
          <div v-if="modal" class="modal-overlay" @click.self="modal = false">
            <div class="modal-content">
              <div class="modal-header">
                <h2>Edit Product</h2>
                <button class="close-btn" @click="modal = false">
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
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </button>
              </div>

              <div class="modal-body">
                <div class="form-group">
                  <label>Product Name</label>
                  <input
                    type="text"
                    v-model="selectedProduct.name"
                    class="form-input"
                    placeholder="Enter product name"
                  />
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <input
                    type="text"
                    v-model="selectedProduct.cat"
                    class="form-input"
                    placeholder="Enter category"
                  />
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea
                    v-model="selectedProduct.desc"
                    class="form-input"
                    rows="3"
                    placeholder="Enter product description"
                  ></textarea>
                </div>
                <div class="form-group">
                  <label>Price</label>
                  <input
                    type="number"
                    v-model="selectedProduct.price"
                    class="form-input"
                    placeholder="0.00"
                  />
                </div>
              </div>

              <div class="modal-footer">
                <button class="action-btn danger-btn" @click="modal = false">Cancel</button>
                <button
                  class="primary-btn-gradient save-btn"
                  @click.prevent="editProductDB()"
                  @click="modal = false"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </div>
        </div>

        <div v-if="currentTab === 'pos'" class="pos-tab-content">
          <div class="product-grid">
            <div class="product-card" v-for="product in items" :key="product.product_id">
              <div class="image-container">
                <img :src="'/' + product.product_image" :alt="product.product_name" />
                <div class="category-chip">{{ product.product_cat || 'Category' }}</div>
              </div>
              <div class="card-details">
                <div class="card-top">
                  <h3 class="p-name">{{ product.product_name }}</h3>
                  <span class="p-price">₱{{ product.product_price }}</span>
                </div>
                <p class="p-desc">{{ product.product_desc }}</p>

                <div class="stock-stats">
                  <span class="stat-badge">Stock: {{ product.product_stock }}</span>
                  <span class="stat-badge sold">Sold: {{ product.product_sold }}</span>
                </div>

                <button class="primary-btn-gradient" @click="openPosModal(product)">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                    <path d="M3 6h18" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                  </svg>
                  <span>Quick Sale</span>
                </button>
              </div>
            </div>
          </div>

          <!-- POS Sale Modal -->
          <div v-if="pos_modal" class="modal-overlay" @click.self="pos_modal = false">
            <div class="modal-content pos-modal-wide">
              <div class="modal-header">
                <div class="modal-title-group">
                  <h2>New Transaction</h2>
                  <p class="modal-subtitle">Processing sale for {{ selectedProduct.name }}</p>
                </div>
                <button class="close-btn" @click="pos_modal = false">
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
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </button>
              </div>

              <div class="modal-body pos-split-layout">
                <!-- Left: Design Selector -->
                <div class="pos-preview-section">
                  <label class="section-label">Selected Design</label>
                  <div class="pos-design-card">
                    <div class="pos-image-frame">
                      <img :src="currentimage" :alt="currentImageName" v-if="currentimage" />
                      <div class="no-image-placeholder" v-else>
                        <svg
                          width="48"
                          height="48"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1.5"
                        >
                          <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                          <circle cx="8.5" cy="8.5" r="1.5" />
                          <polyline points="21 15 16 10 5 21" />
                        </svg>
                        <span>No Design Selected</span>
                      </div>
                    </div>
                    <div class="pos-image-navigator">
                      <button class="nav-btn-round" @click="previousImage">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2.5"
                        >
                          <path d="m15 18-6-6 6-6" />
                        </svg>
                      </button>
                      <div class="design-info">
                        <span class="design-label">Design Variant</span>
                        <span class="design-title">{{ currentImageName || 'Default' }}</span>
                      </div>
                      <button class="nav-btn-round" @click="nextImage">
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2.5"
                        >
                          <path d="m9 18 6-6-6-6" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Right: Sale Details -->
                <div class="pos-details-section">
                  <div class="pos-summary-card">
                    <div class="summary-item">
                      <span class="label">Unit Price</span>
                      <span class="value">₱{{ selectedProduct.price }}</span>
                    </div>
                    <div class="summary-item">
                      <span class="label">Product ID</span>
                      <span class="value">#{{ selectedProduct.id }}</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-field">
                      <label>Custom Design Request (Optional)</label>
                      <textarea
                        v-model="request"
                        placeholder="Describe your custom IT-themed design..."
                      ></textarea>
                    </div>

                    <label>Sale Quantity</label>
                    <div class="pos-qty-stepper">
                      <button class="stepper-btn" @click="posQuantity > 1 ? posQuantity-- : null">
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="3"
                        >
                          <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                      </button>
                      <input
                        type="number"
                        v-model.number="posQuantity"
                        min="1"
                        class="stepper-input"
                      />
                      <button class="stepper-btn" @click="posQuantity++">
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="3"
                        >
                          <line x1="12" y1="5" x2="12" y2="19" />
                          <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  <div class="pos-bill-section">
                    <div class="bill-header">
                      <span>Order Summary</span>
                    </div>
                    <div class="bill-row total">
                      <span>Total Amount</span>
                      <span class="total-price">₱{{ selectedProduct.price * posQuantity }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button class="modal-secondary-btn" @click="pos_modal = false">Cancel</button>
                <button
                  class="primary-btn-gradient pos-confirm-btn"
                  @click="posFeature(selectedProduct.id)"
                >
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                  >
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                  <span>Complete Sale</span>
                </button>
              </div>
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
      modal: false,
      selectedProduct: [],
      editProductAPI: `${url2}/editProducts.php`,
      getDesignAPI: `${url2}/getDesigns.php`,
      design: [],
      design_drinkware: [],
      currentIndex: 0,
      selected_array: 'design',
      selected_category: null,
      posAPI: `${url2}/posAPI.php`,
      pos_modal: false,
      posQuantity: 1,
      request: null,
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
            'ngrok-skip-browser-warning': 'true',
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
            'ngrok-skip-browser-warning': 'true',
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
            'ngrok-skip-browser-warning': 'true',
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

    async orderStatus(cartId, work, quantity) {
      try {
        this.isLoading = true

        const response = await fetch(this.orderStatusAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'status',
            id: cartId,
            work: work,
            qnt: quantity,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.getOrders()
          this.getItems()
        }
      } catch (error) {
        console.log(error)
      }
    },

    async editProductDB() {
      try {
        this.isLoading = true

        const response = await fetch(this.editProductAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'applicatio/json',
          },
          body: JSON.stringify({
            action: 'editProducts',
            ...this.selectedProduct,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.getItems()
        } else {
          this.isLoading = false
          console.log('error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    async posFeature(id) {
      try {
        this.isLoading = true

        const response = await fetch(this.posAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'posFeature',
            itemId: id,
            itemQuantity: this.posQuantity,
            itemRequest: this.request,
            design: this.currentImageName,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.pos_modal = false
          this.getItems()
          this.getOrders()
        } else {
          this.isLoading = false
          console.log('error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    async getDesigns() {
      try {
        const response = await fetch(this.getDesignAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'getDesigns',
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.design = result.design
          this.design_drinkware = result.design_drinkware
        } else {
          this.isLoading = false
          console.log('error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    nextImage() {
      switch (this.selected_category) {
        case 'Drinkware':
          this.currentIndex = (this.currentIndex + 1) % this.design_drinkware.length
          this.selected_array = 'design_drinkware'
          break
        default:
          this.currentIndex = (this.currentIndex + 1) % this.design.length
          this.selected_array = 'design'
      }
    },

    previousImage() {
      switch (this.selected_category) {
        case 'Drinkware':
          this.currentIndex =
            (this.currentIndex - 1 + this.design_drinkware.length) % this.design_drinkware.length
          this.selected_array = 'design_drinkware'
          break
        default:
          this.currentIndex = (this.currentIndex - 1 + this.design.length) % this.design.length
          this.selected_array = 'design'
      }
    },

    adminCheck() {
      if (this.is_admin != 1) {
        this.$router.replace('/login-admin')
      }
    },

    editProduct(id) {
      const p = this.items.find((product) => product.product_id === id)

      this.selectedProduct = {
        name: p.product_name,
        cat: p.product_cat,
        desc: p.product_desc,
        price: p.product_price,
        id: p.product_id,
      }
      this.modal = true
    },

    logout() {
      this.$router.replace('/login-admin')
      localStorage.setItem('user_id', 0)
      localStorage.setItem('fullName', 0)
      localStorage.setItem('is_admin', 0)
    },

    openPosModal(product) {
      this.selectedProduct = {
        name: product.product_name,
        cat: product.product_cat,
        desc: product.product_desc,
        price: product.product_price,
        id: product.product_id,
      }
      this.selected_category = product.product_cat
      this.currentIndex = 0
      this.selected_array = this.selected_category === 'Drinkware' ? 'design_drinkware' : 'design'
      this.posQuantity = 1
      this.pos_modal = true
    },
  },
  mounted() {
    this.getItems()
    this.adminCheck()
    this.getCustomers()
    this.getOrders()
    this.getDesigns()
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

    selectedItemsTotal() {
      return this.orders
    },

    currentimage() {
      const arr = this[this.selected_array]
      if (!arr || arr.length === 0) return ''
      return '/' + arr[this.currentIndex].image
    },

    currentImageName() {
      const arr = this[this.selected_array]
      if (!arr || arr.length === 0) return ''
      return arr[this.currentIndex].image
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

/* POS Modal Split Layout */
.modal-content.pos-modal-wide {
  max-width: 850px;
  width: 95%;
  max-height: 90vh;
  padding: 0;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  padding: 25px;
}

.modal-title-group h2 {
  font-size: 1.25rem;
  font-weight: 800;
  color: #1e293b;
  margin-bottom: 0.25rem;
}

.modal-subtitle {
  font-size: 0.85rem;
  color: #64748b;
  margin: 0;
}

.pos-split-layout {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 0;
  border-top: 1px solid #f1f5f9;
  border-bottom: 1px solid #f1f5f9;
  overflow-y: auto;
  flex: 1;
}

.pos-preview-section {
  padding: 2.5rem;
  background: #f8fafc;
  border-right: 1px solid #f1f5f9;
}

.section-label {
  display: block;
  font-size: 0.75rem;
  font-weight: 800;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 1rem;
}

.pos-design-card {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.pos-image-frame {
  width: 100%;
  max-width: 350px;
  margin: 0 auto;
  aspect-ratio: 1;
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #e2e8f0;
}

.pos-image-frame img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.no-image-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  color: #cbd5e1;
}

.no-image-placeholder span {
  font-size: 0.85rem;
  font-weight: 600;
}

.pos-image-navigator {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: white;
  padding: 0.75rem;
  border-radius: 16px;
  border: 1px solid #e2e8f0;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
}

.nav-btn-round {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid #f1f5f9;
  background: #f8fafc;
  color: #64748b;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}

.nav-btn-round:hover {
  background: #1e293b;
  color: white;
  border-color: #1e293b;
}

.design-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 150px;
}

.design-label {
  font-size: 0.65rem;
  font-weight: 700;
  color: #94a3b8;
  text-transform: uppercase;
}

.design-title {
  font-size: 0.85rem;
  font-weight: 700;
  color: #1e293b;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%;
  text-align: center;
}

.pos-details-section {
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.pos-summary-card {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.summary-item {
  background: #f1f5f9;
  padding: 1rem;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.summary-item .label {
  font-size: 0.7rem;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
}

.summary-item .value {
  font-size: 1.1rem;
  font-weight: 800;
  color: #1e293b;
}

.pos-qty-stepper {
  display: flex;
  align-items: center;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 0.5rem;
  width: fit-content;
}

.stepper-btn {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  border: none;
  background: white;
  color: #1e293b;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  transition: all 0.2s;
}

.stepper-btn:hover {
  background: #1e293b;
  color: white;
}

.stepper-input {
  width: 60px;
  border: none;
  background: transparent;
  text-align: center;
  font-size: 1.1rem;
  font-weight: 800;
  color: #1e293b;
  outline: none;
}

.pos-bill-section {
  margin-top: auto;
  background: #f1f5f9;
  color: white;
  padding: 1.5rem;
  border-radius: 16px;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.bill-header {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  color: #94a3b8;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding-bottom: 0.75rem;
  margin-bottom: 0.25rem;
}

.bill-row {
  display: flex;
  justify-content: space-between;
  font-size: 0.95rem;
  color: #64748b;
  font-weight: 600;
}

.bill-row span:last-child {
  color: #1e293b;
  font-weight: 700;
}

.bill-row.total {
  margin-top: 0.5rem;
  padding-top: 0.75rem;
  border-top: 1px solid rgba(255, 255, 255, 0.2);
  color: #1e293b;
  font-weight: 800;
}

.total-price {
  font-size: 1.5rem;
  color: #f472b6;
}

.modal-secondary-btn {
  padding: 0.75rem 1.5rem;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  background: white;
  color: #64748b;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s;
}

.modal-secondary-btn:hover {
  background: #f8fafc;
  color: #1e293b;
}

.pos-confirm-btn {
  width: auto;
  padding: 0.75rem 2rem;
}

@media (max-width: 640px) {
  .pos-split-layout {
    grid-template-columns: 1fr;
  }
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

  .nav-controls {
    gap: 0.75rem;
  }

  .logout-btn span {
    display: none;
  }

  .dashboard-content {
    padding: 1.5rem 1rem;
  }

  .management-section {
    padding: 1.25rem;
  }

  .section-title {
    font-size: 1.25rem;
  }

  .stats-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .product-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .management-table th,
  .management-table td {
    padding: 0.75rem 0.5rem;
    font-size: 0.8rem;
  }

  .modal-content {
    padding: 1.5rem;
    margin: 0 1rem;
    max-height: 90vh;
    overflow-y: auto;
  }
}

@media (max-width: 480px) {
  .admin-badge {
    display: none;
  }

  .brand-text p {
    display: none;
  }

  .nav-tab {
    padding: 0.6rem 0.25rem;
    font-size: 0.75rem;
  }

  .image-container {
    height: 180px;
  }
}

/* Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(4px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 100;
}

.modal-content {
  background: white;
  border-radius: 20px;
  width: 100%;
  max-width: 500px;
  padding: 2rem;
  box-shadow:
    0 20px 25px -5px rgba(0, 0, 0, 0.1),
    0 10px 10px -5px rgba(0, 0, 0, 0.04);
  animation: modalIn 0.3s ease-out forwards;
}

@keyframes modalIn {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.modal-header h2 {
  font-size: 1.5rem;
  font-weight: 800;
  color: #1e293b;
  margin: 0;
}

.close-btn {
  background: transparent;
  border: none;
  color: #64748b;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.close-btn:hover {
  background: #f1f5f9;
  color: #ef4444;
}

.modal-body {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  margin-bottom: 2rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-group label {
  font-size: 0.85rem;
  font-weight: 700;
  color: #475569;
}

.form-input {
  padding: 0.75rem 1rem;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  font-size: 0.95rem;
  color: #1e293b;
  font-family: inherit;
  transition: all 0.2s;
  background: #f8fafc;
}

.form-input:focus {
  outline: none;
  border-color: #a855f7;
  background: white;
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
}

.save-btn {
  width: auto;
  padding: 0.65rem 1.5rem;
}

.input-field {
  margin-bottom: 1.5rem;
}

.input-field label {
  display: block;
  font-weight: 700;
  margin-bottom: 0.6rem;
  font-size: 0.95rem;
}

.input-field input,
.input-field textarea {
  width: 100%;
  padding: 1rem;
  border-radius: 14px;
  border: 1px solid #e2e8f0;
  font-family: inherit;
  font-size: 1rem;
  background: #f8fafc;
}
</style>
