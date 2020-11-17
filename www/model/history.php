<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_history($db,$user_id){
  $sql = "
    SELECT
      purchase_history.history_id,
      created,
      SUM(amount * price) as total
    FROM
      purchase_history
    JOIN
      purchase_details
    ON
      purchase_history.history_id = purchase_details.history_id
    WHERE
      user_id = ?
    GROUP BY
      purchase_history.history_id
    ORDER BY
      created DESC
    ";

    return fetch_all_query($db,$sql,[$user_id]);
}

function get_all_user_history($db){
  $sql = "
    SELECT
      purchase_history.history_id,
      created,
      SUM(amount * price) as total
    FROM
      purchase_history
    JOIN
      purchase_details
    ON
      purchase_history.history_id=purchase_details.history_id
    GROUP BY
      purchase_history.history_id
    ORDER BY
      created DESC
    ";

    return fetch_all_query($db,$sql);
}