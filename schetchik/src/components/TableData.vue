<template>
    <div class="fresh-table row justify-content-center">
        <table id="fresh-table" class="table">
            <thead>
            <th class="p-sm-3" data-field="id">Дата:</th>
            <th class="p-sm-3" data-field="name">Элек.:</th>
            <th class="p-sm-3" data-field="salary">Гор. вода:</th>
            <th class="p-sm-3" data-field="country">Хол. вода:</th>
            <th class="p-sm-3" data-field="city">Сумма:</th>
            <th class="p-sm-3" data-field="actions">Actions</th>
            </thead>
            <TableBodyCount :meters="meters" :isAdmin="isAdmin" :price="price" @delete-date="deleteRow" @edit-meters="editRow"/>
            <tfootAddRow :meters="meters" :price="price" @add-row="addRow"/>
        </table>
    </div>
</template>

<script>

    import TableBodyCount from './TableBodyCount.vue';
    import tfootAddRow from './tfootAddRow.vue';

    export default {
        name: 'TableData',
        components: {
            TableBodyCount,
            tfootAddRow
        },
        props: ['isAdmin','price'],
        data(){
            return {
                meters: [{}],
                url: {
                    meters: 'http://lobochkin.ru/local/tools/ajax-vue.php'
                }
            }
        },
        created() {
            this.axios.post(this.url.meters).then((response) => {
                this.meters = response.data;
            })
            .catch(error => console.log(error));
        },
        methods: {
            addRow(obj){
                this.axios.post(this.url.meters, obj).then((response) => {
                    this.meters = response.data;
                });
            },
            deleteRow(id) {
                if (!this.isAdmin) {
                    alert('Удалять данные может только администратор!');
                    return false;
                }
                let data = new FormData();
                let action = 'delete_Admin';
                data.append('action', action);
                data.append('id', id);
                this.axios.post(this.url.meters, data).then((response) => {
                    this.meters = response.data;
                });
            },
            editRow(obj,index) {
                this.axios.post(this.url.meters, obj).then((response) => {
                    this.meters = response.data;
                    this.meters[index].isUpdate = 'true';
                    setTimeout(() => {
                        this.$delete(this.meters[index], 'isUpdate');
                    }, 3000,index);
                });
            }
        }

    };
</script>

<style scoped>

</style>