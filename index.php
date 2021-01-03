<?php
require 'function.php';
session_start(); //位置はオブジェクトを定義した後

if (empty($_POST)) init();

if (!empty($_POST)) {
   if (!empty($_POST['attack'])) {
      // 自分が攻撃
      $_SESSION['me']->attack($_SESSION['you']);
      AbChar::msgSet($_SESSION['me']->getName() . 'の攻撃');

      // 相手が攻撃
      $_SESSION['you']->attack($_SESSION['me']);
      AbChar::msgSet($_SESSION['you']->getName() . 'の攻撃');

      if ($_SESSION['me']->getRestHp() <= 0) {
         gameover();
      } elseif ($_SESSION['you']->getRestHp() <= 0) {
         You::createYou();
         $_SESSION['knockDownNum'] += 1;
      }
   } elseif (!empty($_POST['break'])) {
      $_SESSION['me']->break();
   } elseif (!empty($_POST['init'])) {
      init();
   }

   $_POST = array();
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
   <link rel="stylesheet" href="./css/import.css">
   <title>たたかう看護師</title>
</head>

<body>
   <main class="p-mainWrap">
      <h1 class="p-head">たたかう看護師</h1>
      <div class="p-screenWrap">
         <?php if ($_SESSION['state'] == 'gamestart') : ?>
            <div class="p-gridWrap u-br" style="background-image: url('<?= $_SESSION['you']->getBackgroundImg(); ?>')">
               <!-- me -->
               <div class=" p-main -me">
                  <!-- info -->
                  <div class="p-info -me u-br">
                     <div class="p-infoUpper">
                        <span class="p-infoName"><?= $_SESSION['me']->getName(); ?></span>
                        <span class="p-infoSex"><?= $_SESSION['me']->getSexIcon(); ?></span>
                     </div>
                     <div class="p-infoCenter">
                        HP : <span class="p-infoHpMeter -max u-br">
                           <span class="p-infoHpMeter -rest u-br" style="width:calc(<?= $_SESSION['me']->getRestHp(); ?>/<?= $_SESSION['me']->getMaxHp(); ?>*100%)"></span>
                        </span>
                     </div>
                     <div class="p-infoLower">
                        <span class="p-infoHp -rest"><?= $_SESSION['me']->getRestHp(); ?></span> / <span class="p-infoHp -max"><?= $_SESSION['me']->getMaxHp(); ?></span>
                     </div>
                  </div>
                  <!-- img -->
                  <img src="<?= $_SESSION['me']->getImg(); ?>" alt="" class="p-img -me">
                  <div class="p-circle -me"></div>
               </div>

               <!-- you -->
               <div class="p-main -you">
                  <!-- info -->
                  <div class="p-info -you u-br">
                     <div class="p-infoUpper">
                        <span class="p-infoName"><?= $_SESSION['you']->getName(); ?></span>
                        <span class="p-infoSex"><?= $_SESSION['you']->getSexIcon(); ?></span>
                        <span class="p-infoLevel">Lv.<?= $_SESSION['you']->getLevel(); ?></span>
                     </div>
                     <div class="p-infoCenter">
                        HP : <span class="p-infoHpMeter -max u-br">
                           <span class="p-infoHpMeter -rest u-br" style="width:calc(<?= $_SESSION['you']->getRestHp(); ?>/<?= $_SESSION['you']->getMaxHp(); ?>*100%)"></span>
                        </span>
                     </div>
                     <div class="p-infoLower">
                        <span class="p-infoHp -rest"><?= $_SESSION['you']->getRestHp(); ?></span> / <span class="p-infoHp -max"><?= $_SESSION['you']->getMaxHp(); ?></span>
                     </div>
                  </div>
                  <!-- img -->
                  <div class="p-imgWrap">
                     <img src="<?= $_SESSION['you']->getImg();
                                 ?>" alt="" class="p-img -you">
                  </div>
                  <div class="p-circle -you" style="border:1px solid <?= $_SESSION['you']->getCircleEdgeColor(); ?>; background:<?= $_SESSION['you']->getCircleColor(); ?>"></div>
                  <p class="p-comment u-br"><?= $_SESSION['you']->getComment(); ?></p>
               </div>

               <!-- desc -->
               <div class="p-desc">
                  <div class="p-descWrap u-br">
                     <div class="p-descArea">
                        <?= $_SESSION['msg']; ?>
                     </div>
                     <div class="p-knockDownNum">倒した相手の数：<?= $_SESSION['knockDownNum']; ?></div>
                     <form action="" method="post" class="p-formWrap u-br">
                        <div class="p-formReverse">
                           <input type="submit" name="attack" value="攻撃する" class="p-button -attack">
                           <span class="p-formHover -attack">▶︎</span>
                        </div>
                        <div class="p-formReverse">
                           <input type="submit" name="break" value="休息する" class="p-button -break">
                           <span class="p-formHover -break">▶︎</span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

         <?php elseif ($_SESSION['state'] == 'gameover') : ?>
            <div class="p-gameover u-br"><span>GAME OVER</span><br>私に休息をください...</div>
         <?php endif; ?>
         <form action="" method="post" class="p-initWrap u-br">
            <input type="submit" name="init" value="最初から" class="p-button -init u-br">
         </form>
      </div>
   </main>
</body>

</html>
