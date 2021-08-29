/*** 主テーブル ***/
CREATE TABLE mybbs (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL,
  main_text TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

INSERT INTO mybbs (name, main_text)
VALUES ('User1', 'post1');

INSERT INTO mybbs (name, main_text)
VALUES ('User2', 'post2');

INSERT INTO mybbs (name, main_text)
VALUES ('User3', 'post3');

INSERT INTO mybbs (name, main_text)
VALUES ('User4', 'post4');

INSERT INTO mybbs (name, main_text)
VALUES ('User5', 'post5');

INSERT INTO mybbs (name, main_text)
VALUES ('User6', 'post6');

SELECT * FROM mybbs;
