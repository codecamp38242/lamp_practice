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
if(!isset($now_page)){
  $now_page = 1;
}

$offset = ($now_page - 1) * ITEMS_PER_PAGE;

$items = get_items($db,true,$offset,ITEMS_PER_PAGE);

$all_items_count = get_open_count($db); //アイテムのトータル件数

$max_page = ceil($all_items_count / ITEMS_PER_PAGE); //最大ページ数

$link_pages = for_num($max_page);

include_once VIEW_PATH . 'index_view.php';