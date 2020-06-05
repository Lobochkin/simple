<main class="main-inner">
      <h1 class="visually-hidden">Поиск жилья по категориям</h1>
      <section class="filters-search">
        <h2 class="visually-hidden">Сортировка отелей</h2>
        <form class="filter" method="get" action="https://echo.htmlacademy.ru/">
          <fieldset class="filter-group">
            <legend class="filter-group-title">
              Инфраструктура:
            </legend>
            <ul>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="Бассейн" id="pool" checked>
                <label class="filter-label" for="pool">Бассейн</label>
              </li>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="Парковка" id="parking">
                <label class="filter-label" for="parking">Парковка</label>
              </li>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="wi-fi" id="wi-fi">
                <label class="filter-label" for="wi-fi">WI-FI</label>
              </li>
            </ul>
          </fieldset>
          <fieldset class="filter-group">
            <legend class="filter-group-title">
              Тип жилья:
            </legend>
            <ul>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="Hotel" id="hotel" checked>
                <label class="filter-label" for="hotel">Гостиница</label>
              </li>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="Motel" id="motel" checked>
                <label class="filter-label" for="motel">Мотель</label>
              </li>
              <li class="filter-option">
                <input class="filter-field visually-hidden" type="checkbox" name="apartments" id="apartments" checked>
                <label class="filter-label" for="apartments">Апартаменты</label>
              </li>
            </ul>
          </fieldset>
          <div class="filter-price">
            <div class="filter-price-title">Стоимость в сутки (Р):</div>
            <div class="diapason">
              <label class="diapason-min-price">от <input type="text" name="min-price"     value="0"></label>
              <label class="diapason-max-price">до <input type="text" name="max-price" value="3000"></label>
            </div>
            <div class="range-controls">
              <div class="scale">
                <div class="bar"></div>
              </div>
              <div class="range-toggle range-toggle-min"></div>
              <div class="range-toggle range-toggle-max"></div>
            </div>
            <button class="filter-button" type="submit">Показать</button>
          </div>
        </form>
        <div class="sort">
          <div class="sort-title">Найдено: 3</div>
          <div class="sort-caption">Сортировка:</div>
          <ul class="sort-list">
            <li class="active"><a href="#">По цене</a></li>
            <li class="sort-list-item sort-list-item-type"><a href="#">По типу</a></li>
            <li class="sort-list-item sort-list-item-rank"><a href="#">По рейтингу</a></li>
          </ul>
          <div class="arrows">
            <a class="arrow arrow-up" href="#"><span class="visually-hidden">По возрастанию</span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"><path d="M5.5 0L0 10h11z"/></svg></a>
            <a class="arrow arrow-down" href="#"><span class="visually-hidden">По убыванию</span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10"><path d="M5.5 10L0 0h11"/></svg></a>
          </div>
        </div>
      </section>
      <section class="hotels">
        <h2 class="visually-hidden">Список отелей</h2>
        <ul class="hotels-list">

          <li class="hotels-item">
            <a class="hotel-item-image"><img src="img/amara.jpg" width="135" height="90" alt="Amara resort&amp; spa"></a>
            <div class="hotel-item-info">
              <h3 class="hotel-item-title"><a href="#">Amara resort &amp; spa</a></h3>
              <p class="hotel-item-text">Гостиница</p>
              <p class="hotel-item-text"> от 4000 Р.</p>
              <a class="hotel-item-btn" href="#">Подробнее</a>
              <a class="hotel-item-btn-dark" href="#">Забронировать</a>
            </div>
            <div class="hotel-rank">
              <div class="rank-mark star4"><span class="visually-hidden">4 звезды</span>
              </div>
              <div class="rank-grade">Рейтинг: 8,5</div>
            </div>
          </li>

          <li class="hotels-item">
            <a class="hotel-item-image"><img src="img/desert.jpg" width="135" height="90" alt="Desert quail inn"></a>
            <div class="hotel-item-info">
              <h3 class="hotel-item-title"><a href="#">Desert quail inn</a></h3>
              <p class="hotel-item-text">Мотель</p>
              <p class="hotel-item-text"> от 3000 Р.</p>
              <a class="hotel-item-btn" href="#">Подробнее</a>
              <a class="hotel-item-btn-dark" href="#">Забронировать</a>
            </div>
            <div class="hotel-rank">
              <div class="rank-mark star3"><span class="visually-hidden">3 звезды</span>
              </div>
              <div class="rank-grade">Рейтинг: 8,9</div>
            </div>
          </li>

          <li class="hotels-item">
            <a class="hotel-item-image"><img src="img/villas.jpg" width="135" height="90" alt="Villas at poco diablo"></a>
            <div class="hotel-item-info">
              <h3 class="hotel-item-title"><a href="#">Villas at poco diablo</a></h3>
              <p class="hotel-item-text">Апартаменты</p>
              <p class="hotel-item-text"> от 2000 Р.</p>
              <a class="hotel-item-btn" href="#">Подробнее</a>
              <a class="hotel-item-btn-dark" href="#">Забронировать</a>
            </div>
            <div class="hotel-rank">
              <div class="rank-mark star2"><span class="visually-hidden">2 звезды</span>
              </div>
              <div class="rank-grade">
                Рейтинг: 9,2
              </div>
            </div>
          </li>

        </ul>
      </section>
    </main>
    <footer class="inner-footer">