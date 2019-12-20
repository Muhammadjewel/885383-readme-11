CREATE DATABASE readme
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE readme;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email VARCHAR(255) NOT NULL UNIQUE,
  login VARCHAR(255) NOT NULL UNIQUE,
  password CHAR(64) NOT NULL,
  avatar VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE hashtags (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE content_types (
  id INT AUTO_INCREMENT PRIMARY KEY,
  type_name ENUM ('Текст', 'Цитата', 'Картинка', 'Видео', 'Ссылка'),
  class ENUM ('photo', 'video', 'text', 'quote', 'link')
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255) NOT NULL,
  body TEXT NOT NULL,
  author VARCHAR(255),
  image VARCHAR(255),
  video VARCHAR(255),
  link VARCHAR(255),
  views INT NOT NULL,
  user_id INT NOT NULL,
  content_type_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (content_type_id) REFERENCES content_types(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  body TEXT NOT NULL,
  user_id INT NOT NULL,
  post_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN key (post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE likes (
  user_id INT NOT NULL,
  post_id INT NOT NULL
);

CREATE TABLE subscriptions (
  author_id INT NOT NULL,
  subscription INT NOT NULL,
  FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (subscription) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  body TEXT NOT NULL,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE posts_hashtags (
  post_id INT NOT NULL,
  hashtag_id INT NOT NULL,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (hashtag_id) REFERENCES hashtags(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX index_user_id ON users(id);
CREATE INDEX index_user_email ON users(email);
CREATE INDEX index_user_login ON users(login);
CREATE INDEX index_hashtag_name ON hashtags(name);
CREATE INDEX index_content_type_name ON content_types(type_name);
