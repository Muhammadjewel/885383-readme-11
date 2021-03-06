<?php

function dbFetchData ($link, $sql, $data = []) {
    $result = [];
    $statement = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($statement);
    $resource = mysqli_stmt_get_result($statement);

    if ($resource) {
        $result = mysqli_fetch_all($resource, MYSQLI_ASSOC);
    }

    return $result;
}

function dbInsertData($link, $sql, $data = []) {
    $statement = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        $result = mysqli_insert_id($link);
    }

    return $result;
}

$connection = mysqli_init();
mysqli_options($connection, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
mysqli_real_connect($connection, 'localhost', 'root', '', 'readme');
mysqli_set_charset($connection, 'utf8');

if (!$connection) {
    print("Ошибка подключения: " . mysqli_connect_error());
} else {
    $selectContentTypesQuery = 'SELECT * FROM content_types';
    $selectPostsQuery = 'SELECT posts.*, users.login, users.avatar, content_types.class FROM posts JOIN users ON posts.user_id = users.id JOIN content_types ON posts.content_type_id = content_types.id ORDER BY views DESC';

    $contentTypes = dbFetchData($connection, $selectContentTypesQuery);
    $posts = dbFetchData($connection, $selectPostsQuery);
}

?>

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
                    <a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
                        <span>Все</span>
                    </a>
                </li>
                <?php foreach($contentTypes as $contentType): ?>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--<?=$contentType['class']; ?> button" href="#">
                        <span class="visually-hidden"><?=$contentType['type_name']; ?></span>
                        <svg class="filters__icon" width="22" height="18">
                            <use xlink:href="#icon-filter-<?=$contentType['class']; ?>"></use>
                        </svg>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="popular__posts">
        <?php foreach ($posts as $post): ?>
        <article class="popular__post post post-<?=htmlspecialchars($post['class']);?>">
            <header class="post__header">
                <h2><?=htmlspecialchars($post['title']);?></h2>
            </header>
            <div class="post__main">
                <?php if ($post['class'] == 'quote'): ?>
                <blockquote>
                    <p>
                        <?=htmlspecialchars($post['body']);?>
                    </p>
                    <cite><?=htmlspecialchars($post['login']);?></cite>
                </blockquote>
                <?php elseif ($post['class'] == 'link'): ?>
                <div class="post-link__wrapper">
                    <a class="post-link__external" href="http://" title="Перейти по ссылке">
                        <div class="post-link__info-wrapper">
                            <div class="post-link__icon-wrapper">
                                <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                            </div>
                            <div class="post-link__info">
                                <h3><?=htmlspecialchars($post['title']);?></h3>
                            </div>
                        </div>
                        <span><?=htmlspecialchars($post['body']);?></span>
                    </a>
                </div>
                <?php elseif ($post['class'] == 'photo'): ?>
                <div class="post-photo__image-wrapper">
                <img src="img/<?=htmlspecialchars($post['image']);?>" alt="Фото от пользователя" width="360" height="240">
                </div>
                <?php elseif ($post['class'] == 'text'): ?>
                <?= truncateTextIfNecessary($post['body']); ?>
                <?php elseif ($post['class'] == 'video'): ?>
                <div class="post-video__block">
                    <div class="post-video__preview">
                        <?=embed_youtube_cover($post['body']); ?>
                        <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                    </div>
                    <a href="post-details.html" class="post-video__play-big button">
                        <svg class="post-video__play-big-icon" width="14" height="14">
                            <use xlink:href="#icon-video-play-big"></use>
                        </svg>
                        <span class="visually-hidden">Запустить проигрыватель</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <footer class="post__footer">
                <div class="post__author">
                    <a class="post__author-link" href="#" title="Автор">
                        <div class="post__avatar-wrapper">
                            <img class="post__author-avatar" src="<?=htmlspecialchars($post['avatar']);?>" alt="Аватар пользователя">
                        </div>
                        <div class="post__info">
                            <b class="post__author-name"><?=htmlspecialchars($post['login']);?></b>
                            <?=renderPostTimeElement($post); ?>
                        </div>
                    </a>
                </div>
                <div class="post__indicators">
                    <div class="post__buttons">
                        <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                            <svg class="post__indicator-icon" width="20" height="17">
                                <use xlink:href="#icon-heart"></use>
                            </svg>
                            <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                <use xlink:href="#icon-heart-active"></use>
                            </svg>
                            <span>0</span>
                            <span class="visually-hidden">количество лайков</span>
                        </a>
                        <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                            <svg class="post__indicator-icon" width="19" height="17">
                                <use xlink:href="#icon-comment"></use>
                            </svg>
                            <span>0</span>
                            <span class="visually-hidden">количество комментариев</span>
                        </a>
                    </div>
                </div>
            </footer>
        </article>
        <?php endforeach; ?>
    </div>
</div>
