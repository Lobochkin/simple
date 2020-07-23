<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php

Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/css/style.css\" type=\"text/css\" rel=\"stylesheet\">");
?>

<div class="container" id="app">
    <p>
    <h2>Тариф</h2>
    <div class="price_water">Расход воды: <b>{{price.water}}</b></div>
    <div class="price_warming">Нагрев воды: <b>{{price.warming}}</b></div>
    <div class="price_electric">Электричество: <b>{{price.electric}}</b></div>
    </p>
    <div class="fresh-table row justify-content-center">
        <!-- Изменение фона таблицы: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
        Изменение фона тулбара страницы: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
        -->
        <table id="fresh-table" class="table">
            <thead>
            <th class="p-sm-3" data-field="id">Дата:</th>
            <th class="p-sm-3" data-field="name">Элек.:</th>
            <th class="p-sm-3" data-field="salary">Гор. вода:</th>
            <th class="p-sm-3" data-field="country">Хол. вода:</th>
            <th class="p-sm-3" data-field="city">Сумма:</th>
            <th class="p-sm-3" data-field="actions">Actions</th>
            </thead>
            <tbody class="table-count">
            <tr v-for="(meter, index) in meters" :class="[(typeof meter.isUpdate === 'undefined' )?'': meter.isUpdate == 'true'?'update':'']">
                <td class="p-sm-3">
                    <input class="form__input" type="date" name="date" data-id="" v-model="meter.date" required>
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
                    <span v-if="meter.isUpdate" class="update"><span>&#10004;<span></span>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td class="p-sm-3">
                    <input class="form__input form__input-date" type="date" name="date" v-model="addMeters.date" autofocus>
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
        </table>
    </div>
</div>

<script type="text/javascript">
    var app = new Vue({
        el: '#app',
        data: {
            price: {
                water: 0,
                warming: 0,
                electric: 0
            },
            meters: [
                {}],
            addMeters: {
                action: 'add',
                date: '',
                electric: '',
                hot_water: '',
                cold_water: '',
                total: ''
            },
            textSearch: '',
            url: {
                price: '/local/tools/ajax-vue.php?price=1',
                meters: '/local/tools/ajax-vue.php'
            }
        },

        created: function() {
            axios.get(this.url.price).then((response) => {
                this.price = response.data;
            });

            axios.post(this.url.meters).then((response) => {
                this.meters = response.data;
            });
        },
        methods: {
            getAmount(data, oldData) {
                let amount = Math.round((data.hot_water - oldData.hot_water) * this.price.warming + ((data.hot_water - oldData.hot_water) + (data.cold_water - oldData.cold_water)) * this.price.water +
                    (data.electric - oldData.electric) * this.price.electric) + 'руб.';
                return amount;
            },
            calculate(index) {
                console.log(typeof index);
                if (index === 0) {
                    return false;
                } else if (typeof index === 'object' || index === 'newDate') {
                    for (let i in this.addMeters) {
                        if (i === 'total') continue;
                        if (!this.addMeters[i]) {
                            alert('Нужно заполнить все поля');
                            return false;
                        }

                    }
                    this.addMeters.total = this.getAmount(this.addMeters, this.meters[this.meters.length - 1]);

                } else if (typeof index === 'number') {
                    for (let i in this.meters[index]) {
                        if (i === 'total') continue;
                        if (!this.meters[index][i]) {
                            alert('Нужно заполнить все поля');
                            return false;
                        }

                    }
                    this.meters[index].total = this.getAmount(this.meters[index], this.meters[index - 1]);
                }
            },
            deleteDate(id) {
                let data = new FormData();
                let action = '';
                <?php
                if ($USER->IsAdmin()):?>
                action = 'delete_Admin';
                <?php endif;?>
                if (action === '') {
                    alert('Удалять данные может только администратор!');
                    return false;
                }
                data.append('action', action);
                data.append('id', id);
                axios.post(this.url.meters, data).then((response) => {
                    this.meters = response.data;
                });
            },
            setMeters() {
                if (!this.addMeters.total) {
                    this.calculate('newDate');
                }
                let data = new FormData();
                for (let key in this.addMeters) {
                    data.append(key, this.addMeters[key]);
                }
                axios.post(this.url.meters, data).then((response) => {
                    console.log(response.data);
                    this.meters = response.data;
                    this.addMeters = {
                        action: 'add',
                        date: '',
                        electric: '',
                        hot_water: '',
                        cold_water: '',
                        total: ''
                    };
                });
            },
            editMeters(index) {
                let action = '';
                <?php
                if ($USER->IsAdmin()):?>
                action = 'action-edit__admin';
                <?php endif;?>
                if (action === '') {
                    alert('Редактировать данные может только администратор!');
                    return false;
                }
                if (!this.meters[index].total) {
                    this.calculate(index);
                }
                let data = new FormData();
                for (let key in this.meters[index]) {
                    data.append(key, this.meters[index][key]);
                }
                data.append('action', action);
                axios.post(this.url.meters, data).then((response) => {
                    console.log(response.data);
                    this.meters = response.data;
                    this.meters[index].isUpdate = 'true';
                    console.log(index);
                    setTimeout(() => {
                        console.log(index);
                        this.$delete(this.meters[index], 'isUpdate');
                    }, 3000,index);
                });
            },

        }
    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
