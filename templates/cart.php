    <?php
        include '../lib/Product.php';
        include 'inc/header.php';
    ?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container" style="margin-top: 80px;">

                <h2 class="text-center">Cart</h2>
                <hr>

                <div class="row justify-content-center">

                    <div class="col-md-10 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill">
                              <?php echo count($cartProducts) ?>
                            </span>
                        </h4>
                        <ul class="list-group mb-3">

                          <li class="list-group-item d-flex justify-content-between">
                            <div>
                              <h6 class="my-0">
                                  Product
                              </h6>
                            </div>
                            <div>
                              <h6 class="my-0">
                                Price
                              </h6>
                            </div>
                            <div>
                              <h6 class="my-0">
                                Quantity
                              </h6>
                            </div>
                            <div>
                              <h6 class="my-0">
                                Increase Quantity
                              </h6>
                            </div>
                            <div>
                              <h6 class="my-0">
                                Delete
                              </h6>
                            </div>
                          </li>

                            <?php if (count($cartProducts) > 0): ?>

                            <?php $sum = 0; ?>
                            <?php foreach ($cartProducts as $cart): ?>

                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0">
                                            <?php
                                              $product = getProduct($cart->product_id);
                                              echo ucfirst($product->name);
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="text-muted">
                                      <?php
                                        echo '$'.$product->price;
                                      ?>
                                    </div>
                                  <div class="text-muted">
                                      <?php
                                      echo $cart->qty;
                                      ?>
                                    </div>
                                  <div>
                                      <form action="cart.php" style="display: inline;" method="post">
                                        <input type="number" min="1" name="qty" style="width: 50px;">
                                        <input type="hidden" name="cart_id" value="<?php echo $cart->id; ?>">
                                        <input type="submit" class="btn btn-success" name="update_cart_qty" value="Update">
                                      </form>
                                    </div>
                                  <div class="text-muted">
                                      <form action="cart.php" style="display: inline;" method="post">
                                        <input type="hidden" name="del_id" value="<?php echo $cart->id; ?>">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                      </form>
                                    </div>
                                </li>

                            <?php $sum += $product->price * $cart->qty; ?>

                          <?php endforeach; ?>

                          <?php else:; ?>
                            <h4 style="padding: 10px;">Cart is Empty!</h4>

                          <?php endif; ?>

                          <?php if(count($cartProducts) > 0): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong><?php echo $sum; ?></strong>
                            </li>
                            <?php endif; ?>

                        </ul>

                        <?php if(count($cartProducts) > 0): ?>
                        <a class="btn btn-primary btn-lg btn-block" href="checkout.php">Continue to checkout</a>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>

    </main>

<?php include 'inc/footer.php'; ?>
