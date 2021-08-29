<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = Database::getPdoInstance();

$bbs_instance = new Bbs($pdo);
$bbs_instance->processPost();
$bbses = $bbs_instance->bbs_search();
$count = count($bbses);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My BBS</title>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <h1><a href="index.php">My BBS</a></h1>

  <h2>検索結果(<?= $count ?>件ヒット)</h2>
    <ul>
      <?php foreach ($bbses as $bbs): ?>
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

    <!-- <#?= $page->page(); ?> -->
  </body>
  </html>
