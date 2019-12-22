<?php
require_once('helpers.php');

$postIdQuery = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($postIdQuery) {
    $selectPostByIdSql = 'SELECT * FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?';
    $post = dbFetchData($connection, $selectPostByIdSql, [$postIdQuery])[0];
} else {
    // 404
}

$pageContent = include_template('post.php', [
    'post' => $post
]);

$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);