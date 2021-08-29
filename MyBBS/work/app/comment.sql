/*** 従テーブル ***/
CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT,
  bbs_id INT NOT NULL,
  name VARCHAR(64) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  comment_text TEXT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (bbs_id) REFERENCES mybbs(id)
);

INSERT INTO comments (bbs_id, name, comment_text)
VALUES ('6', 'Comment_User1', 'comment1');

INSERT INTO comments (bbs_id, name, comment_text)
VALUES ('6', 'Comment_User2', 'comment2');

INSERT INTO comments (bbs_id, name, comment_text)
VALUES ('5', 'Comment_User3', 'comment3');

SELECT * FROM comments;
