<template>
    <tbody class="table-count">
        <tr v-for="(meter, index) in meters" :key="index" :class="[(typeof meter.isUpdate === 'undefined' )?'': meter.isUpdate == 'true'?'update':'']">
            <td class="p-sm-3">
<!--                <input class="form__input" type="date" name="date" data-id="" v-model="meter.date" required>-->
                <b-datepicker
                        name="date"
                        size="sm"
                        autocomplete="on"
                        today-button
                        reset-button
                        close-button
                        v-model="meter.date"
                        :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                        :start-weekday="1"
                        autofocus>
                </b-datepicker>
            </td>
            <td class="p-sm-3">
                <input class="form__input" type="number" name="electric" data-id="" v-model="meter.electric" maxlength="30" required>
            </td>
            <td class="p-sm-3">
                <input class="form__input" type="number" name="hot_water" data-id="" v-model="meter.hot_water" maxl="10000000" required>
            </td>
            <td class="p-sm-3">
                <input class="form__input" type="number" name="cold_water" data-id="" v-model="meter.cold_water" maxl="1000000" required>
            </td>
            <td class="p-sm-3">
                <input class="form__input" type="text" name="total" data-id="" v-model="meter.total" maxl="1000000" required>
            </td>
            <td class="p-sm-3">
                <button title="calculator" class="table-action calculator" name="button" :data-id="meter.id"
                        @click="calculate(index)">
                    <i class="fa fa-calculator"></i>
                </button>
                <button class="form__button table-action edit" title="Edit" name="button_edit" :data-id="meter.id"
                        @click="editMeters(index)" type="submit">
                    <i class="fa fa-edit"></i>
                </button>
                <span title="Remove" class="table-action remove" :data-id="meter.id" @click="deleteDate(meter.id)">
                                    <i class="fa fa-remove"></i>
                                </span>
                <span v-if="meter.isUpdate" class="update"><span>&#10004;</span></span>
            </td>
        </tr>
    </tbody>
</template>

<script>
    export default {
        name: 'TableBodyCount',
        props: ['meters','isAdmin','price'],
        data(){
            return {

            }
        },
        created: function() {

        },
        methods: {
            getAmount(data, oldData) {
                let amount = Math.round((data.hot_water - oldData.hot_water) * this.price.warming + ((data.hot_water - oldData.hot_water) + (data.cold_water - oldData.cold_water)) * this.price.water +
                    (data.electric - oldData.electric) * this.price.electric) + 'руб.';
                return amount;
            },
            calculate(index) {
                if (index === 0) {
                    return false;
                } else if (typeof index === 'number') {
                    this.checkIsEmptu(index);
                    this.meters[index].total = this.getAmount(this.meters[index], this.meters[index - 1]);
                }
            },
            deleteDate(id) {
                if (!this.isAdmin) {
                    alert('Удалять данные может только администратор!');
                    return false;
                }
                this.$emit('delete-date',id);
            },
            checkIsEmptu(index) {
                for (let i in this.meters[index]) {
                    if (i === 'total') continue;
                    if (!this.meters[index][i]) {
                        alert('Нужно заполнить все поля');
                        return false;
                    }
                }
            },
            editMeters(index) {
                if (!this.isAdmin) {
                    alert('Редактировать данные может только администратор!');
                    return false;
                }
                this.checkIsEmptu(index);
                let action = 'action-edit__admin';
                this.calculate(index);
                let data = new FormData();
                for (let key in this.meters[index]) {
                    data.append(key, this.meters[index][key]);
                }
                data.append('action', action);
                this.$emit('edit-meters',data,index);
            },

        }
    };

</script>

<style>
    .b-calendar-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .btn.border-0.rounded-circle.text-nowrap.btn-outline-light {
        font-size: 0.75rem;
    }
    label.form-control {
        display: flex;
        align-items: center;
        margin: 0;
        border: none;
        color: rgb(0, 0, 0)!important;
    }
    div.b-form-btn-label-control {
        background-color: inherit;
        border: none;
    }
    .b-calendar-grid-body>.row {
        flex-wrap: nowrap;
    }
    .b-calendar-grid-body .row .btn {
        padding: 5px;
    }

</style>