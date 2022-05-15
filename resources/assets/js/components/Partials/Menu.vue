<template>
    <div>
        <Menubar :model="authorizedItems" class="d-flex justify-content-between">
            <template #start>
                <img alt="logo" src="https://www.primefaces.org/primevue/img/logo.d32bce0e.svg" height="40" class="mr-3">
            </template>
        </Menubar>

    </div>
</template>

<script>
    import AuthService from 'Services/AuthService.js';
    import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'Menu',
        mixins: [preloaderMixin],
        data() {
            return {
                authService: null,
                items: [
                    {
                        label:'Organizations',
                        icon:'pi pi-fw pi-building',
                        items:[
                            {
                                label:'All',
                                icon:'pi pi-fw pi-building',
                                to: '/organizations'
                            }
                        ],
                        isAuthorized: true,
                    },
                    {
                        label:'Users',
                        icon:'pi pi-fw pi-user',
                        items:[
                            {
                                label:'All',
                                icon:'pi pi-fw pi-users',
                                to: '/users'

                            },
                        ],
                        isAuthorized: true,
                    },
                    {
                        label:'Logout',
                        icon:'pi pi-fw pi-power-off',
                        // to: '/logout',
                        isAuthorized: true,
                        command: () => {
                            this.setLoading();
                            this.authService.logout().then(response => {
                                if (response.data.success) {
                                    localStorage.removeItem('api_token');
                                    this.$store.dispatch('deleteCurrentUser')
                                    this.setLoading();
                                    this.$router.push({name: 'login'})
                                }
                            }).catch(error => {
                                this.setLoading();
                                console.log(error)
                            });
                            
                        }
                    },
                    {
                        label: 'Login',
                        icon: 'pi pi-fw pi-sign-in',
                        to: '/login',
                        isAuthorized: false,
                    },
                    {
                        label: 'Register',
                        icon: 'pi pi-fw pi-user-plus',
                        to: '/register',
                        isAuthorized: false,
                    }
                ],
            }
        },
        computed: {
            authorizedItems() {
                return this.items.filter((item) => {
                    return item.isAuthorized === this.isAuthorized
                })
            },
            isAuthorized() {
                return this.$store.getters.getCurrentUser ? true : false;
            }
        },
        created() {
            this.authService = new AuthService();
        }
    }
</script>