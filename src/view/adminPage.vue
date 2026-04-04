<template>
  <!--Header-->
  <nav>
    <ul>
      <li>hello</li>
    </ul>
  </nav>

  <!--content-->
  <div class="content">
    <div class="Head">
      <div>
        <h3>Total revenue</h3>
      </div>

      <div>
        <h3>Total Orders</h3>
      </div>

      <div>
        <h3>Total customers</h3>
      </div>

      <div>
        <h3>products</h3>
        <p>{{ productNumber }}</p>
      </div>
    </div>

    <div class="dashboard">
      <h2>Management Dashboard</h2>
      <p>View and manage Orders, Customers, and Products</p>

      <div class="item" v-for="product in items" :key="product.product_id">
        <img
          src="../asset/teto.jpg"
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
        <p>Stock: {{ product.product_stock }}</p>
        <p>Sold: {{ product.product_sold }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      itemsAPI: 'http://localhost:8000/productGetterAdmin.php',
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
  },
  mounted() {
    this.getItems()
  },
  computed: {
    productNumber() {
      return this.items.length
    },
  },
}
</script>
