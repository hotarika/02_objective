<?php

abstract class AbChar
{
   // property
   protected $name;
   protected $sex;
   protected $maxHp;
   protected $restHp;
   protected $img;
   protected $attackMin;
   protected $attackMax;
   protected abstract function attack($str);

   // constructor
   public function __construct($name, $sex, $maxHp, $restHp, $img,  $attackMin, $attackMax)
   {
      $this->name = $name;
      $this->sex = $sex;
      $this->maxHp = $maxHp;
      $this->restHp = $restHp;
      $this->img = $img;
      $this->attackMin = $attackMin;
      $this->attackMax = $attackMax;
   }

   // method
   //// name
   public function getName()
   {
      return $this->name;
   }

   //// sex
   public function getSexIcon()
   {
      if ($this->sex == Sex::MAN) {
         return '<i class="fas fa-mars"></i>';
      } elseif ($this->sex == Sex::WOMAN) {
         return '<i class="fas fa-venus"></i>';
      } else {
         return '<i class="fas fa-venus-mars"></i>';
      }
   }

   //// hp
   public function getMaxHp()
   {
      return $this->maxHp;
   }

   public function setRestHp($num)
   {
      $this->restHp = $num;
   }
   public function getRestHp()
   {
      return $this->restHp;
   }

   //// img
   public function getImg()
   {
      return $this->img;
   }

   public static function msgSet($str)
   {
      if (empty($_SESSION['msg'])) $_SESSION['msg'] = '';
      $_SESSION['msg'] = $str . '<br>' . $_SESSION['msg'];
   }

   public static function msgClear()
   {
      $_SESSION['msg'] = '';
   }
}
