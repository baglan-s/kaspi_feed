<template>
    <div class="container">
        <div class="row d-flex justify-content-center pt-4">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit {{ user.name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="usrName" class="mb-2">Name:</label>
                            <input type="text" id="usrName" v-model="user.name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="usrEmail" class="mb-2">Email:</label>
                            <input type="email" id="usrEmail" class="form-control" v-model="user.email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="usrPassword" class="mb-2">Password:</label>
                            <input type="password" id="usrPassword" class="form-control" v-model="user.password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="usrPasswordConfirm" class="mb-2">Password confirmation:</label>
                            <input type="password" id="usrPasswordConfirm" class="form-control" v-model="user.password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success mar-r-5" @click="save">Save</button>
                    <button class="btn btn-danger mar-r-5" @click="toIndex">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserService from 'Services/UserService.js';
import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'UserEdit',
        mixins: [preloaderMixin],
        data() {
            return {
                user: {},
                userService: null,
                user_id: null,
            }
        },
        methods: {
            save() {
                if (!this.validate()) {
                    return false;
                }

                this.setLoading();

                this.userService.update(this.user).then(response => {
                    this.setLoading();
                    this.toIndex();
                    this.$toast.add({severity:'success', summary: 'Success Message', detail:'Entity updated successfully', life: 3000});
                }).catch(error => {
                    this.setLoading();
                    console.log(error)
                    this.$toast.add({severity:'error', summary: 'Error Message', detail:'Error! Please check the data.', life: 3000});
                })
                
            },
            toIndex() {
                this.$router.push('/users')
            },
            validate() {
                if (this.user.password != this.user.password_confirmation) {
                    this.$toast.add({severity:'error', summary: 'Error Message', detail:'Error! Passwords don\'t match!', life: 3000});
                    return false;
                }

                return true;
            }
        },
        created() {
            this.userService = new UserService();
            this.user_id = this.$route.params.id;
        },
        mounted() {
            this.setLoading();
            this.userService.get(this.user_id).then(response => {
                this.user = response.data.data;
                this.setLoading();
            }).catch(error => {
                console.log(error);
                this.setLoading();
            })
        }
    }
</script>