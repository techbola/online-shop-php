<?php include_once 'config/init.php'; ?>

<?php

$user = new User();

if (isset($_POST['submit'])) {

    if (empty($_POST['email']) && empty($_POST['password'])){
        redirect('index.php', 'All fields are required', 'error');
    }

    // Create data array
    $data = array();
    $data['email'] = $_POST['email'];
    $data['password'] = $_POST['password'];

    if ($user->loginUser($data['email'], $data['password'])) {
        $u = $user->loginUser($data['email'], $data['password']);
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $u->id;
        redirect('front.php');
    } else {
        redirect('index.php', 'Something went wrong', 'error');
    }
}

$template = new Template('templates/sign-in.php');

echo $template;