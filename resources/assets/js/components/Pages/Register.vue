<template>
    <div class="d-flex justify-content-center align-items-center pt-5">
        <div class="card login-block">
            <div class="card-header">
                <h4 class="card-title text-center">Registration form</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name" class="mb-1">Name:</label>
                    <input id="name" type="text" class="form-control" v-model="name">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="mb-1">Email:</label>
                    <input id="email" type="email" class="form-control" v-model="email">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="mb-1">Password:</label>
                    <input id="password" type="password" class="form-control" v-model="password">
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirm" class="mb-1">Confirm password:</label>
                    <input id="password_confirm" type="password" class="form-control" v-model="password_confirmation">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" @click="register">Register</button>
            </div>
        </div>
    </div>
</template>

<script>
import AuthService from 'Services/AuthService.js';
import preloaderMixin from 'Mixins/preloaderMixin.js';

export default {
    name: 'Register',
    mixins: [preloaderMixin],
    data() {
        return {
            email: null,
            name: null,
            password: null,
            password_confirmation: null,
            authService: null,
        }
    },
    methods: {
        register() {
            this.setLoading();
            this.authService.register({
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
            .then(response => {
                
                if (response.data.data.api_token) {
                    localStorage.setItem('api_token', response.data.data.api_token)
                    this.$store.dispatch('setCurrentUser', response.data.data)
                    this.setLoading();
                    this.$router.push({name: 'home'})
                }
            })
            .catch(error => {
                console.log(error)
                this.setLoading();
                if (error.response.data.message) {
                    console.log(error.response.data.message)
                }
            });
        }
    },
    created() {
        this.authService = new AuthService()
    },
}
</script>

<style scoped lang="scss">
    .login-block {
        width: 40%;
        min-width: 320px;
    }
</style>