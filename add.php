<?php
require_once('helpers.php');

$contentTypesSql = 'SELECT * FROM content_types';
$contentTypes = dbFetchData($connection, $contentTypesSql, []);

$pageContent = include_template('add.php', [
    'contentTypes' => $contentTypes
]);

$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);