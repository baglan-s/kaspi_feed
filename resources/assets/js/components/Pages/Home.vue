<template>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-7 pt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Welcome!</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>User ID:</b> {{ getCurrentUser ? getCurrentUser.id : '' }}</li>
                            <li class="list-group-item"><b>User name:</b> {{ getCurrentUser ? getCurrentUser.name : '' }}</li>
                            <li class="list-group-item"><b>User email:</b> {{ getCurrentUser ? getCurrentUser.email : '' }}</li>
                            <li class="list-group-item"><b>API TOKEN:</b> {{ getCurrentUser ? getCurrentUser.api_token : '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            
        }
    },
    computed: {
        getCurrentUser() {
            return this.$store.getters.getCurrentUser;
        }
    }
}
</script>