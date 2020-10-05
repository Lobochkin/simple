<template>
    <tfoot>
    <tr>
        <td class="p-sm-3">
            <b-datepicker
                    placeholder="Выберите дату"
                    size="sm"
                    today-button
                    reset-button
                    close-button
                    v-model="addMeters.date"
                    :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                    :start-weekday="1"
                    autofocus>
            </b-datepicker>
<!--            <input class="form__input form__input-date" type="date" name="date" v-model="addMeters.date" autofocus>-->
        </td>
        <td class="p-sm-3">
            <input class="form__input form__input-electric" type="number" name="electric" v-model="addMeters.electric" maxlength="30" required>
        </td>
        <td class="p-sm-3">
            <input class="form__input form__input-hot_water" type="number" name="hot_water" v-model="addMeters.hot_water" maxl="10000000" required>
        </td>
        <td class="p-sm-3">
            <input class="form__input form__input-cold_water" type="number" name="cold_water" v-model="addMeters.cold_water" maxl="1000000" required>
        </td>
        <td class="p-sm-3">
            <span class="total">{{addMeters.total}}</span>
        </td>
        <td class="p-sm-3">
            <button @click="calculate">
                <i class="fa fa-calculator"></i>
            </button>
            <button class="form__button_add" name="button_add" type="submit" @click="setMeters"><i class="fa fa-cloud-upload"></i></button>
        </td>
    </tr>
    </tfoot>
</template>

<script>
    export default {
        name: 'tfootAddRow',
        props: ['meters', 'price'],
        data() {
            return {
                addMeters: {
                    action: 'add',
                    date: '',
                    electric: '',
                    hot_water: '',
                    cold_water: '',
                    total: ''
                }
            };
        },
        created() {
            this.addMeters.date = new Date();
        }
        ,
        watch: {
            meters: function() {
                this.addMeters = {
                    action: 'add',
                    date: '',
                    electric: '',
                    hot_water: '',
                    cold_water: '',
                    total: ''
                };
            },
        },
        methods: {
            setMeters() {
                if (!this.addMeters.total) {
                    this.calculate();
                }
                if (this.addMeters.total) {
                    let data = new FormData();
                    for (let key in this.addMeters) {
                        data.append(key, this.addMeters[key]);
                    }
                    this.$emit('add-row',data);
                }
            },
            getAmount(data, oldData) {
                let amount = Math.round((data.hot_water - oldData.hot_water) * this.price.warming + ((data.hot_water - oldData.hot_water) + (data.cold_water - oldData.cold_water)) * this.price.water +
                    (data.electric - oldData.electric) * this.price.electric) + 'руб.';
                return amount;
            },
            calculate() {
                for (let i in this.addMeters) {
                    if (i === 'total') continue;
                    if (!this.addMeters[i]) {
                        alert('Нужно заполнить все поля');
                        return false;
                    }
                }
                this.addMeters.total = this.getAmount(this.addMeters, this.meters[this.meters.length - 1]);
            }
        }
    };
</script>

<style >
 /*   .b-form-btn-label-control.form-control > .btn {
        padding: 0 6px 0 0;
    }
    .b-form-btn-label-control.form-control > label.form-control-sm {
        padding: 0;
    }*/
</style>