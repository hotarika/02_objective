<?php

class Me extends AbChar
{
   public function attack($char)
   {
      $attackPoint = mt_rand($this->attackMin, $this->attackMax);
      if (!mt_rand(0, 4)) {
         $attackPoint *= 1.5;
         $attackPoint = (int) $attackPoint;
         AbChar::msgSet($this->getName() . 'のクリティカルヒット！');
      }
      $char->setRestHp($char->getRestHp() - $attackPoint);
   }

   public function break()
   {
      $_SESSION['me']->restHp = $this->maxHp;
   }

   // 自分を作成
   public static function createMe()
   {
      global $me;
      $_SESSION['me'] = $me;
   }
}

// instance
$me = new Me('たたかう看護師', Sex::WOMAN, 500, 500, 'img/yubisashikosyou_nurse.png', 50, 100);
