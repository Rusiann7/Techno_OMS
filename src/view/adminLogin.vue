<template>
  <div class="content">
    <div>
      <h1>ADMIN LOGIN PORTAL</h1>
    </div>

    <div>
      <form @submit.prevent="logIn">
        <label for="">Email</label>
        <input type="text" v-model="login.email" />

        <label for="">Password</label>
        <input type="text" v-model="login.password" />

        <button type="submit">Log In</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'loginA',

  data() {
    return {
      login: { email: '', password: '' },
      isLoading: false,
      loginAPI: 'http://localhost:8000/loginAPI-admin.php',
    }
  },

  methods: {
    async logIn() {
      try {
        this.isLoading = true

        const response = await fetch(this.loginAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'loginA',
            ...this.login,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false

          this.$router.replace('/admin')
        } else {
          alert('error')
        }
      } catch (error) {
        console.log(error)
      }
    },
  },
}
</script>
