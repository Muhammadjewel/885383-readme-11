/* Create content types */
INSERT INTO content_types (type_name, class) VALUES ('Текст', 'text');
INSERT INTO content_types (type_name, class) VALUES ('Цитата', 'quote');
INSERT INTO content_types (type_name, class) VALUES ('Картинка', 'photo');
INSERT INTO content_types (type_name, class) VALUES ('Видео', 'video');
INSERT INTO content_types (type_name, class) VALUES ('Ссылка', 'link');

/* Create users */
INSERT INTO users (email, login, password, avatar) VALUES ('someone1@gmail.com', 'someone1', 'something1', 'https://picsum.photos/150?random=1');
INSERT INTO users (email, login, password, avatar) VALUES ('someone2@gmail.com', 'someone2', 'something2', 'https://picsum.photos/150?random=2');

/* Create posts */
INSERT INTO posts (title, body, author, image, video, link, views, user_id, content_type_id) VALUES ('Цитата', 'Мы в жизни любим только раз, а после ищем лишь похожих', null, null, null, null, 423, 1, 2);
INSERT INTO posts (title, body, author, image, video, link, views, user_id, content_type_id) VALUES ('Игра престолов', 'Не могу дождаться начала финального сезона своего любимого сериала !', null, null, null, null, 123, 2, 1);
INSERT INTO posts (title, body, author, image, video, link, views, user_id, content_type_id) VALUES ('Наконец, обработал фотки!', '', null, 'rock-medium.jpg', null, null, 123, 2, 3);
INSERT INTO posts (title, body, author, image, video, link, views, user_id, content_type_id) VALUES ('Моя мечта', '', null, 'coast - medium.jpg', null, null, 123, 1, 3);
INSERT INTO posts (title, body, author, image, video, link, views, user_id, content_type_id) VALUES ('Лучшие курсы', '', null, null, null, 'www.htmlacademy.ru', 123, 1, 5);

/* Create comments for posts */
INSERT INTO comments (body, user_id, post_id) VALUES ('Классно', 1, 1);
INSERT INTO comments (body, user_id, post_id) VALUES ('Очень жду.', 2, 2);

/* получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента */
SELECT posts.*, users.login, content_types.type_name FROM posts
JOIN users
  ON posts.user_id = users.id
JOIN content_types
  ON posts.content_type_id = content_types.id
ORDER BY views DESC;

/* получить список постов для конкретного пользователя */
SELECT * FROM posts
WHERE posts.user_id = 1;

/* получить список комментариев для одного поста, в комментариях должен быть логин пользователя */
SELECT comments.*, users.login FROM comments
JOIN users
  ON comments.user_id = users.id
WHERE comments.post_id = 1;

/* добавить лайк к посту */
INSERT INTO likes(user_id, post_id) VALUES (1, 2);

/* подписаться на пользователя */
INSERT INTO subscriptions(author_id, subscription) VALUES (1, 2);
