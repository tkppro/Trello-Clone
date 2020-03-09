<template>
<div class="login-form">
    <v-snackbar v-model="snackbar" :timeout="4000" top color="success">
        <span>{{ successMessage }}</span>
        <v-btn text color="white" @click="snackbar = false">Close</v-btn>
    </v-snackbar>

    <h2 class="login-heading">Login</h2>
    <form action="#" @submit.prevent="login">
        <!-- <div v-if="successMessage" class="success-message">{{ successMessage }}</div> -->
        <div v-if="serverError" class="server-error">
            <div v-for="(error, index) in serverError" :key="index">
                {{ error[0] }}
            </div>
        </div>
        <div v-if="invalidCredential" class="server-error">{{ invalidCredential }}</div>
        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="login-input" v-model="email">

        </div>

        <div class="form-control mb-more">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="login-input" v-model="password">
        </div>

        <div class="form-control">
            <button type="submit" class="btn-submit" :disabled="loading">
                <div class="lds-ring-container" v-if="loading">
                <div class="lds-ring login">
                    <div></div><div></div><div></div><div></div></div></div>
                Login</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    name: 'login',
    props: {
        dataSuccessMessage: {
            type: String,
        }
    },
    data() {
        return {
            email: '',
            password: '',
            serverError: '',
            invalidCredential: '',
            successMessage: this.dataSuccessMessage,
            snackbar: this.dataSuccessMessage ? true : false,
            loading: false,
        }
    },
    methods: {
        login() {
            this.loading = true
            this.$store.dispatch('retrieveToken', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    this.loading = false
                    this.$router.push({
                        name: 'dashboard'
                    })
                })
                .catch(error => {
                    this.loading = false
                    this.invalidCredential = error.response.data.error
                    if(this.invalidCredential) 
                        this.serverError = ''          
                    if(error.response.data.errors)
                        this.serverError = Object.values(error.response.data.errors)
                    this.password = ''
                    this.successMessage = ''
                })
        }
    }
}
</script>

<style>

</style>
