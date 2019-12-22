<?php
require_once('helpers.php');

$selectContentTypesSql = 'SELECT * FROM content_types';
$contentTypes = dbFetchData($connection, $selectContentTypesSql);

$contentTypeQuery = filter_input(INPUT_GET, 'content_type', FILTER_SANITIZE_NUMBER_INT);

if ($contentTypeQuery) {
    $selectPostsSql = 'SELECT posts.*, users.login, users.avatar, content_types.class FROM posts JOIN users ON posts.user_id = users.id JOIN content_types ON posts.content_type_id = content_types.id WHERE content_type_id = ? ORDER BY views DESC';
    $posts = dbFetchData($connection, $selectPostsSql, [$contentTypeQuery]);
} else {
    $selectPostsSql = 'SELECT posts.*, users.login, users.avatar, content_types.class FROM posts JOIN users ON posts.user_id = users.id JOIN content_types ON posts.content_type_id = content_types.id ORDER BY views DESC';
    $posts = dbFetchData($connection, $selectPostsSql);
}

$pageContent = include_template('popular.php', [
    'contentTypeQuery' => $contentTypeQuery,
    'contentTypes' => $contentTypes,
    'posts' => $posts
]);

$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);