<?php
require_once('helpers.php');

$selectContentTypesQuery = 'SELECT * FROM content_types';
$selectPostsQuery = 'SELECT posts.*, users.login, users.avatar, content_types.class FROM posts JOIN users ON posts.user_id = users.id JOIN content_types ON posts.content_type_id = content_types.id ORDER BY views DESC';

$contentTypes = dbFetchData($connection, $selectContentTypesQuery);
$posts = dbFetchData($connection, $selectPostsQuery);

$pageContent = include_template('main.php', [
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
