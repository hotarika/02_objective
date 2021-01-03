<?php
ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');
require './class/Sex.php';
require './class/AbChar.php';
require './class/CharMe.php';
require './class/CharYou.php';


// 初期化
function init()
{
   $_SESSION['state'] = 'gamestart';
   $_SESSION['knockDownNum'] = 0;
   AbChar::msgClear();
   AbChar::msgSet('戦いが始まった。');
   Me::createMe();
   You::createYou();
   error_log('初期化[init]*************************');
   error_log(print_r($_SESSION, true));
}

function gameover()
{
   $_SESSION['state'] = 'gameover';
}
