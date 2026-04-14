<template>
  <div class="app-wrapper">
    <!-- Premium Navbar -->
    <nav class="navbar">
      <div class="nav-container">
        <div class="logo-group">
          <div class="logo-badge">
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
                d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"
              />
            </svg>
          </div>
          <div>
            <h1 class="brand-text">DevSparks</h1>
            <p class="brand-sub">Customer Portal</p>
          </div>
        </div>

        <div class="nav-actions">
          <button class="action-btn cart-btn" @click="cartModal = true">
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
              <circle cx="8" cy="21" r="1" />
              <circle cx="19" cy="21" r="1" />
              <path
                d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"
              />
            </svg>
            <span>Cart</span>
            <span class="count-badge" v-if="cartItemsCount > 0">{{ cartItemsCount }}</span>
          </button>

          <button class="icon-action" @click="ordersModal = true" title="My Orders">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
              <line x1="3" x2="21" y1="6" y2="6" />
              <path d="M16 10a4 4 0 0 1-8 0" />
            </svg>
          </button>

          <button class="logout-link" v-if="logoutIcon" @click="logout">
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
              <line x1="21" x2="9" y1="12" y2="12" />
            </svg>
            <span>Logout</span>
          </button>

          <button class="logout-link" v-if="!logoutIcon" @click="this.$router.push('/login')">
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
              <line x1="21" x2="9" y1="12" y2="12" />
            </svg>
            <span>Log In</span>
          </button>
        </div>
      </div>
    </nav>

    <!-- Main Hero Section -->
    <main class="content-body">
      <div class="hero-text">
        <h2 class="main-title">Custom IT-Themed Products</h2>
        <p class="main-subtitle">
          Browse our collection of premium sublimation and DTF printed items
        </p>
      </div>

      <!-- Product Grid -->
      <div class="product-grid">
        <div class="product-card" v-for="product in items" :key="product.product_id">
          <div class="image-container">
            <img src="../asset/teto.jpg" :alt="product.product_name" />
            <div class="category-chip">{{ product.product_cat }}</div>
          </div>
          <div class="card-details">
            <div class="card-top">
              <h3 class="p-name">{{ product.product_name }}</h3>
              <span class="p-price">${{ product.product_price }}</span>
            </div>
            <p class="p-desc">{{ product.product_desc }}</p>
            <button
              class="primary-btn-gradient"
              @click="modalOpen(product.product_name, product.product_price, product.product_id)"
            >
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
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v8" />
                <path d="M8 12h8" />
              </svg>
              <span>Order Now</span>
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Modals -->
    <!-- Order Now Modal -->
    <div class="modal-backdrop" v-if="modal" @click.self="modal = false">
      <div class="modal-card">
        <div class="modal-head">
          <h3>Order {{ selected }}</h3>
          <button class="close-icon" @click="modal = false">&times;</button>
        </div>
        <p class="modal-desc">Fine-tune your custom product request below.</p>

        <div class="input-field">
          <label>Quantity</label>
          <input type="number" v-model="quantity" min="1" />
        </div>

        <div class="input-field">
          <label>Custom Design Request (Optional)</label>
          <textarea
            v-model="request"
            placeholder="Describe your custom IT-themed design..."
          ></textarea>
        </div>

        <div class="cost-summary">
          <span>Subtotal</span>
          <span class="total-price">${{ quantity * selected_cost }}</span>
        </div>

        <div class="modal-btns">
          <button class="secondary-btn" @click="modal = false">Cancel</button>
          <button class="primary-btn" @click="addCart(quantity, request, selected_id)">
            Add to cart
          </button>
        </div>
      </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal-backdrop" v-if="cartModal" @click.self="cartModal = false">
      <div class="modal-card large">
        <div class="modal-head">
          <h3>Your Cart ({{ cartItemsCount }})</h3>
          <button class="close-icon" @click="cartModal = false">&times;</button>
        </div>

        <div class="scroll-area" v-if="cart.length > 0">
          <div v-for="item in cart" :key="item.cartId" class="list-item">
            <div class="select-check">
              <input type="checkbox" :value="item.cartId" v-model="checkout" />
            </div>
            <div class="item-main">
              <h4>{{ item.product_name }}</h4>
              <p class="tag">{{ item.category }} • {{ item.created_at }}</p>
              <p class="note" v-if="item.request">Note: {{ item.request }}</p>
            </div>
            <div class="item-right">
              <p class="item-math">${{ item.price }} × {{ item.quantity }}</p>
              <p class="item-total">${{ item.price * item.quantity }}</p>
            </div>
          </div>
        </div>
        <div class="empty-msg" v-else>No items in your cart.</div>

        <div class="modal-bottom" v-if="cart.length > 0">
          <div class="sum-row">
            <span>Total Value:</span>
            <span class="big-price">${{ subtotal }}</span>
          </div>
          <button
            class="primary-btn full"
            :disabled="checkout.length === 0"
            @click="checkoutItems()"
          >
            Checkout Selected ({{ checkout.length }})
          </button>
        </div>
      </div>
    </div>

    <!-- Orders Modal -->
    <div class="modal-backdrop" v-if="ordersModal" @click.self="ordersModal = false">
      <div class="modal-card large">
        <div class="modal-head">
          <h3>Order History</h3>
          <button class="close-icon" @click="ordersModal = false">&times;</button>
        </div>

        <div class="scroll-area" v-if="orders.length > 0">
          <div v-for="order in orders" :key="order.cartId" class="list-item">
            <div class="order-stat">
              <span :class="['stat-pill', order.status.toLowerCase()]">{{ order.status }}</span>
            </div>
            <div class="item-main">
              <h4>{{ order.product_name }}</h4>
              <p class="tag">{{ order.category }} • {{ order.created_at }}</p>
            </div>
            <div class="item-right">
              <p class="item-math">${{ order.price }} × {{ order.quantity }}</p>
              <p class="item-total">${{ order.price * order.quantity }}</p>
            </div>
          </div>
        </div>
        <div class="empty-msg" v-else>You haven't placed any orders yet.</div>
      </div>
    </div>

    <!--Success Modal-->
    <div class="success" v-if="isSuccess">
      <span>Task successfully executed!</span>
    </div>

    <!-- Auth Prompt Modal -->
    <div class="modal-backdrop" v-if="authModal" @click.self="authModal = false">
      <div class="modal-card" style="text-align: center; max-width: 400px; padding: 3rem 2rem">
        <div
          style="
            background: #f3e8ff;
            display: inline-flex;
            padding: 1.25rem;
            border-radius: 50%;
            margin-bottom: 1.5rem;
          "
        >
          <svg
            width="32"
            height="32"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#7c3aed"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
            <polyline points="10 17 15 12 10 7" />
            <line x1="15" x2="3" y1="12" y2="12" />
          </svg>
        </div>
        <h3 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0 0 0.75rem 0">
          Authentication Required
        </h3>
        <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 2.5rem; line-height: 1.6">
          You need to be signed in to place a custom order or manage your cart with DevSparks.
        </p>

        <div style="display: flex; flex-direction: column; gap: 1rem">
          <button
            class="primary-btn-gradient"
            @click="this.$router.push('/login')"
            style="width: 100%; border-radius: 14px"
          >
            Sign In / Sign Up
          </button>
          <button class="secondary-btn" @click="authModal = false" style="width: 100%">
            Maybe Later
          </button>
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
  name: 'homePage',
  data() {
    return {
      items: [],
      orderAPI: `${url2}/orderItems.php`,
      isLoading: false,
      modal: false,
      cartModal: false,
      ordersModal: false,
      authModal: false,
      selected: null,
      selected_cost: 0,
      quantity: 1,
      request: null,
      cartAPI: `${url2}/addCart.php`,
      itemsAPI: `${url2}/productGetter.php`,
      selected_id: 0,
      user_id: localStorage.getItem('user_id'),
      cart: [],
      getCartItemsAPI: `${url2}/getCartItems.php`,
      checkout: [],
      getOrderItemsAPI: `${url2}/getOrders.php`,
      orders: [],
      isSuccess: false,
      isFailed: false,
      logoutIcon: false,
    }
  },

  methods: {
    async addCart(qnt, request, id) {
      try {
        this.isLoading = true

        const response = await fetch(this.cartAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'addToCart',
            itemId: id,
            itemQuantity: qnt,
            itemRequest: request,
            userId: this.user_id,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.isSuccess = true
          this.modal = false
          this.getCartItems()
        } else {
          console.log('Error')
        }
      } catch (error) {
        console.log(error)
      }
    },

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

    async getCartItems() {
      try {
        this.isLoading = false

        const response = await fetch(this.getCartItemsAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'getItemsCart',
            userId: this.user_id,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.cart = result.cart
        } else {
          console.log('Error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    async checkoutItems() {
      try {
        this.isLoading = true

        const response = await fetch(this.orderAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'orderItems',
            items: this.checkout,
            userId: this.user_id,
          }),
        })

        const result = await response.json()

        if (result.success) {
          alert('success')
          this.getCartItems()
          this.getOrderItems()
        } else {
          alert('failed')
          this.isLoading = false
        }
      } catch (error) {
        console.log(error)
      }
    },

    async getOrderItems() {
      try {
        this.isLoading = true

        const response = await fetch(this.getOrderItemsAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'getOrders',
            userId: this.user_id,
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

    modalOpen(itemName, itemCost, itemId) {
      if (!this.user_id || this.user_id === '0') {
        this.authModal = true
        return
      }
      this.selected = itemName
      this.selected_cost = itemCost
      this.selected_id = itemId
      this.modal = true
    },

    logout() {
      this.$router.replace('/login')
      localStorage.setItem('user_id', 0)
      localStorage.setItem('fullName', 0)
    },

    logoutState() {
      if (!this.user_id || this.user_id === '0') {
        this.logoutIcon = false
      }
    },
  },

  mounted() {
    this.getItems()
    this.getCartItems()
    this.getOrderItems()
    this.logoutState()
  },

  computed: {
    subtotal() {
      return this.cart
        .filter((item) => this.checkout.includes(item.cartId))
        .reduce((total, item) => total + item.price * item.quantity, 0)
    },

    selected_items() {
      return this.checkout.length
    },

    cartItemsCount() {
      return this.cart.length
    },

    orderItemsCount() {
      return this.orders.length
    },
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.app-wrapper {
  font-family: 'Plus Jakarta Sans', sans-serif;
  min-height: 100vh;
  background: radial-gradient(circle at top right, #fbf7ff, #f3f4f6);
  color: #1e293b;
  margin: 0;
  padding: 0;
}

/* Navbar Styling */
.navbar {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(226, 232, 240, 0.8);
  padding: 0.75rem 0;
  position: sticky;
  top: 0;
  z-index: 100;
  margin: 0;
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo-group {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.logo-badge {
  background: linear-gradient(135deg, #a855f7 0%, #d946ef 100%);
  color: white;
  padding: 0.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
}

.brand-text {
  font-size: 1.25rem;
  font-weight: 800;
  margin: 0;
  background: linear-gradient(to right, #7c3aed, #db2777);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  line-height: 1;
}

.brand-sub {
  font-size: 0.75rem;
  color: #64748b;
  margin: 0;
  font-weight: 500;
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 1.25rem;
}

.action-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1rem;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  background: white;
  font-weight: 600;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.2s;
  position: relative;
}

.action-btn:hover {
  border-color: #7c3aed;
  color: #7c3aed;
  transform: translateY(-1px);
}

.count-badge {
  position: absolute;
  top: -6px;
  right: -6px;
  background: #ef4444;
  color: white;
  font-size: 0.7rem;
  padding: 0.1rem 0.4rem;
  border-radius: 99px;
  border: 2px solid white;
}

.icon-action {
  background: transparent;
  border: none;
  color: #64748b;
  padding: 0.6rem;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.2s;
}

.icon-action:hover {
  background: #f1f5f9;
  color: #0f172a;
}

.logout-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: transparent;
  border: none;
  color: #475569;
  font-weight: 600;
  font-size: 0.9rem;
  cursor: pointer;
  padding: 0.5rem;
}

/* Content Layout */
.content-body {
  max-width: 1200px;
  margin: 0 auto;
  padding: 3.5rem 2rem;
}

.hero-text {
  margin-bottom: 3.5rem;
}

.main-title {
  font-size: 2.75rem;
  font-weight: 800;
  letter-spacing: -0.025em;
  margin: 0 0 0.75rem 0;
  color: #0f172a;
}

.main-subtitle {
  font-size: 1.15rem;
  color: #64748b;
  max-width: 600px;
}

/* Grid & Cards */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
}

.product-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  border-color: #e2e8f0;
}

.image-container {
  height: 220px;
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
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(4px);
  padding: 0.3rem 0.8rem;
  border-radius: 99px;
  font-size: 0.7rem;
  font-weight: 700;
  color: #7c3aed;
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
  font-size: 1.25rem;
  font-weight: 700;
  margin: 0;
  color: #0f172a;
}

.p-price {
  font-size: 1.25rem;
  font-weight: 800;
  color: #7c3aed;
}

.p-desc {
  color: #64748b;
  font-size: 0.9rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.primary-btn-gradient {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.85rem;
  border-radius: 14px;
  border: none;
  background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
  color: white;
  font-weight: 700;
  cursor: pointer;
  transition:
    transform 0.2s,
    opacity 0.2s;
}

.primary-btn-gradient:active {
  transform: scale(0.98);
}

/* Modal System */
.modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.4);
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1.5rem;
  gap: 20px;
}

.modal-card {
  background: white;
  border-radius: 32px;
  width: 100%;
  max-width: 480px;
  padding: 2.5rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  animation: slideUp 0.3s ease-out;
  gap: 20px;
}

.modal-card.large {
  max-width: 850px;
  height: 85vh;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.modal-head h3 {
  font-size: 1.75rem;
  font-weight: 800;
  margin: 0;
}

.close-icon {
  background: none;
  border: none;
  font-size: 2rem;
  color: #94a3b8;
  cursor: pointer;
  line-height: 1;
}

.modal-desc {
  color: #64748b;
  margin-bottom: 2rem;
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

.cost-summary {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 2rem 0;
  padding-top: 1.5rem;
  border-top: 1px solid #f1f5f9;
}

.total-price {
  font-size: 1.75rem;
  font-weight: 800;
  color: #7c3aed;
}

.modal-btns {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.primary-btn {
  background: #7c3aed;
  color: white;
  border: none;
  padding: 1rem;
  border-radius: 14px;
  font-weight: 700;
  cursor: pointer;
}

.secondary-btn {
  background: #f1f5f9;
  color: #475569;
  border: none;
  padding: 1rem;
  border-radius: 14px;
  font-weight: 700;
  cursor: pointer;
}

/* Lists and Utilities */
.scroll-area {
  overflow-y: auto;
  flex: 1;
  margin: 1.5rem 0;
  padding-right: 0.5rem;
}

.list-item {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  padding: 1.5rem;
  background: #f8fafc;
  border-radius: 20px;
  margin-bottom: 1rem;
  border: 1px solid #f1f5f9;
}

.item-main {
  flex: 1;
}
.item-main h4 {
  margin: 0 0 0.25rem 0;
  font-size: 1.1rem;
}
.tag {
  font-size: 0.85rem;
  color: #64748b;
  margin: 0;
}
.note {
  font-size: 0.85rem;
  color: #7c3aed;
  font-weight: 600;
  margin-top: 0.5rem;
}

.item-right {
  text-align: right;
}
.item-math {
  font-size: 0.85rem;
  color: #64748b;
  margin: 0;
}
.item-total {
  font-weight: 800;
  color: #0f172a;
  font-size: 1.1rem;
  margin: 0;
}

.modal-bottom {
  background: #f1f5f9;
  padding: 2rem;
  border-radius: 24px;
  margin-top: auto;
}

.sum-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.big-price {
  font-size: 1.5rem;
  font-weight: 800;
  color: #7c3aed;
}

.stat-pill {
  padding: 0.4rem 0.8rem;
  border-radius: 99px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
}
.stat-pill.completed {
  background: #dcfce7;
  color: #166534;
}
.stat-pill.pending {
  background: #fef9c3;
  color: #854d0e;
}

.empty-msg {
  text-align: center;
  padding: 4rem;
  color: #94a3b8;
  font-weight: 500;
}

@media (max-width: 640px) {
  .product-grid {
    grid-template-columns: 1fr;
  }
  .main-title {
    font-size: 2rem;
  }
  .modal-btns {
    grid-template-columns: 1fr;
  }
}

.success,
.error {
  position: fixed;
  top: 1.5rem;
  left: 50%;
  transform: translateX(-50%);
  padding: 1.5rem 2rem;
  border-radius: 0.75rem;
  font-weight: 600;
  z-index: 1000;
  text-align: center;
  min-width: 300px;
  max-width: 90%;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  animation:
    slideIn 0.3s ease-out,
    timeout 6s linear forwards;
  font-size: 1.1rem;
}

.success {
  background-color: #10b981;
  color: #ffffff;
  border: 2px solid #059669;
}

.error {
  background-color: #ef4444;
  color: #ffffff;
  border: 2px solid #dc2626;
}

.success span,
.error span {
  display: block;
}

/* Progress bar for timeout */
.success::after,
.error::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  height: 4px;
  background: rgba(255, 255, 255, 0.5);
  animation: progress 5s linear forwards;
}

@keyframes timeout {
  0% {
    opacity: 1;
    visibility: visible;
  }
  80% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    visibility: hidden;
  }
}
</style>
