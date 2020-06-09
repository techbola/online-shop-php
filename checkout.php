<?php include_once 'config/init.php'; ?>

<?php

if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

$checkout = new Checkout();
$user = new User();

$cart = new ShoppingCart();
$cartProducts = $cart->fetchUserCart();

if (count($cartProducts) > 0) {
    if (!checkUserBalance($cartProducts)) {
        redirect('cart.php', 'Insufficient funds', 'error');
    }
}

if (isset($_POST['submit'])) {

    $shipping_method = $_POST['shipping_method'];

    if (empty($shipping_method)) {
        redirect('checkout.php', 'Please select a shipping method', 'error');
    } else {

        // Create data array
        $data = array();
        $data['shipping_method'] = $_POST['shipping_method'];

        if ($checkout->createOrder($data, $cartProducts)) {
            $user->chargeOrder($data['shipping_method']);
            $cart->clearCart();
            redirect('dashboard.php');
        } else {
            redirect('checkout.php', 'Something went wrong', 'error');
        }
    }
}

$template = new Template('templates/checkout.php');
$template->cartProducts = $cartProducts;

echo $template;