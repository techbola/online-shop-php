<?php include_once 'config/init.php'; ?>

<?php

if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

$product = new Product();

$template = new Template('templates/frontpage.php');

$template->products = $product->getAllProducts();

echo $template;
