<?php

require_once(__DIR__ . '/Bbs.php');

define('POST_NUM', '5');

class Pagenation {
  private $bbs_count;
  private $total_page;
  private $now;
  public  $disp_data;

  public function __construct($pdo) {
    $bbs = new Bbs($pdo);
    $bbs_count = count($bbs->getAll());
    $this->total_page = ceil($bbs_count / POST_NUM);
    if (!isset($_GET['page'])) {
      $this->now = 1;
    } else {
      $this->now = (int) $_GET['page'];
    }
    $start_no = ($this->now - 1) * POST_NUM;
    $this->disp_data = array_slice($bbs->getAll(), $start_no, POST_NUM, true);
  }

  /*** ページ番号とめくり文字 ***/
  public function page() {
    if ($this->now > 1) {
      echo "<a class='page' href=index.php?page=1><<最初へ  </a>";
    }

    if ($this->now > 1) {
      echo "<a class='page' href=index.php?page=" . ($this->now - 1) . "><<前へ</a>";
    }

    for($i = 1; $i <= $this->total_page; $i++) {
      if ($i == $this->now) {
        echo $this->now. '  ';
      } else {
        echo "<a class='page' href=index.php?page=" . $i . ">" . $i . "  " . "</a>";
      }
    }

    if ($this->now < $this->total_page) {
      echo "<a class='page' href=index.php?page=" . ($this->now + 1) . ">次へ>>  </a>";
    }

    if ($this->now < $this->total_page) {
      echo "<a class='page' href=index.php?page=" . $this->total_page . ">最後へ>></a>";
    }
  }
}
?>
