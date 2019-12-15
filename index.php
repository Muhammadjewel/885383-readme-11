<?php
date_default_timezone_set('Asia/Tashkent');
require_once('helpers.php');
$isAuth = rand(0, 1);

$username = 'Muhammadjavohir';
$posts = [
    [
        'heading' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'username' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
        'heading' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'username' => 'Владик',
        'avatar' => 'userpic.jpg'
    ],
    [
        'heading' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'username' => 'Виктор',
        'avatar' => 'userpic-mark.jpg'
    ],
    [
        'heading' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'username' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
        'heading' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'username' => 'Владик',
        'avatar' => 'userpic.jpg'
    ]
];
function truncateTextIfNecessary ($text, $maxTextLength = 300) {
    if (strlen($text) < $maxTextLength) {
        return '<p>' . $text . '</p>';
    }

    $textAsArray = explode(' ', $text);
    $truncatedText = '';
    $index = 0;
    while (strlen($truncatedText . ' ' . $textAsArray[$index]) < $maxTextLength) {
        $truncatedText .= ' ' . $textAsArray[$index];
        $index++;
    }
    $result = '<p>' . $truncatedText . '...</p><a class="post-text__more-link" href="#">Читать далее</a>';
    return $result;
}

function getRelativeTime ($postPublishedDate) {
    $dateDiff = strtotime('now') - strtotime($postPublishedDate);
    $dateDiffInMinutes = floor($dateDiff / 60);
    $dateDiffInHours = floor($dateDiff / 3600);
    $dateDiffInDays = floor($dateDiff / 86400);
    $dateDiffInWeeks = floor($dateDiff / 604800);
    $dateDiffInMonths = floor($dateDiffInWeeks / 4);

    if ($dateDiffInMinutes < 60) {
        $relativeTime = $dateDiffInMinutes . ' ' . get_noun_plural_form($dateDiffInMinutes, 'минута', 'минуты', 'минут') . ' назад';
    } elseif ($dateDiffInMinutes >= 60 && $dateDiffInHours < 24) {
        $relativeTime = $dateDiffInHours . ' ' . get_noun_plural_form($dateDiffInHours, 'час', 'часа', 'часов') . ' назад';
    } elseif ($dateDiffInHours >= 24 && $dateDiffInDays < 7) {
        $relativeTime = $dateDiffInDays . ' ' . get_noun_plural_form($dateDiffInDays, 'день', 'дня', 'дней') . ' назад';
    } elseif ($dateDiffInDays >= 7 && $dateDiffInWeeks < 5) {
        $relativeTime = $dateDiffInWeeks . ' ' . get_noun_plural_form($dateDiffInWeeks, 'неделья', 'недели', 'недель') . ' назад';
    } elseif ($dateDiffInWeeks >= 5) {
        $relativeTime = $dateDiffInMonths . ' ' . get_noun_plural_form($dateDiffInMonths, 'месяц', 'месяца', 'месяцов') . ' назад';
    }
    
    return $relativeTime;
}

function renderPostTimeElement ($post) {
    $randomPostDate = generate_random_date($post);    
    $postDateForTitle = date('d.m.Y H:i', strtotime($randomPostDate));

    return '<time class="post__time" title="' . $postDateForTitle . '" datetime="' . $randomPostDate . '">' . getRelativeTime($randomPostDate) . '</time>';
}

$pageContent = include_template('main.php', ['posts' => $posts]);
$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);
