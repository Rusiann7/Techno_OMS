<template>
  <!--Header-->
  <nav>
    <div>
      <ul>
        <li>Hello</li>
      </ul>
    </div>
  </nav>

  <div class="modal" v-if="modal">
    <h3>Order {{ this.selected }}</h3>
    <p>Customize your order and specify quantity</p>

    <p><b>Quantity</b></p>
    <input type="number" v-model="quantity" min="1" />
    <p><b>Custom Design Request (Optional)</b></p>
    <input type="text" v-model="request" placeholder="Describe yout custom IT-themed design..." />
    <br />
    <p>
      <b>Subtotal: {{ this.quantity * this.selected_cost }}</b>
    </p>

    <button class="button-cancel" @click="this.modal = false">Cancel</button>
    <button class="button" @click="addCart(this.quantity, this.request, this.selected_id)">
      Add to cart
    </button>
  </div>

  <!--content-->
  <div class="content">
    <div class="header">
      <h2>Custom IT-Themed Products</h2>
      <p>Browse our collection of premium sublimation and DTF printed items</p>
      <button @click="this.modal = !this.modal">Modal</button>
    </div>

    <div class="container">
      <div class="item" v-for="product in items" :key="product.product_id">
        <img
          src="../asset/logo5.png"
          alt="image"
          style="
            max-width: 300px;
            width: 100%;
            height: auto;
            margin-bottom: 80px;
            border-radius: 80px;
          "
        />
        <div class="title">
          <h2>{{ product.product_name }}</h2>
          <h3 style="color: blueviolet">${{ product.product_price }}</h3>
        </div>
        <p>{{ product.product_desc }}</p>
        <button
          class="btn"
          @click="modalOpen(product.product_name, product.product_price, product.product_id)"
        >
          Order Now
        </button>
      </div>
    </div>
    <div>
      <h3>Your cart</h3>
      <div v-for="cart in cart" :key="cart.product_id">
        <ul>
          <li>{{ cart.product_name }}</li>
          <li>{{ cart.category }}</li>
          <li>{{ cart.price }}</li>
          <li>{{ cart.quantity }}</li>
          <li>{{ cart.request }}</li>
          <li>{{ cart.created_at }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'homePage',
  data() {
    return {
      items: [],
      orderAPI: 'http://localhost:8000/productGetter.php',
      isLoading: false,
      modal: false,
      selected: null,
      selected_cost: 0,
      quantity: 1,
      request: null,
      cartAPI: 'http://localhost:8000/addCart.php',
      itemsAPI: 'http://localhost:8000/productGetter.php',
      selected_id: 0,
      user_id: 1,
      cart: [],
      getCartItemsAPI: 'http://localhost:8000/getCartItems.php',
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
          alert('Added the items: ' + qnt + ', ' + request + ', ' + id)
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

    modalOpen(itemName, itemCost, itemId) {
      this.selected = itemName
      this.selected_cost = itemCost
      this.selected_id = itemId
      this.modal = true
    },
  },

  mounted() {
    this.getItems()
    this.getCartItems()
  },
}
</script>

<style scoped>
* {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.header {
  padding: 10px;
}

.container {
  align-items: center;
  display: flex;
  gap: 10px;
}

.item {
  border: solid 10px;
  width: 18%;
  align-items: center;
  border-radius: 30px;
}

.title {
  display: flex;
  gap: 100px;
  align-items: center;
}
</style>
