<?php include 'inc/header.php'; ?>

    <main role="main">

      <div class="py-5 bg-light">
        <div class="container" style="margin-top: 80px;">

          <div class="row">

          <?php foreach ($products as $product): ?>

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-img-top">
                  <img src="../assets/products/<?php echo $product->image; ?>" alt="apple" width="100%" height="225">
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?php echo ucfirst($product->name); ?></h4>
                  <div style="margin-bottom: 10px;">
                      <?php echo getProductRatings($product->id); ?>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a class="btn btn-sm btn-outline-secondary" href="cart.php?id=<?php echo $product->id; ?>">Add to Cart</a>
                    </div>
                    <small class="text-muted">$<?php echo $product->price; ?></small>
                  </div>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

          </div>
        </div>
      </div>

    </main>

<?php include 'inc/footer.php'; ?>