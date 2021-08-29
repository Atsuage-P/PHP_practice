<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = Database::getPdoInstance();

$bbs_instance = new Bbs($pdo);
$bbs_instance->processPost();
$bbses = $bbs_instance->getAll();

$page = new Pagenation($pdo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My BBS</title>
  <link rel="stylesheet" href="css/index.css">

</head>

<body>
  <header>
    <h1><a href="index.php">My BBS</a></h1>

    <form class="search" action="?action=search" method="post">
      <input class="search" type="input" name="search" placeholder="投稿の検索">
      <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
    </form>
  </header>

  <form class="bbs-form" action="?action=create" method="post">
    <div class="form-item">
      <label>お名前</label>
      <input type="text" name="name" placeholder="お名前">
    </div>
    <div class="form-item">
      <label>投稿</label>
      <textarea name="main_text" placeholder="投稿してみよう"></textarea>
    </div>
    <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
    <button class="form-item">投稿</button>
  </form>

  <ul>
    <?php foreach ($page->disp_data as $bbs): ?>
      <a href="show.php?id=<?= Utils::h($bbs->id); ?>">
        <div class="post">
          <li>
            <div class="prof">
              <div class="name"><?= Utils::h($bbs->name); ?></div>
              <div class="date"><?= Utils::h($bbs->created_at); ?></div>
            </div>
            <div class="contents">
              <div class="main-text">
                <div><?= Utils::h($bbs->main_text); ?></div>
              </div>
              <div class="notice">
                コメント：<?= $bbs_instance->getComment($bbs->id); ?>
              </div>
            </div>
          </li>
        </div>
      </a>
    <?php endforeach ?>
  </ul>

  <?= $page->page(); ?>
</body>
</html>
