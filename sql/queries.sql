/* 1. Create database */

CREATE DATABASE blog_php;

/* 2. Create posts table */

CREATE TABLE post (
  post_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  url_key VARCHAR(255) NOT NULL,
  image_path varchar(255) NULL,
  content TEXT DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  published_date DATETIME NOT NULL,
  PRIMARY KEY (post_id),
  UNIQUE KEY url_key (url_key)
) ENGINE=InnoDB;

/* 3. Add 3 posts into the posts table */

INSERT INTO post (title, url_key, content, description, published_date) VALUES ('Hello World', 'hello-world', 'Contrary to popular belief, Lorem Ipsum is notassicgrd McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source." ', 'My first blog post', '2020-12-05 12:00:00');
INSERT INTO post (title, url_key, content, description, published_date) VALUES ('Second post', 'second-post', 'It is a long established fact that a reader will be aint of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content.','2020-12-09 12:00:00');
INSERT INTO post (title, url_key, content, description, published_date) VALUES ('My third post', 'my-third-post', 'There are many variations of passages of Lorem Ipsum available', 'or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet ','2020-12-10 12:00:00');
