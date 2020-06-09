<?php include_once 'config/init.php'; ?>

<?php

$dashboard = new Dashboard();
$user = new User();

if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

if (isset($_POST['review_product'])) {
    $review = $_POST['review'];
    $order_id = $_POST['order_id'];
    if ($dashboard->reviewProduct($order_id, $review)) {
        redirect('dashboard.php');
    } else {
        redirect('dashboard.php', 'Something went wrong', 'error');
    }
}

$template = new Template('templates/dashboard.php');

$template->orders = $dashboard->fetchUserOrders();
$template->user = $user->getUser();

echo $template;