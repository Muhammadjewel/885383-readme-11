<?php
require_once('helpers.php');
$is_auth = rand(0, 1);

$user_name = 'Muhammadjavohir';
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

$pageContent = include_template('main.php', ['posts' => $posts]);
$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $user_name,
    'pageTitle' => 'readme: популярное',
    'is_auth' => $is_auth
]);

print($layoutContent);
