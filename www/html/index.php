<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/item.php';
require_once '../model/sort.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_csrf_token();

// 公開商品全件数
$item_num = get_open_items_num($db);
// トータルページ数
$max_page = ceil($item_num / INDEX_NUM_MAX);
// 現在ページ番号
$now_page = (int)get_now_page();
// 開始配列
$start_array_num = INDEX_NUM_MAX * ($now_page - 1);
// 開始件数
$now_start_num = INDEX_NUM_MAX * ($now_page - 1) + 1;
// 終了件数
if (($now_start_num + INDEX_NUM_MAX - 1) < $item_num) {
  $now_finish_num = $now_start_num + INDEX_NUM_MAX - 1;
} else {
  $now_finish_num = $item_num;
}

$sorts = get_sorts_names($db);

$sort_key = get_get('sort_key');
if ($sort_key === ''){
  // プルダウン未選択なら、新着順
  $sort_key = 'new';
}

$sort_sql = get_sort_sql($db, $sort_key);

$items = get_open_limit_items($db, $sort_sql, $start_array_num, INDEX_NUM_MAX);

$popular_item_3 = get_popular_items($db, 3);
$rank = 1;

include_once VIEW_PATH . 'index_view.php';