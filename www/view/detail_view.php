<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細</title>
  <link rel="stylesheet" href="<?php STYLESHEET_PATH . 'admin.css' ; ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php' ; ?>

  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php' ; ?>
    <h1>購入明細</h1>
      <?php if(count($histories) > 0){ ?>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th>注文番号</th>
              <th>購入日時</th>
              <th>合計金額</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($histories as $history){ ?>
              <tr>
                <td><?php print h($history['history_id']); ?></td>
                <td><?php print h($history['created']); ?></td>
                <td><?php print h($history['total']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
      <?php if(count($details) > 0){ ?>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th>商品名</th>
              <th>購入時の商品価格</th>
              <th>購入数</th>
              <th>小計</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($details as $detail){ ?>
              <tr>
                <td><?php print h($detail['name']); ?></td>
                <td><?php print h($detail['price']); ?></td>
                <td><?php print h($detail['amount']); ?></td>
                <td><?php print h($detail['subtotal']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php }else{ ?>
        <p>購入明細がありません。</p>
      <?php } ?>
  </div>
</body>
</html>