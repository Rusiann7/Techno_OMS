<template>
  <div class="admin-landing-wrapper">
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

        <button class="admin-gradient-btn" @click="this.$router.replace('/login')">
          Go to customer login
        </button>
      </div>
    </header>

    <!-- Main Content Selection -->
    <main class="content-container">
      <div class="admin-auth-card">
        <div class="card-header">
          <div class="role-icon admin-theme">
            <svg
              width="26"
              height="26"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
          </div>
          <h2 class="role-title admin-theme-text">ADMIN CATEGORY</h2>
          <p class="role-subtitle">DevSparks Management Portal</p>
        </div>

        <div class="card-content">
          <form @submit.prevent="logIn" class="auth-box">
            <div class="input-field">
              <label>Admin Email</label>
              <input
                type="email"
                v-model="login.email"
                placeholder="admin@devsparks.com"
                required
              />
            </div>

            <div class="input-field">
              <label>Admin Password</label>
              <input type="password" v-model="login.password" placeholder="********" required />
            </div>

            <button type="submit" class="admin-gradient-btn" :disabled="isLoading">
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
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                <polyline points="10 17 15 12 10 7" />
                <line x1="15" x2="3" y1="12" y2="12" />
              </svg>
              <span v-if="!isLoading">Login as Admin</span>
              <span v-else>Verifying...</span>
            </button>

            <!-- Restricted Access Notice -->
            <div class="restricted-notice">
              <div class="notice-box">
                <svg
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <strong>RESTRICTED ACCESS</strong>
                <p>
                  This portal is for authorized staff only. Manage orders, customers, and inventory.
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
//const url2 = "https://rusiann7.helioho.st";
const url2 = 'https://star-panda-literally.ngrok-free.app'
//const url2 = "http://localhost:8000";
//const url2 = "http://localhost";

export default {
  name: 'loginA',

  data() {
    return {
      login: { email: '', password: '' },
      isLoading: false,
      loginAPI: `${url2}/loginAPI-admin.php`,
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
            'ngrok-skip-browser-warning': 'true',
          },
          body: JSON.stringify({
            action: 'loginA',
            ...this.login,
          }),
        })

        const result = await response.json()

        if (result.success) {
          this.isLoading = false

          localStorage.setItem('user_id', result.user_id)
          localStorage.setItem('fullName', result.fullName)
          localStorage.setItem('is_admin', result.is_admin)

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
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.admin-landing-wrapper {
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

/* Header Sections */
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

/* Admin Card Container */
.content-container {
  width: 100%;
  max-width: 440px;
}

.admin-auth-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.4);
  display: flex;
  flex-direction: column;
  border-top: 6px solid #a855f7;
}

/* Card Styling */
.card-header {
  padding: 1.75rem 1.75rem 1.25rem;
  text-align: center;
  background: #fdf6ff;
  border-bottom: 1px solid rgba(168, 85, 247, 0.1);
}

.role-icon.admin-theme {
  background: linear-gradient(135deg, #a855f7, #db2777);
  color: white;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 0.75rem;
  box-shadow: 0 6px 15px rgba(168, 85, 247, 0.25);
}

.role-title.admin-theme-text {
  color: #a855f7;
  font-size: 1.35rem;
  font-weight: 800;
  margin: 0;
  letter-spacing: -0.01em;
}

.role-subtitle {
  color: #64748b;
  font-size: 0.85rem;
  margin: 0.25rem 0 0;
  font-weight: 500;
}

.card-content {
  padding: 1.75rem 2rem 2rem;
  background: white;
}

.auth-box {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.input-field {
  display: flex;
  flex-direction: column;
  gap: 0.45rem;
}

.input-field label {
  font-size: 0.75rem;
  font-weight: 800;
  color: #1e293b;
  margin-left: 0.15rem;
}

.input-field input {
  padding: 0.85rem 1rem;
  border-radius: 12px;
  border: 1.5px solid #e2e8f0;
  background: #f8fafc;
  font-family: inherit;
  font-size: 0.95rem;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  color: #1e293b;
}

.input-field input:focus {
  outline: none;
  border-color: #a855f7;
  background: white;
  box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
}

.admin-gradient-btn {
  margin-top: 0.25rem;
  padding: 0.9rem;
  border-radius: 12px;
  border: none;
  color: white;
  font-weight: 800;
  font-size: 0.95rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  background: linear-gradient(135deg, #a855f7 0%, #db2777 100%);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 8px 20px rgba(168, 85, 247, 0.3);
}

.admin-gradient-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 12px 25px rgba(168, 85, 247, 0.4);
}

.admin-gradient-btn:active:not(:disabled) {
  transform: translateY(0);
}

.admin-gradient-btn:disabled {
  cursor: not-allowed;
  opacity: 0.7;
}

/* Restricted Access Notice */
.restricted-notice {
  margin-top: 0.75rem;
}

.notice-box {
  background: #fff1f2;
  border: 1px solid #fecdd3;
  border-radius: 14px;
  padding: 1rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
}

.notice-box strong {
  color: #be185d;
  font-size: 0.7rem;
  letter-spacing: 0.05em;
}

.notice-box p {
  color: #64748b;
  font-size: 0.7rem;
  margin: 0;
  line-height: 1.4;
  font-weight: 500;
}

.notice-box svg {
  color: #f59e0b;
}

@media (max-width: 480px) {
  .admin-landing-wrapper {
    padding: 2.5rem 1.25rem;
  }
}
</style>
