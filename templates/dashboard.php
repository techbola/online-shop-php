<?php
include '../lib/Product.php';
include 'inc/header.php';
?>

    <main role="main">

        <div class="container-fluid" style="margin-top: 40px;">
            <div class="row justify-content-center">
                <main role="main" class="col-md-10">

                  <h4>User Balance:
                    <span style="color: green;">
                      <?php echo '$'.number_format((float)$user->balance, 2, '.', ''); ?>
                    </span>
                  </h4>
                  <hr>

                    <h5>Your orders</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price ($)</th>
                                <th>Quantity</th>
                                <th>Shipping Method</th>
                                <th>Review Product</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($orders) > 0): ?>
                              <?php foreach ($orders as $order): ?>
                                  <?php
                                  $product = getProduct($order->product_id);
                                  echo ucfirst($product->name);
                                  ?>
                                <tr>
                                    <td>
                                        <?php echo ucfirst($product->name); ?>
                                    </td>
                                    <td>
                                        <?php echo '$'.$product->price; ?>
                                    </td>
                                    <td>
                                        <?php echo $order->qty; ?>
                                    </td>
                                    <td>
                                        <?php echo $order->shipping_method; ?>
                                    </td>
                                  <td>
                                    <?php if (getProductRating($product->id)): ?>

                                      <?php echo getProductRatings($product->id); ?>

                                    <?php else: ?>
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Rate product
                                      </button>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; ?>

                              <?php else:; ?>
                                <tr><h4>No Order Yet!</h4></tr>

                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

    </main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rate Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="dashboard.php" method="post">
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Select rating</label>
            </div>
            <select class="custom-select" id="review" name="review" required>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="hidden" name="order_id" value="<?php echo $order->id; ?>">
          <input name="review_product" type="submit" class="btn btn-primary" value="Submit">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>