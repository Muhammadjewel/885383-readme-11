<section class="page__main page__main--popular">
    <div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <li class="sorting__item sorting__item--popular">
                        <a class="sorting__link sorting__link--active" href="#">
                            <span>Популярность</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Лайки</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Дата</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <a class="filters__button filters__button--ellipse filters__button--all <?=$contentTypeQuery == null ? 'filters__button--active' : ''; ?>"
                           href="#">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php foreach($contentTypes as $contentType): ?>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--<?=$contentType['class'];?> button <?=$contentTypeQuery == $contentType['id'] ? 'filters__button--active' : ''; ?>" href="/?content_type=<?=$contentType['id'];?>">
                            <span class="visually-hidden"><?=$contentType['type_name'];?></span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-<?=$contentType['class'];?>"></use>
                            </svg>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <article class="popular__post post post-quote">
                <header class="post__header">
                    <h2><a href="#">Цитата дня</a></h2>
                </header>
                <div class="post__main">
                    <blockquote>
                        <p>
                            Тысячи людей живут без любви, но никто — без воды.
                        </p>
                        <cite>Xью Оден</cite>
                    </blockquote>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <article class="popular__post post ">
                <header class="post__header">
                    <h2><a href="#">Полезный пост про Байкал</a></h2>
                </header>
                <div class="post__main">
                    <div class="post-video__block">
                        <div class="post-video__preview">
                            <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                        </div>
                        <a href="post-details.html" class="post-video__play-big button">
                            <svg class="post-video__play-big-icon" width="14" height="14">
                                <use xlink:href="#icon-video-play-big"></use>
                            </svg>
                            <span class="visually-hidden">Запустить проигрыватель</span>
                        </a>
                    </div>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <article class="popular__post post post-text">
                <header class="post__header">
                    <h2><a href="#">Полезный пост про Байкал</a></h2>
                </header>
                <div class="post__main">
                    <p>
                        Озеро Байкал – огромное древнее озеро в горах Сибири к северу от монгольской границы. Байкал
                        считается самым глубоким озером в мире. Он окружен сетью пешеходных маршрутов, называемых
                        Большой байкальской тропой. Деревня Листвянка, расположенная на западном берегу озера, –
                        популярная отправная точка для летних экскурсий. Зимой здесь можно кататься на коньках и
                        собачьих упряжках.
                    </p>
                    <div class="post-text__more-link-wrapper">
                        <a class="post-text__more-link" href="#">Читать далее</a>
                    </div>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <article class="popular__post post post-link">
                <header class="post__header">
                    <h2><a href="#">Делюсь с вами ссылочкой</a></h2>
                </header>
                <div class="post__main">
                    <div class="post-link__wrapper">
                        <a class="post-link__external" href="http://www.vitadental.ru" title="Перейти по ссылке">
                            <div class="post-link__info-wrapper">
                                <div class="post-link__icon-wrapper">
                                    <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                </div>
                                <div class="post-link__info">
                                    <h3>Стоматология «Вита»</h3>
                                </div>
                            </div>
                            <span>www.vitadental.ru</span>
                        </a>
                    </div>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <article class="popular__post post post-photo">
                <header class="post__header">
                    <h2><a href="#">Наконец, обработал фотки!</a></h2>
                </header>
                <div class="post__main">
                    <div class="post-photo__image-wrapper">
                        <img src="img/rock-medium.jpg" alt="Фото от пользователя" width="360" height="240">
                    </div>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <article class="popular__post post post-quote">
                <header class="post__header">
                    <h2><a href="#">Цитата дня</a></h2>
                </header>
                <div class="post__main">
                    <blockquote>
                        <p>
                            Тысячи людей живут без любви, но никто — без воды.
                        </p>
                        <cite>Xью Оден</cite>
                    </blockquote>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/userpic-larisa-small.jpg"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">Лариса Роговая</b>
                                <time class="post__time" datetime="2019-03-30">Месяц назад</time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>250</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>25</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        </div>
        <div class="popular__page-links">
            <a class="popular__page-link popular__page-link--prev button button--gray" href="#">Предыдущая страница</a>
            <a class="popular__page-link popular__page-link--next button button--gray" href="#">Следующая страница</a>
        </div>
    </div>
</section>