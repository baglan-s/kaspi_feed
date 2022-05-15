<template>
    <div class="container">
        <div class="row d-flex justify-content-center pt-4">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit {{ organization.name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="orgName" class="mb-2">Name:</label>
                            <input type="text" id="orgName" v-model="organization.name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="orgDesc" class="mb-2">Description:</label>
                            <textarea id="orgDesc" class="form-control" v-model="organization.description" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <Button label="Save" class="p-button-success mar-r-5" @click="save" />
                    <Button label="Cancel" class="p-button-danger mar-r-5" @click="toIndex" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import OrganizationService from 'Services/OrganizationService.js';
import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'OrganizationEdit',
        mixins: [preloaderMixin],
        data() {
            return {
                organization_id: null,
                organization: {},
                organizationService: null
            }
        },
        methods: {
            save() {
                this.setLoading();
                this.organizationService.update(this.organization).then(response => {
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
                this.$router.push('/organizations')
            }
        },
        created() {
            this.organizationService = new OrganizationService();
            this.organization_id = this.$route.params.id;
        },
        mounted() {
            this.setLoading();
            this.organizationService.get(this.organization_id).then(response => {
                this.organization = response.data.data;
                this.setLoading();
            }).catch(error => {
                console.log(error);
                this.setLoading();
            })
        }
    }
</script>