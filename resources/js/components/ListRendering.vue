<template>
    <div class="list-rendering">
        <ul>
            <li v-for="(food, index) in foods">
                {{ food.name }} - at index {{ index }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "ListRendering",
    data() {
        return {
            foods: [
                { name: 'Hamburger' },
                { name: 'Sandwich' },
                { name: 'Chicken chop' },
            ]
        }
    }
}
</script>

<style scoped>

</style>
