<template>
    <div class="event-handling">
        <input @keyup.enter="alertHello1">

        <input @keyup.13="alertHello2">
    </div>
</template>

<script>
export default {
    methods: {
        alertHello1() {
            alert('Hello1')
        },
        alertHello2() {
            alert('Hello2')
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
