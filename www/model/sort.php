<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

function get_sorts_names($db){
    $sql = '
      SELECT
        sort_name,
        sort_key
      FROM
        sorts
    ';
    return fetch_all_query($db, $sql);
  }

  function get_sort_sql($db, $sort_key){
    $sql = '
      SELECT
        sort_sql
      FROM
        sorts
      WHERE
        sort_key = ?
    ';
    $params = array($sort_key);
    return fetchColumn_query($db, $sql, $params);
  }
