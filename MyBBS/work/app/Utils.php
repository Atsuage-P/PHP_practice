<?php

class Utils {
  /*** 特殊文字の変換 ***/
  public static function h($str) {
    return nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
  }
}

?>
