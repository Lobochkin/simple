// прайс
var price_water = +document.querySelector('.price_water b').innerText;
var price_warming = +document.querySelector('.price_warming b').innerText;
var price_electric = +document.querySelector('.price_electric b').innerText;
var admin = document.querySelector('.is-admin')? document.querySelector('.is-admin').innerHTML:'';

function calculate() {
    event.preventDefault();
    //последние данные
    let input_electric_old = +document.querySelector('.form__input-electric-old input').value;
    let input_hot_water_old = +document.querySelector('.form__input-hot_water-old input').value;
    let input_cold_water_old = +document.querySelector('.form__input-cold_water-old input').value;
    //  введенные данные
    let form__input_electric = document.querySelector('.form__input-electric');
    let form__input_hot_water = document.querySelector('.form__input-hot_water');
    let form__input_cold_water = document.querySelector('.form__input-cold_water');
    let total = document.querySelector('.total');
    let totals = ((+form__input_hot_water.value) - input_hot_water_old + (+form__input_cold_water.value) - input_cold_water_old) * price_water +
        ((+form__input_hot_water.value) - input_hot_water_old) * price_warming +
        ((+form__input_electric.value) - input_electric_old) * price_electric;
    if (totals < 1) {
        alert('Заполните все поля');
        return false;
    } else if (totals > 2500) {
        alert('Слишком большая цена (' + totals + ' руб.)');
        return false;
    }
    total.innerText = Math.round(totals);
    total.innerText += 'руб.';
}

document.querySelector('.form__button_add').onclick = function() {
    event.preventDefault();

    let total = document.querySelector('.total');

    if (total.innerText.length < 1) {
        alert('Перед отправкой необходимо рассчитать!');
        return false;
    }
    let Data = new Date();
    let fullDate = String(Data.getDate()) + '.' + String(Data.getMonth() + 1) + '.' + String(Data.getFullYear());
    if (document.querySelector('.form__input-date').value.length < 1) {
        alert('Необходимо заполнить дату, сегодня ' + fullDate);
        return false;
    }
    var formData = new FormData();
    formData.append(0, 'action-add');
    formData.append(1, document.querySelector('.form__input-date').value);
    formData.append(2, document.querySelector('.form__input-electric').value);
    formData.append(3, document.querySelector('.form__input-hot_water').value);
    formData.append(4, document.querySelector('.form__input-cold_water').value);
    formData.append(5, total.innerText);

    axios.post('/local/tools/ajax.php', formData).then(function(res) {
        document.querySelector('.table-count').innerHTML = res.data;
        document.querySelector('.form__input-date').value = '';
        document.querySelector('.form__input-electric').value = '';
        document.querySelector('.form__input-hot_water').value = '';
        document.querySelector('.form__input-cold_water').value = '';
        total.innerText = '0руб.';
    }).catch(function(err) {
        console.log(err.message);
    });
};

function calculate_edit(id, idOld) {
    let dataElectric = document.querySelector('[name="electric"][data-id="' + id + '"]').value;
    let dataHotWater = document.querySelector('[name="hot_water"][data-id="' + id + '"]').value;
    let dataColdWater = document.querySelector('[name="cold_water"][data-id="' + id + '"]').value;
    let dataElectricOld = document.querySelector('[name="electric"][data-id="' + idOld + '"]').value;
    let dataHotWaterOld = document.querySelector('[name="hot_water"][data-id="' + idOld + '"]').value;
    let dataColdWaterOld = document.querySelector('[name="cold_water"][data-id="' + idOld + '"]').value;
    let totals = ((dataHotWater - dataHotWaterOld) + (dataColdWater - dataColdWaterOld)) * price_water + (dataHotWater - dataHotWaterOld) * price_warming +
        (dataElectric - dataElectricOld) * price_electric;
    let total = document.querySelector('[name="total"][data-id="' + id + '"]');

    if (totals < 1) {
        alert('Заполните все поля');
        return false;
    } else if (totals > 2500) {
        alert('Слишком большая цена (' + totals + ' руб.)');
        return false;
    }
    total.value = Math.round(totals);
    total.value += 'руб.';
}

function add_date(id) {
    if (admin == '') {
        alert('Только администратор имеет право на редактирование!');
        return false;
    }
    $('[name="button"][data-id="' + id + '"]').trigger('click');
    let dataDate = document.querySelector('[name="date"][data-id="' + id + '"]').value;
    let dataElectric = document.querySelector('[name="electric"][data-id="' + id + '"]').value;
    let dataHotWater = document.querySelector('[name="hot_water"][data-id="' + id + '"]').value;
    let dataColdWater = document.querySelector('[name="cold_water"][data-id="' + id + '"]').value;
    let total = document.querySelector('[name="total"][data-id="' + id + '"]').value;

    if (dataDate.length < 1) {
        alert('Необходимо заполнить дату!');
        return false;
    }
    var formData = new FormData();
    formData.append(0, 'action-edit' + admin);
    formData.append(1, dataDate);
    formData.append(2, dataElectric);
    formData.append(3, dataHotWater);
    formData.append(4, dataColdWater);
    formData.append(5, total);
    formData.append(6, id);
    axios.post('/local/tools/ajax.php', formData).then(function(res) {
        document.querySelector('.table-count').innerHTML = res.data;
        document.querySelector('[name="button_edit"][data-id="' + id + '"]').innerHTML = '<i class="fa fa-edit" style="color: blue;">&#10004;</i>';
        let color = $('tr [data-id="' + id + '"]').closest('tr').css("background-color");
        $('tr [data-id="' + id + '"]').closest('tr').css("background-color","blueviolet");
        setTimeout(function() {
            $('tr [data-id="' + id + '"]').closest('tr').css("background-color",color);
            document.querySelector('[name="button_edit"][data-id="' + id + '"]').innerHTML = '<i class="fa fa-edit"></i>';
        }, 3000);
    }).catch(function(err) {
        console.log(err.message);
    });
}

function dataDelete(id) {
    if (admin == '') {
        alert('Только администратор имеет право на удаление!');
        return false;
    }
    if (confirm('Вы уверены что хотите удалить показания за день?')) {
        var formData = new FormData();
        formData.append(0, 'action-delete' + admin);
        formData.append(1, id);
        axios.post('/local/tools/ajax.php', formData).then(function(res) {
            document.querySelector('.table-count').innerHTML = res.data;

        }).catch(function(err) {
            console.log(err.message);
        });
    }

}
