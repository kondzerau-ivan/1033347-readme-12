<?php
require_once('config/settings.php');

$is_auth = rand(0, 1);

$user_name = 'ivan';

$title = 'readme: популярное';

// Request Content Types from DB
$sql_types = 'SELECT
    *
    FROM content_types';

$types = db_request($con, $sql_types);

//Request Posts from DB
$sql_posts = 'SELECT
    p.*,
    u.login_user AS user_name,
    u.avatar,
    c.class_name AS type
    FROM posts AS p
    JOIN users AS u ON u.id = p.post_author_ID
    JOIN content_types AS c ON c.id = p.content_type_ID
    ORDER BY count_views DESC';

$posts = db_request($con, $sql_posts);

$content = include_template('main.php', [
    'types' => $types,
    'posts' => $posts
]);

$layout = include_template('layout.php', [
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'content' => $content
]);

echo ($layout);
