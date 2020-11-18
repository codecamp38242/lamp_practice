<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_detail($db,$user_id,$history_id){
  $sql = "
    SELECT
      purchase_details.history_id,
      purchase_details.item_id,
      purchase_details.price,
      amount,
      purchase_details.price * amount as subtotal,
      name
    FROM
      purchase_details
    JOIN
      purchase_history
    ON
      purchase_details.history_id = purchase_history.history_id
    JOIN
      items
    ON
      purchase_details.item_id = items.item_id
    WHERE
      user_id = ?
    AND
      purchase_details.history_id = ?
    ";

    return fetch_all_query($db,$sql,[$user_id,$history_id]);
}

function get_all_user_detail($db,$history_id){
    $sql = "
      SELECT
        purchase_details.history_id,
        purchase_details.item_id,
        purchase_details.price,
        amount,
        purchase_details.price * amount as subtotal,
        name
      FROM
        purchase_details
      JOIN
        items
      ON
        purchase_details.item_id = items.item_id
      WHERE
        purchase_details.history_id = ?
      ";
  
      return fetch_all_query($db,$sql,[$history_id]);
  }


  function get_detail_history($db,$history_id,$user_id = null){
    $params = [$history_id];
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
        purchase_history.history_id = ?";
    if($user_id !== null){
      $sql.=" AND user_id = ?";
      $params[] = $user_id;
    }
    $sql.=" GROUP BY
        purchase_history.history_id
      ";
    
      return fetch_all_query($db,$sql,$params);
  }

  // function filter($histories,$history_id){
  //   return array_filter($histories,function($row,$history_id){
  //     return $row['history_id'] === $history_id;
  //   });
  // }