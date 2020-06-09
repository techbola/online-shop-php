<?php include_once 'config/init.php'; ?>

<?php

if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

$cart = new ShoppingCart();

if ($product_id) {

    if (verifyUserBalance($product_id)) {
        $data = array();
        $data['product_id'] = $product_id;
        $data['user_id'] = $_SESSION['user_id'];
        $data['qty'] = 1;

        $cart->addToCart($data);

        if ($cart) {
            redirect('cart.php');
        } else {
            redirect('cart.php');
        }
    } else {
        redirect('front.php', 'Insufficient funds', 'error');
    }

}

if (isset($_POST['update_cart_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    if ($cart->updateCart($cart_id, $qty)) {
        redirect('cart.php', 'Cart Updated', 'success');
    } else {
        redirect('cart.php', 'Something went wrong', 'error');
    }
}

if (isset($_POST['del_id'])) {
    $del_id = $_POST['del_id'];
    if ($cart->delete($del_id)) {
        redirect('cart.php', 'Cart Deleted', 'success');
    } else {
        redirect('cart.php', 'Something went wrong', 'error');
    }
}

$template = new Template('templates/cart.php');

$template->cartProducts = $cart->fetchUserCart();

echo $template;
