<template>
    <div class="d-flex justify-content-center align-items-center pt-5">
        <div class="card login-block">
            <div class="card-header">
                <h4 class="card-title text-center">Login form</h4>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="email" class="mb-1">Email:</label>
                    <input id="email" type="email" class="form-control" v-model="email">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="mb-1">Password:</label>
                    <input id="password" type="password" class="form-control" v-model="password">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" @click="login">Log in</button>
            </div>
        </div>
    </div>
</template>

<script>
import AuthService from 'Services/AuthService.js';
import preloaderMixin from 'Mixins/preloaderMixin.js';

export default {
    name: 'Login',
    mixins: [preloaderMixin],
    data() {
        return {
            email: null,
            password: null,
            authService: null,
        }
    },
    methods: {
        login() {
            this.setLoading();
            this.authService.login(this.email, this.password)
            .then(response => {
                if (response.data.data.api_token) {
                    localStorage.setItem('api_token', response.data.data.api_token)
                    this.$store.dispatch('setCurrentUser', response.data.data)
                    this.setLoading();
                    this.$router.push({name: 'home'})
                }
            })
            .catch(error => {
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
    mounted() {
        
    }
}
</script>

<style scoped lang="scss">
    .login-block {
        width: 40%;
        min-width: 320px;
    }
</style>