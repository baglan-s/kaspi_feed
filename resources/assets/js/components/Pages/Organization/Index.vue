<template>
    <div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 pt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Organizations</h4>
                            <Button label="New" @click="toCreate" icon="pi pi-plus" class="mr-2 p-button-success" />
                        </div>
                        <div class="card-body">
                            <DataTable :value="organizations" :paginator="true" :rows="10"
                                paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                                :rowsPerPageOptions="[10,20,50]" responsiveLayout="scroll">

                                <Column field="id" header="ID"></Column>
                                <Column field="name" header="Name"></Column>
                                <Column field="created_at" header="Created At"></Column>
                                <Column field="updated_at" header="Updated At"></Column>
                                <Column header="Action">
                                    <template #body="props">
                                        <Button icon="pi pi-eye" class="p-button-primary mar-r-5" @click="show(props.data)" />
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
        <Dialog :closable="false" :modal="isModal" header="Header" :visible="!isModalHidden" :style="{width: '50vw'}">
            <ul class="list-group" v-if="organization">
                <li class="list-group-item"><b>iD:</b> {{ organization.id }}</li>
                <li class="list-group-item"><b>Name:</b> {{ organization.name }}</li>
                <li class="list-group-item"><b>Description:</b> {{ organization.description }}</li>
                <li class="list-group-item"><b>Import link (POST):</b> {{ organization.import_link }}</li>
                <li class="list-group-item"><b>Export link (GET):</b> {{ organization.export_link }}</li>
            </ul>
            <template #footer>
                <Button label="Close" class="p-button-danger" @click="closeModal" />
            </template>
        </Dialog>
    </div>
</template>

<script>
    import OrganizationService from 'Services/OrganizationService.js';
    import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'Organizations',
        mixins: [preloaderMixin],
        data() {
            return {
                organizations: [],
                organizationService: null,
                isModal: true,
                isModalHidden: true,
                organization: null
            }
        },
        methods: {
            toCreate() {
                this.$router.push('/organizations/create')
            },
            toEdit(id) {
                this.$router.push('/organizations/edit/' + id)
            },
            show(data) {
                this.setLoading();
                
                this.organization = data
                this.setLoading();

                this.isModalHidden = false;
            },
            destroy(id) {
                this.setLoading();
                this.organizationService.delete(id).then(response => {
                    this.organizations = this.organizations.filter(organization => {
                        return organization.id != id
                    });

                    this.setLoading();
                    this.$toast.add({severity:'success', summary: 'Success Message', detail:'Entity deleted successfully', life: 3000});
                }).catch(error => {
                    console.log(error);
                    this.setLoading();
                    this.$toast.add({severity:'error', summary: 'Error Message', detail:'Error! Please try later', life: 3000});
                })
            },
            closeModal() {
                this.isModalHidden = true;
            }
        },
        created() {
            this.organizationService = new OrganizationService();
        },
        mounted() {
            this.setLoading();

            this.organizationService.getAll().then(response => {
                this.organizations = response.data.data
                this.setLoading();
            }).catch(error => {
                console.log(error)
                this.setLoading();
            });
            
        }
    }
</script>