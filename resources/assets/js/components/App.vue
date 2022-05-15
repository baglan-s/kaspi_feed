<template>
    <div class="main">
        <div class="menu">
            <Menu />
        </div>
        <div class="wrapper">
            <router-view></router-view>
        </div>
        <Toast />

        <Preloader />
    </div>
</template>

<script>
    import Menu from 'Components/Partials/Menu.vue'
    import Preloader from 'Components/Partials/Preloader.vue'
    import AuthService from 'Services/AuthService.js';
    import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: "App",
        components: {Menu, Preloader},
        mixins: [preloaderMixin],
        data() {
            return {
                authService: null
            }
        },
        created() {
            this.authService = new AuthService();

            if (!this.isAuthorized && localStorage.getItem('api_token')) {
                this.setLoading();
                this.authService.authenticated()
                    .then(response => {
                        this.$store.dispatch('setCurrentUser', response.data.data)
                        this.setLoading();
                    })
                    .catch(error => {
                        console.log(error.response)
                        this.setLoading();
                    })
            }
        },
        computed: {
            isAuthorized() {
                return this.$store.getters.getCurrentUser ? true : false;
            }
        }
    }
</script>

<style scoped>
    .main {
        position: relative;
    }
</style>