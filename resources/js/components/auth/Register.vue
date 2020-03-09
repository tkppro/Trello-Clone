<template>
<div class="login-form">
    <h2 class="login-heading">Register</h2>
    <form action="#" @submit.prevent="register">
        <div v-if="serverError" class="server-error">
            <div v-for="(error, index) in serverError" :key="index">
                <div v-for="(err, index) in error" :key="index">
                    {{ err }}
                </div>

            </div>
        </div>
        <div class="form-control">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="login-input" v-model="name">
        </div>

        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="login-input" v-model="email">
        </div>

        <div class="form-control mb-more">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="login-input" v-model="password">
        </div>

        <div class="form-control mb-more">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="login-input" v-model="password_confirmation">
        </div>

        <div class="form-control">
            <button type="submit" class="btn-submit" :disabled="loading">
                <div class="lds-ring-container" v-if="loading">
                <div class="lds-ring register">
                    <div></div><div></div><div></div><div></div></div></div>
                Create Account</button>
        </div>

    </form>
</div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            serverError: '',
            successMessage: '',
            loading: false,
        }
    },
    methods: {
        register() {
            this.loading = true
            this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then(response => {
                    this.loading = false
                    this.successMessage = 'Registered Successfully!'
                    this.$router.push({
                        name: 'login',
                        params: {
                            dataSuccessMessage: this.successMessage
                        }
                    })
                })
                .catch(error => {
                    this.loading = false
                    this.serverError = error.response.data.errors
                    this.password = ''
                })
        }
    }
}
</script>
