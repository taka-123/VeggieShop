<?php

function dd($var){
  var_dump($var);
  exit();
}

function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}

function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function get_file($name){
  if(isset($_FILES[$name]) === true){
    return $_FILES[$name];
  };
  return array();
}

function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

function set_session($name, $value){
  $_SESSION[$name] = $value;
}

function set_error($error){
  $_SESSION['__errors'][] = $error;
}

function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}

function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

function set_message($message){
  $_SESSION['__messages'][] = $message;
}

function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

function is_logined(){
  return get_session('user_id') !== '';
}

function get_upload_filename($file){
  if(is_valid_upload_image($file) === false){
    return '';
  }
  $mimetype = exif_imagetype($file['tmp_name']);
  $ext = PERMITTED_IMAGE_TYPES[$mimetype];
  return get_random_string() . '.' . $ext;
}

function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

function save_image($image, $filename){
  return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}

function delete_image($filename){
  if(file_exists(IMAGE_DIR . $filename) === true){
    unlink(IMAGE_DIR . $filename);
    return true;
  }
  return false;
  
}



function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}

function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}


function is_valid_upload_image($image){
  if(is_uploaded_file($image['tmp_name']) === false){
    set_error('ファイル形式が不正です。');
    return false;
  }
  $mimetype = exif_imagetype($image['tmp_name']);
  if( isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false ){
    set_error('ファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。');
    return false;
  }
  return true;
}


function h($str){
  return htmlspecialchars($str,ENT_QUOTES,'utf-8');
}

// トークンの生成
function get_csrf_token(){
  // get_random_string()はユーザー定義関数。
  $token = get_random_string(30);
  // set_session()はユーザー定義関数。
  set_session('csrf_token', $token);
  return $token;
}

// トークンのチェック
function is_valid_csrf_token($token){
  if($token === '') {
    return false;
  }
  // get_session()はユーザー定義関数
  return $token === get_session('csrf_token');
}

function get_now_page(){
  if(!isset($_GET['page_id'])){
    return 1;
  }else{
    return $_GET['page_id'];
  }
}

function print_page_link($now_page, $sort_key, $max_page) {
  // ページネーション
  print('<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">');
  // 「前へ」ボタン
  if($now_page > 1){
    print('<li class="page-item"><a class="page-link" href="/index.php?page_id='.($now_page - 1).'&sort_key='.$sort_key.'">前へ</a></li>');
  } else {
    // 現在のページが1ページ目ならリンクを貼らない
    print('<li class="page-item disabled"><a class="page-link">前へ</a></li>');
  }
  // 「ページ番号」の繰り返し表示
  for($i = 1; $i <= $max_page; $i++){
    if ($i === $now_page) {
      // 現在表示中のページ番号にはリンクを貼らない
      print('<li class="page-item active"><span class="page-link">'.$i.'<span class="sr-only">(current)</span></span></li>');
    } else {
      print('<li class="page-item"><a class="page-link" href="/index.php?page_id='.$i.'&sort_key='.$sort_key.'">'.$i.'</a></li>');
    }
  }
  // 「次へ」ボタン
  if($now_page < $max_page){
    print('<li class="page-item"><a class="page-link" href="/index.php?page_id='.($now_page + 1).'&sort_key='.$sort_key.'">次へ</a></li>');
  } else {
    // 現在のページが最終ページ目ならリンクを貼らない
    print('<li class="page-item disabled"><a class="page-link">次へ</a></li>');
  }
  print('</ul>
  </nav>');
}

function print_list_num($item_num, $now_start_num, $now_finish_num){
  print('<p class="text-center">
  「'.$item_num.'件中 '.$now_start_num.'-'.$now_finish_num.'件目の商品」
  </p>');
}