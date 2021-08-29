<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = Database::getPdoInstance();

$bbs_instance = new Bbs($pdo);
$bbses = $bbs_instance->processPost();
$bbs = $bbs_instance->getBbs();
$comments = $bbs_instance->getComments();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Post詳細</title>
  <link rel="stylesheet" href="css/show.css">
</head>

<body>
  <h1><a href="index.php">My BBS</a></h1>

  <div class="post">
    <div class="prof">
      <div class="name"><?= Utils::h($bbs->name); ?></div>
      <div class="date"><?= Utils::h($bbs->created_at); ?></div>
    </div>

    <div class="main-text">
      <form action="?action=update" method="post">
        <textarea name="main_text" placeholder="投稿を修正しよう"><?= $bbs->main_text; ?></textarea>
        <input type="hidden" name="id" value="<?= Utils::h($bbs->id); ?>">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
        <button>再投稿</button>
      </form>
    </div>

    <form class="delete-form" action="?action=delete" method="post">
      <span class="delete">削除</span>
      <input type="hidden" name="id" value="<?= Utils::h($bbs->id); ?>">
      <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
    </form>
  </div>

  <div class="comments">
    <ul>
      <?php foreach ($comments as $comment): ?>
        <div class="comment">
          <li>
            <div class="prof">
              <div class="name"><?= Utils::h($comment->name); ?></div>
              <div class="date"><?= Utils::h($comment->created_at); ?></div>
            </div>
            <div class="comment-text">
              <div><?= Utils::h($comment->comment_text); ?></div>
            </div>
          </li>
          <form class="comment-delete-form" action="?action=comment_delete" method="post">
            <span class="delete">削除</span>
            <input type="hidden" name="id" value="<?= Utils::h($bbs->id); ?>">
            <input type="hidden" name="comment_id" value="<?= Utils::h($comment->id); ?>">
            <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
          </form>
        </div>
      <?php endforeach ?>
    </ul>
  </div>

  <div class="post">
    <form class="comment-form" action="?action=comment_create" method="post">
      <div class="form-item">
        <input type="text" name="name" placeholder="お名前">
      </div>
      <div class="form-item">
        <textarea name="comment_text" placeholder="コメントしてみよう"></textarea>
      </div>
      <input type="hidden" name="id" value="<?= Utils::h($bbs->id); ?>">
      <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
      <button>投稿</button>
    </form>
  </div>

  <script src="js/main.js"></script>
</body>
</html>
