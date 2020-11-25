<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$now_page = get_get('page');
if($now_page === ''){
  $now_page = 1;
}

$offset = ($now_page - 1) * ITEMS_PER_PAGE;

$items = get_items($db,true,$offset,ITEMS_PER_PAGE);
$count_items = count($items);

$all_items_count = get_open_count($db); //アイテムのトータル件数

$max_page = ceil($all_items_count / ITEMS_PER_PAGE); //最大ページ数

//リンクの表示
function link_page($page_num,$max_page,$now_page){
  if($now_page > 1){
    echo '<a href="?page='. ($now_page - 1) .'">前へ&nbsp;</a>';
  }
  for($page_num = 1; $page_num <= $max_page; $page_num++){
    if($page_num == $now_page){
      print h($page_num);
    } else {
      echo '<a href="?page='.$page_num.'">&nbsp'. $page_num .'&nbsp</a>';
    }
 }
 if($now_page < $max_page){
   echo '<a href="?page='. ($now_page + 1) .'">&nbsp;次へ</a>';
 }
}

//○○件-△△件を表示
$start_item = $offset + 1 ;
$last_item = $offset + $count_items ;


include_once VIEW_PATH . 'index_view.php';