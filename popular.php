<?php
require_once('helpers.php');

$contentTypeQuery = filter_input(INPUT_GET, 'content_type', FILTER_SANITIZE_NUMBER_INT);

$selectContentTypesQuery = 'SELECT * FROM content_types ORDER BY class ASC';

$contentTypes = dbFetchData($connection, $selectContentTypesQuery);

$pageContent = include_template('popular.php', [
    'contentTypeQuery' => $contentTypeQuery,
    'contentTypes' => $contentTypes,
]);

$layoutContent = include_template('layout.php', [
    'pageContent' => $pageContent,
    'username' => $username,
    'pageTitle' => 'readme: популярное',
    'isAuth' => $isAuth
]);

print($layoutContent);