<template>
    <div className="form-input-binding">
        <div className="text">
            {{ message }}
        </div>
        <div className="input-form">
            <input v-model.number="message" >
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: '',
            placeholder: 'This is placeholder',
            value: 'This is value'
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
