<?php
/////////////////////////////////////////
//URLはhttp://localhost/blog/アクション名/タイトル/中身　
//もしくは
//http://localhost/blog/アクション名/id/タイトル/中身
//もしくは
//http://localhost/blog/アクション名/id/
//の形にした
//フロントを作るのが面倒だったので、POSTなどのメソッドを使う演習は省略
/////////////////////////////////////////

require_once('/vagrant/Dispatcher.php');
$dispatcher = new Dispatcher('/vagrant');
$dispatcher->dispatch();

?>
