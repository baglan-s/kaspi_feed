<template>
    <div class="container">
        <div class="row d-flex justify-content-center pt-4">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">New organization</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="orgName" class="mb-2">Name:</label>
                            <input type="text" id="orgName" v-model="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="orgDesc" class="mb-2">Description:</label>
                            <textarea id="orgDesc" class="form-control" v-model="description" rows="4"></textarea>
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
import OrganizationService from 'Services/OrganizationService.js';
import preloaderMixin from 'Mixins/preloaderMixin.js';

    export default {
        name: 'OrganizationCreate',
        mixins: [preloaderMixin],
        data() {
            return {
                name: null,
                description: null,
                organizationService: null
            }
        },
        methods: {
            save() {
                this.setLoading();

                this.organizationService.create(this.name, this.description).then(response => {
                    this.setLoading();
                    this.toIndex();
                    this.$toast.add({severity:'success', summary: 'Success Message', detail:'Entity created successfully', life: 3000});
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
        }
    }
</script>