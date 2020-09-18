<template>
    <div>
    <h2>Тариф</h2>
    <div class="price_water">Расход воды: <b>{{price.water}}</b></div>
    <div class="price_warming">Нагрев воды: <b>{{price.warming}}</b></div>
    <div class="price_electric">Электричество: <b>{{price.electric}}</b></div>
    </div>
</template>

<script>
    export default {
        name: 'Price',
        props: ['price']

    };
</script>

<style scoped>

</style>