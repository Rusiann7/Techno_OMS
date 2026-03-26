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
    <button class="button" @click="addCart(this.selected, this.quantity, this.request)">
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
      <div class="item">
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
          <h2>Custon IT Mug</h2>
          <h3 style="color: blueviolet">$12</h3>
        </div>
        <p>Premium ceramic mug with custom IT-themed sublimation printing.</p>
        <button class="btn" @click="modalOpen('Custom IT Mug', 12)">Order Now</button>
      </div>

      <!--2nd item-->

      <div class="item">
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
          <h2>Tech Tote Bag</h2>
          <h3 style="color: blueviolet">$18</h3>
        </div>
        <p>Durable canvas tote bag with custom DTF printed tach designs.</p>
        <button class="btn">Order Now</button>
      </div>

      <!--3rd item-->
      <div class="item">
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
          <h2>Developer Wallet</h2>
          <h3 style="color: blueviolet">$24</h3>
        </div>
        <p>Premium leather wallet with personalized IT graphics.</p>
        <button class="btn">Order Now</button>
      </div>

      <!--4th item-->
      <div class="item">
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
          <h2>Code Handkerchief</h2>
          <h3 style="color: blueviolet">$8</h3>
        </div>
        <p>Soft cotton Handkerchief with custom IT-themed pattern.</p>
        <button class="btn">Order Now</button>
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
      orderAPI: null,
      isLoading: false,
      modal: false,
      selected: null,
      selected_cost: 0,
      quantity: 1,
      request: null,
      cartAPI: null,
    }
  },

  methods: {
    async orderItem(item, qnt) {
      try {
        this.isLoading = true

        const response = await fetch(this.orderAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ action: 'getOrderFunction', prod: item, no: qnt }),
        })

        const result = await response

        if (result.success) {
          console.log('Success')
          this.isLoading = false
        } else {
          this.isLoading = false
          console.log('Error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    addCart(item, qnt, request) {
      console.log(item, qnt, request)
    },

    /* async addCart(item, qnt, request) {
      try {
        this.isLoading = true

        const response = await fetch(this.cartAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'addToCart',
            itemName: item,
            itemQuantiy: qnt,
            itemRequest: request,
          }),
        })

        const result = await response

        if (result.success) {
          console.log('you have added', item, qnt, request)
        } else {
          console.log('Error')
        }
      } catch (error) {
        console.log(error)
      }
    }, */

    modalOpen(itemName, itemCost) {
      this.selected = itemName
      this.selected_cost = itemCost
      this.modal = true
    },
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
