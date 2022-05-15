<template>
    <div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 pt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Users</h4>
                            <Button label="New" icon="pi pi-plus" class="mr-2 btn-success" @click="toCreate" />
                        </div>
                        <div class="card-body">
                            <DataTable :value="users" :paginator="true" :rows="10"
                                paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                                :rowsPerPageOptions="[10,20,50]" responsiveLayout="scroll">
                                
                                <Column field="id" header="ID"></Column>
                                <Column field="name" header="Name"></Column>
                                <Column field="email" header="Email"></Column>
                                <Column field="created_at" header="Created At"></Column>
                                <Column field="updated_at" header="Updated At"></Column>
                                <Column header="Action">
                                    <template #body="props">
                                        <Button icon="pi pi-pencil" class="p-button-warning mar-r-5" @click="toEdit(props.data.id)" />
                                        <Button icon="pi pi-trash" class="p-button-danger mar-r-5" @click="destroy(props.data.id)" />
                                    </template>
                                </Column>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserService from 'Services/UserService.js'
    import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'Users',
        mixins: [preloaderMixin],
        data() {
            return {
                users: [],
                userService: null,
            }
        },
        methods: {
            toCreate() {
                this.$router.push('/users/create')
            },
            toEdit(id) {
                this.$router.push('/users/edit/' + id)
            },
            destroy(id) {
                this.setLoading();
                this.userService.delete(id).then(response => {
                    this.users = this.users.filter(user => {
                        return user.id != id
                    });

                    this.setLoading();
                    this.$toast.add({severity:'success', summary: 'Success Message', detail:'Entity deleted successfully', life: 3000});
                }).catch(error => {
                    console.log(error);
                    this.setLoading();
                    this.$toast.add({severity:'error', summary: 'Error Message', detail:'Error! Please try later', life: 3000});
                })
            },
        },
        created() {
            this.userService = new UserService();
        },
        mounted() {
            this.setLoading();

            this.userService.getAll().then(response => {
                this.users = response.data.data
                this.setLoading();
            }).catch(error => {
                console.log(error)
                this.setLoading();
            });
            
        }
    }
</script>