<template>
  <div class="landing-wrapper">
    <!-- Header Section -->
    <header class="header">
      <div class="logo-container">
        <div class="printer-icon">
          <svg
            width="28"
            height="28"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="6 9 6 2 18 2 18 9" />
            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
            <rect x="6" y="14" width="12" height="8" />
          </svg>
        </div>
        <h1 class="brand-name">DevSparks</h1>
        <p class="brand-tagline">Sublimation & DTF Printing Technology</p>

        <button class="primary-gradient-btn" @click="this.$router.replace('/login-admin')">
          Go to admin login
        </button>
      </div>
    </header>

    <!-- Main Content Selection -->
    <main class="content-container">
      <!-- Customer Card (Now Centered) -->
      <div class="auth-card">
        <div class="card-header">
          <div class="role-icon">
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
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </div>
          <h2 class="role-title">CUSTOMER</h2>
          <p class="role-subtitle">Customer Portal - Browse & Order Products</p>
        </div>

        <div class="card-content">
          <!-- Toggle Tabs -->
          <div class="tabs-group">
            <button :class="['tab-btn', { active: modal === 'login' }]" @click="modal = 'login'">
              Login
            </button>
            <button :class="['tab-btn', { active: modal === 'signup' }]" @click="modal = 'signup'">
              Register
            </button>
          </div>

          <!-- Login Portal -->
          <form v-if="modal === 'login'" @submit.prevent="logIn" class="auth-box">
            <div class="input-field">
              <label>Email</label>
              <input
                type="email"
                v-model="loginForm.email"
                placeholder="customer@email.com"
                required
              />
            </div>

            <div class="input-field">
              <label>Password</label>
              <input type="password" v-model="loginForm.password" placeholder="********" required />
            </div>

            <button type="submit" class="primary-gradient-btn" :disabled="isLoading">
              <span v-if="!isLoading">Login as Customer</span>
              <span v-else>Loading...</span>
            </button>
          </form>

          <!-- Signup Portal -->
          <form v-if="modal === 'signup'" @submit.prevent="signUp" class="auth-box">
            <div class="input-field">
              <label>Fullname</label>
              <input
                type="text"
                v-model="signupForm.fullname"
                placeholder="Enter your full name"
                required
              />
            </div>

            <div class="input-field">
              <label>Email</label>
              <input
                type="email"
                v-model="signupForm.email"
                placeholder="customer@email.com"
                required
              />
            </div>

            <div class="input-field">
              <label>Password</label>
              <input
                type="password"
                v-model="signupForm.password"
                placeholder="Min. 8 characters"
                required
              />
            </div>

            <div class="input-field">
              <label>Confirm Password</label>
              <input
                type="password"
                v-model="signupForm.conpassword"
                placeholder="Re-type password"
                required
              />
            </div>

            <button type="submit" class="primary-gradient-btn" :disabled="isLoading">
              <span v-if="!isLoading">Create Account</span>
              <span v-else>Creating...</span>
            </button>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'loginPage',
  data() {
    return {
      loginForm: { email: '', password: '' },
      modal: 'login',
      signupForm: { email: '', password: '', conpassword: '', fullname: '' },
      isLoading: false,
      loginAPI: 'http://localhost:8000/loginAPI-customer.php',
      signupAPI: 'http://localhost:8000/signUpAPI.php',
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
            action: 'loginC',
            ...this.loginForm,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false

          localStorage.setItem('user_id', result.user_id)
          localStorage.setItem('fullName', result.fullName)

          this.$router.replace('/')
        } else {
          this.isLoading = false
          console.log('Error')
        }
      } catch (error) {
        console.log(error)
      }
    },

    async signUp() {
      try {
        this.isLoading = true

        const response = await fetch(this.signupAPI, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'signup',
            ...this.signupForm,
            role: 'customer',
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false
          this.modal = 'login'
        } else {
          this.isLoading = false
        }
      } catch (error) {
        console.log(error)
      }
    },
  },
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.landing-wrapper {
  font-family: 'Plus Jakarta Sans', sans-serif;
  height: 100vh;
  background: linear-gradient(135deg, #a21caf 0%, #db2777 30%, #ea580c 100%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  color: white;
  overflow: hidden;
}

/* Header */
.header {
  text-align: center;
  margin-bottom: 2rem;
}

.logo-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
}

.printer-icon {
  background: white;
  color: #db2777;
  padding: 0.6rem;
  border-radius: 50%;
  display: flex;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.brand-name {
  font-size: 2rem;
  font-weight: 800;
  margin: 0.5rem 0 0 0;
  letter-spacing: -0.02em;
}

.brand-tagline {
  font-size: 0.8rem;
  opacity: 0.9;
  font-weight: 500;
}

/* Content Layout (Centered) */
.content-container {
  width: 100%;
  max-width: 440px;
}

.auth-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
  display: flex;
  flex-direction: column;
  border-top: 6px solid #0ea5e9;
  background: #f0f9ff;
}

/* Card Header */
.card-header {
  padding: 1.5rem 1.5rem 1rem;
  text-align: center;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.role-icon {
  background: #0ea5e9;
  color: white;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 0.75rem;
  box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
}

.role-title {
  color: #0ea5e9;
  font-size: 1.25rem;
  font-weight: 800;
  margin: 0;
  letter-spacing: -0.01em;
}

.role-subtitle {
  color: #64748b;
  font-size: 0.8rem;
  margin: 0.25rem 0 0;
  font-weight: 500;
  opacity: 0.8;
}

/* Card Content */
.card-content {
  background: white;
  padding: 1.75rem 2rem 2rem;
}

.tabs-group {
  display: flex;
  background: #f1f5f9;
  padding: 0.25rem;
  border-radius: 12px;
  margin-bottom: 1.5rem;
}

.tab-btn {
  flex: 1;
  padding: 0.65rem;
  border-radius: 10px;
  border: none;
  background: transparent;
  color: #64748b;
  font-weight: 700;
  font-size: 0.85rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.tab-btn.active {
  background: white;
  color: #0ea5e9;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

/* Form Styles */
.auth-box {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.input-field {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

.input-field label {
  font-size: 0.75rem;
  font-weight: 800;
  color: #1e293b;
  margin-left: 0.15rem;
}

.input-field input {
  padding: 0.75rem 1rem;
  border-radius: 12px;
  border: 1.5px solid #e2e8f0;
  background: #f8fafc;
  font-family: inherit;
  font-size: 0.9rem;
  transition: all 0.2s;
  color: #1e293b;
}

.input-field input:focus {
  outline: none;
  border-color: #0ea5e9;
  background: white;
  box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
}

.primary-gradient-btn {
  margin-top: 0.5rem;
  padding: 0.85rem;
  border-radius: 12px;
  border: none;
  color: white;
  font-weight: 800;
  font-size: 0.9rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #2563eb, #0ea5e9);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 6px 15px rgba(14, 165, 233, 0.2);
}

.primary-gradient-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 12px 25px rgba(14, 165, 233, 0.4);
}

.primary-gradient-btn:active:not(:disabled) {
  transform: translateY(0);
}

.primary-gradient-btn:disabled {
  cursor: not-allowed;
  opacity: 0.7;
}

@media (max-width: 480px) {
  .landing-wrapper {
    padding: 1.5rem 1rem;
  }
  .role-title {
    font-size: 1.1rem;
  }
}
</style>
