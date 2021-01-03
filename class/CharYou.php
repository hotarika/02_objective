<?php


class You extends AbChar
{
   private $backgroundImg;
   private $circleColor;
   private $circleEdgeColor;
   private $level;
   private $comment;

   public function __construct($name, $sex, $maxHp, $restHp, $img, $backgroundImg, $attackMin, $attackMax, $circleColor, $circleEdgeColor, $level, $comment)
   {
      parent::__construct($name, $sex, $maxHp, $restHp, $img, $attackMin, $attackMax);
      $this->backgroundImg = $backgroundImg;
      $this->circleColor = $circleColor;
      $this->circleEdgeColor = $circleEdgeColor;
      $this->level = $level;
      $this->comment = $comment;
   }

   public function getBackgroundImg()
   {
      return $this->backgroundImg;
   }

   public function getBackground()
   {
      return $this->background;
   }

   public function getCircleColor()
   {
      return $this->circleColor;
   }

   public function getCircleEdgeColor()
   {
      return $this->circleEdgeColor;
   }

   public function getLevel()
   {
      return $this->level;
   }

   public function getComment()
   {
      return $this->comment;
   }

   public function attack($char)
   {
      $attackPoint = mt_rand($this->attackMin, $this->attackMax);
      $char->setRestHp($char->getRestHp() - $attackPoint);
   }

   public static function createYou()
   {
      global $you;
      $_SESSION['you'] = $you[mt_rand(0, 1)];
   }
}

// instance
$you[] = new You('無協力の夫', Sex::MAN, 500, 500, 'img/01_chuunen_neet_snep.png', 'img/01_cyabudaiGFVS3927.jpg', 50, 100, 'rgb(166, 161, 75)', 'rgb(122, 118, 45)', 11, 'あ、今帰り？　晩ご飯まだ？');
$you[] = new You('怪しい集団', Sex::UNKNOWN, 500, 500, 'img/02_cult_kyoudan.png', 'img/02_magic-circle_5540-768x768.png', 50, 100, 'rgb(190, 87, 255)', 'rgb(158, 4, 255)', 25, '私を信じれば全てがうまくいく...。');
