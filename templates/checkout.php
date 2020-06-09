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
                    <form action="checkout.php" method="post">
                        
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
                            </li>
    
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
                                    <span class="text-muted">
                                          <?php
                                          echo '$'.$product->price;
                                          ?>
                                        </span>
                                    <span class="text-muted">
                                          <?php
                                          echo $cart->qty;
                                          ?>
                                        </span>
                                </li>
    
                                <?php $sum += $product->price * $cart->qty; ?>
    
                            <?php endforeach; ?>
    
                            <?php if(count($cartProducts) > 0): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total (USD)</span>
                                    <strong><?php echo $sum; ?></strong>
                                </li>
                            <?php endif; ?>
    
                        </ul>
                        
                        <div style="margin-bottom: 30px;">
                            <select name="shipping_method" id="shipping_method" class="form-control">
                                <option value="">Select shipping method</option>
                                <option value="Pick up">Pick up ($0 additional charge)</option>
                                <option value="UPS">UPS ($5 additional charge)</option>
                            </select>
                        </div>
    
                        <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Pay">
                        
                    </form>

                </div>

            </div>
        </div>
    </div>

</main>

<?php include 'inc/footer.php'; ?>
<?php
