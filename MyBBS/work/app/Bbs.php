<?php

class Bbs {

  public function __construct($pdo) {
    $this->pdo = $pdo;
    Token::create();
  }

  /*** POSTによる操作の分岐 ***/
  public function processPost() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      Token::validate();
      $action = filter_input(INPUT_GET, 'action');

      switch ($action) {
        case 'create':
          $this->create();
          break;
        case 'update':
          $this->update();
          break;
        case 'delete':
          $this->delete();
          break;
        case 'comment_create':
          $bbs_id = trim(filter_input(INPUT_POST, 'id'));
          $this->comment_create();
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit;
        case 'comment_delete':
          $bbs_id = trim(filter_input(INPUT_POST, 'id'));
          $this->comment_delete();
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit;
        case 'search':
          $search = trim(filter_input(INPUT_POST, 'search'));
          header('Location: ' . $_SERVER['HTTP_HOST'] . $search);
          $this->bbs_search();
          exit;
        default:
          exit;
      }
      header('Location: ' . SITE_URL);
      exit;
    }
  }

  /*** コメントの追加 ***/
  private function comment_create() {
    $bbs_id = trim(filter_input(INPUT_POST, 'id'));
    $name = trim(filter_input(INPUT_POST, 'name'));
    $comment_text = trim(filter_input(INPUT_POST, 'comment_text'));
    if ($name === '' || $comment_text === '') {
      return;
    }
    $stmt = $this->pdo->prepare("INSERT INTO comments (bbs_id, name, comment_text) VALUES (:bbs_id, :name, :comment_text)");
    $stmt->bindValue('bbs_id', $bbs_id, PDO::PARAM_STR);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('comment_text', $comment_text, PDO::PARAM_STR);
    $stmt->execute();
  }

  /*** コメントの削除 ***/
  private function comment_delete() {
    $id = filter_input(INPUT_POST, 'comment_id');
    if (empty($id)) {
      return;
    }
    $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->bindValue('id', $id, PDO::PARAM_STR);
    $stmt->execute();
  }

  /*** 投稿の追加 ***/
  private function create() {
    $name = trim(filter_input(INPUT_POST, 'name'));
    $main_text = trim(filter_input(INPUT_POST, 'main_text'));
    if ($name === '' || $main_text === '') {
      return;
    }
    $stmt = $this->pdo->prepare("INSERT INTO mybbs (name, main_text) VALUES (:name, :main_text)");
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('main_text', $main_text, PDO::PARAM_STR);
    $stmt->execute();
  }

  /*** 投稿の更新 ***/
  private function update() {
    $id = filter_input(INPUT_POST, 'id');
    $main_text = trim(filter_input(INPUT_POST, 'main_text'));
    if ($main_text === '') {
      return;
    }
    $stmt = $this->pdo->prepare("UPDATE mybbs SET main_text = :main_text WHERE id = :id");
    $stmt->bindValue('id', $id, PDO::PARAM_STR);
    $stmt->bindValue('main_text', $main_text, PDO::PARAM_STR);
    $stmt->execute();
  }

  /*** 投稿の削除 ***/
  private function delete() {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
      return;
    }
    // 先に子テーブルから削除
    $stmt = $this->pdo->prepare("DELETE FROM comments WHERE bbs_id = :bbs_id");
    $stmt->bindValue('bbs_id', $id, PDO::PARAM_STR);
    $stmt->execute();

    // 次に親テーブルから削除
    $stmt = $this->pdo->prepare("DELETE FROM mybbs WHERE id = :id");
    $stmt->bindValue('id', $id, PDO::PARAM_STR);
    $stmt->execute();
  }

  /*** 投稿の全取得 ***/
  public function getAll() {
    $stmt = $this->pdo->query("SELECT * FROM mybbs ORDER BY id DESC");
    $bbses = $stmt->fetchAll();
    return $bbses;
  }

  /*** 特定の投稿の取得 ***/
  public function getBbs() {
    $id = $_GET["id"];
    $stmt = $this->pdo->prepare("SELECT * FROM mybbs WHERE id = :id");
    $stmt->bindValue('id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $bbs = $stmt->fetch();
    return $bbs;
  }

  /*** ある投稿に関する全てのコメント取得 ***/
  public function getComments() {
    $bbs_id = $_GET["id"];
    $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE bbs_id = :bbs_id ORDER BY id DESC");
    $stmt->bindValue('bbs_id', $bbs_id, PDO::PARAM_STR);
    $stmt->execute();
    $comments = $stmt->fetchAll();
    return $comments;
  }

  /*** ある投稿に関する全てのコメントの合計を取得 ***/
  public function getComment($bbs_id) {
    $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE bbs_id = :bbs_id");
    $stmt->bindValue('bbs_id', $bbs_id, PDO::PARAM_STR);
    $stmt->execute();
    $comments = $stmt->fetchAll();
    return count($comments);
  }

  /*** 投稿の検索 ***/
  public function bbs_search() {
    $target = $_GET['search'];
    if ($target === '') {
      return;
    }
    $stmt = $this->pdo->prepare("SELECT * FROM mybbs WHERE main_text LIKE :target ORDER BY id DESC");
    $stmt->bindValue('target', '%' . $target . '%', PDO::PARAM_STR);
    $stmt->execute();
    $targets = $stmt->fetchAll();
    return $targets;
  }
}

?>
