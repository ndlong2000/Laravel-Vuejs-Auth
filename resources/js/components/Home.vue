<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Home</div>

                <div class="card-body">
                    I'm the Home Component component.
                </div>

                <div class="form-group form-button">
                    <button @click="logout" class="form-submit">Log Out</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    methods: {
        async logout() {
            try {
                await axios.post('api/logout')
                    .then(response => {
                        this.$router.push('login')
                    })
            } catch (error) {
                this.error = error.response.data
                console.log(this.error)
            }
        }
    }
}
</script>

<style scoped>

</style>
