<?php
require_once('helpers.php');

$postIdQuery = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$isPostExistent = dbFetchData($connection, 'SELECT * FROM posts WHERE posts.id = ?', [$postIdQuery]);

if ($postIdQuery && $isPostExistent != null) {
    $selectPostByIdSql = 'SELECT posts.*, content_types.class AS class FROM posts JOIN content_types ON posts.content_type_id = content_types.id WHERE posts.id = ?';
    $post = dbFetchData($connection, $selectPostByIdSql, [$postIdQuery], true);

    $postLikesCount = dbFetchData($connection, 'SELECT count(id) AS likes FROM likes WHERE post_id = ? GROUP BY id', [$post['id']], true)['likes'];
    $post['likes'] = $postLikesCount ?? 0;

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
    http_response_code(404);
    exit();
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
