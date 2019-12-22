<?php
require_once('helpers.php');

$selectContentTypesSql = 'SELECT * FROM content_types';
$contentTypes = dbFetchData($connection, $selectContentTypesSql);

$contentTypeQuery = filter_input(INPUT_GET, 'content_type', FILTER_SANITIZE_NUMBER_INT);

if ($contentTypeQuery) {
    $selectPostsSql = 'SELECT * FROM posts WHERE content_type_id = ? ORDER BY views DESC';
    $posts = dbFetchData($connection, $selectPostsSql, [$contentTypeQuery]);
} else {
    $selectPostsSql = 'SELECT * FROM posts ORDER BY views DESC';
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