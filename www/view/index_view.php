<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="text-right">
      <form method="get" action="./index.php">
        <select name="sort_key">
        <?php foreach($sorts as $sort){ ?>
          <?php if($sort_key === $sort['sort_key']) { ?>
            <option selected value=<?php print(h($sort['sort_key'])); ?>>
              <?php print(h($sort['sort_name'])); ?>
            </option>
          <?php } else { ?>
            <option value=<?php print(h($sort['sort_key'])); ?>>
              <?php print(h($sort['sort_name'])); ?>
            </option>
          <?php } ?>
        <?php } ?>
        </select>
        <input type="submit" value="並び替え" class="btn btn-primary">
      </form>
    </div> 

    <?php print_page_link($now_page, $sort_key, $max_page); ?>

    <?php print_list_num($item_num, $now_start_num, $now_finish_num); ?>

    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print(h($item['name'])); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <?php print(number_format($item['price'])); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="hidden" name="token" value=<?php print $token ?>>
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>

    <?php print_list_num($item_num, $now_start_num, $now_finish_num); ?>

    <?php print_page_link($now_page, $sort_key, $max_page); ?>


    <h2 class="text-center mt-5">人気ランキング</h2>

    <div class="card-deck">
      <div class="row">
      <?php foreach($popular_items as $popular_item){ ?>
        <div class="col-4 item">
          <div class="card h-100 text-center">
            <div class="font-weight-bold text-center lead">  
              <?php print($rank++ . ' 位'); ?>
            </div>  
            <div class="card-header">
              <?php print(h($popular_item['name'])); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . $popular_item['image']); ?>">
              <figcaption>
                <?php print(number_format($popular_item['price'])); ?>円
                <?php if($popular_item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="hidden" name="token" value=<?php print $token ?>>
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print($popular_item['item_id']); ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  
</body>
</html>