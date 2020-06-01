<?php

define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/model/');
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/view/');


define('IMAGE_PATH', '/veggieshop/assets/images/');
define('STYLESHEET_PATH', '/veggieshop/assets/css/');
define('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/veggieshop/assets/images/' );

define('DB_HOST', 'localhost');
define('DB_NAME', 'ec_site');
define('DB_USER', 'root');
define('DB_PASS', '6pF7oUwse');
define('DB_CHARSET', 'utf8');

define('SIGNUP_URL', '/veggieshop/signup.php');
define('LOGIN_URL', '/veggieshop/login.php');
define('LOGOUT_URL', '/veggieshop/logout.php');
define('HOME_URL', '/veggieshop/index.php');
define('CART_URL', '/veggieshop/cart.php');
define('FINISH_URL', '/veggieshop/finish.php');
define('HISTORY_URL', '/veggieshop/history.php');
define('ADMIN_URL', '/veggieshop/admin.php');

define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
define('REGEXP_POSITIVE_INTEGER', '/\A([1-9][0-9]*|0)\z/');

// 商品一覧1ページの最大表示件数
define('INDEX_NUM_MAX', 8);

// 人気ランキングの表示件数
define('RANK_DISPLAY_NUM', 3);

define('USER_NAME_LENGTH_MIN', 6);
define('USER_NAME_LENGTH_MAX', 100);
define('USER_PASSWORD_LENGTH_MIN', 6);
define('USER_PASSWORD_LENGTH_MAX', 100);

define('USER_TYPE_ADMIN', 1);
define('USER_TYPE_NORMAL', 2);

define('ITEM_NAME_LENGTH_MIN', 1);
define('ITEM_NAME_LENGTH_MAX', 100);

define('ITEM_STATUS_OPEN', 1);
define('ITEM_STATUS_CLOSE', 0);

define('PERMITTED_ITEM_STATUSES', array(
  'open' => 1,
  'close' => 0,
));

define('PERMITTED_IMAGE_TYPES', array(
  IMAGETYPE_JPEG => 'jpg',
  IMAGETYPE_PNG => 'png',
));