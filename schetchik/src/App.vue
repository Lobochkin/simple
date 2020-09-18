<template>
    <div class="container">
        <Price :price="price"/>
        <TableData :isAdmin="isAdmin" :price="price"/>
    </div>
</template>

<script>

    import Price from './components/Price.vue';
    import TableData from './components/TableData.vue';

    export default {
        name: 'App',
        components: {
            Price,
            TableData
        },
        data() {
            return {
                price: {
                    water: 0,
                    warming: 0,
                    electric: 0
                },
                isAdmin: false,

                textSearch: '',
                url: {
                    price: 'http://lobochkin.ru/local/tools/ajax-vue.php?price=1',
                    isAdmin: 'http://lobochkin.ru/local/tools/ajax-vue.php?action=isAdmin'
                }
            };
        },
        created() {
            this.axios.get(this.url.price).then((response) => {
                this.price = response.data;
            }).catch(error => console.log(error));

            this.axios.get(this.url.isAdmin).then((response) => {
                this.isAdmin = response.data;
            }).catch(error => console.log(error));
        }
    };
</script>
<style scoped>
    /*.container {*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*}*/

</style>

<style>

    .table > tbody > tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.15);
    }

    .table > tbody > tr:hover {
        background-color: rgba(255, 255, 255, 0.25);
    }

    .fresh-table {
        background: radial-gradient(ellipse at center, #2D7CE7 0%, #36AFEC 100%);
        background-size: 250% 250%;
    }

    .table th,
    .table td {
        padding: 2px;
    }

    .table th {
        border: none;
    }

    .table-action.edit {
        color: orange;
    }

    .table-action.remove {
        color: red;
    }

    .table-action.calculator {
        color: darkgreen;
    }

    @media (min-width: 480px) {
        .fresh-table {
            border-radius: 20px;
        }
    }

    .form__input {
        display: inline-block;
        width: 100%;
        border: none;
        background-color: inherit;
    }

    button {
        background: inherit;
        border: none;
        cursor: pointer;
    }

    button:nth-child(2) {
        margin: 0 5px;
    }

    .table-action.remove {
        cursor: pointer;
    }

    .form__input-date,
    .form__input-electric,
    .form__input-hot_water,
    .form__input-cold_water,
    .total {
        background-color: aquamarine;
        border-radius: 4px;
        padding: 5px;
    }

    .total {
        width: 90%;
        display: inline-block;
        height: 35px;
    }

    .fa-cloud-upload {
        color: aliceblue;
    }

    table > tbody.table-count > tr.update {
        background-color: blueviolet;

    }

    table > tbody.table-count > tr.update td {
        position: relative;

    }

    table > tbody.table-count > tr.update span.update {
        display: flex;
        justify-content: center;
        align-content: center;
        color: blue;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: blueviolet;
    }

    table > tbody.table-count > tr.update span.update span {
        align-self: center;
    }

</style>
