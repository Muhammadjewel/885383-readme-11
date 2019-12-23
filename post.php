<?php
require_once('helpers.php');

$postIdQuery = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($postIdQuery) {
    $selectPostByIdSql = 'SELECT posts.*, content_types.class AS class, users.login AS author, users.avatar AS author_avatar, users.registration_date AS author_reg_date FROM posts JOIN users ON posts.user_id = users.id JOIN content_types ON posts.content_type_id = content_types.id WHERE posts.id = ?';
    $post = dbFetchData($connection, $selectPostByIdSql, [$postIdQuery])[0];
    $post['author_reg_duration'] = getRelativeTime($post['author_reg_date']);

    if ($post['class'] == 'quote') {
        $postBody = include_template('post-quote.php', ['post' => $post]);
    } elseif ($post['class'] == 'text') {
        $postBody = include_template('post-text.php', ['post' => $post]);
    } elseif ($post['class'] == 'link') {
        $postBody = include_template('post-link.php', ['post' => $post]);
    } elseif ($post['class'] == 'photo') {
        $postBody = include_template('post-photo.php', ['post' => $post]);
    } elseif ($post['class'] == 'video') {
        $postBody = include_template('post-video.php', ['post' => $post]);
    }
} else {
    // 404
}

$pageContent = include_template('post.php', [
    'post' => $post,
    'postBody' => $postBody
]);

$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);
