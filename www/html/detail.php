<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'history.php';
require_once MODEL_PATH . 'detail.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$history_id = get_post('history_id');
$token = get_post('token');

if(is_valid_csrf_token($token)){
  if(is_admin($user) === true){
    $details = get_all_user_detail($db,$history_id);
    $histories = get_detail_history($db,$history_id);
  }else{
    $details = get_user_detail($db,$user['user_id'],$history_id);
    $histories = get_detail_history($db,$history_id,$user['user_id']);
  }
}else{
  set_error('不正な操作が行われました');
}

//var_dump(filter($histories,$history_id));


include_once VIEW_PATH . 'detail_view.php';