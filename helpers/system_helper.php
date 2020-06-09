<?php

// Redirect to page
function redirect($page=FALSE, $message=NULL, $message_type=NULL) {
    if (is_string($page)) {
        $location = $page;
    } else {
        $location = $_SERVER['SCRIPT_NAME'];
    }

    // check for message
    if ($message != NULL) {
        // Set message
        $_SESSION['message'] = $message;
    }

    // check for type
    if ($message_type != NULL) {
        // Set message
        $_SESSION['message_type'] = $message_type;
    }

    // Redirect
    header('Location: '.$location);
    exit();
}

// Display Message
function displayMessage() {
    if (!empty($_SESSION['message'])) {
        // assign message var
        $message = $_SESSION['message'];

        if (!empty($_SESSION['message_type'])) {
            // assign type var
            $message_type = $_SESSION['message_type'];
            // Create object
            if ($message_type == 'error') {
                echo '<div class="alert alert-danger">'. $message . '</div>';
            } else {
                echo '<div class="alert alert-success">'. $message . '</div>';
            }
        }
        // unset message
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    } else {
        echo '';
    }
}

function verifyUserBalance($id){
    $user = getUser();
    $product = getProduct($id);

    if ($user->balance < $product->price) {
        return false;
    } else {
        return true;
    }
}

function checkUserBalance($cartProducts){
    $user = getUser();

    $sum = 0;
    foreach ($cartProducts as $cart) {
        $product = getProduct($cart->product_id);
        $sum += ($product->price * $cart->qty);
    }

//    echo $sum; exit();

    if ($user->balance < $sum) {
        return false;
    } else {
        return true;
    }
}

function getUser(){
    $user_id = $_SESSION['user_id'];

    $dsn = 'mysql:host=localhost;dbname=abc_hosting';
    $dbh = new PDO($dsn, 'root', '');
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row;
}

function getProduct($id){
    $dsn = 'mysql:host=localhost;dbname=abc_hosting';
    $dbh = new PDO($dsn, 'root', '');
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row;
}

function getProductRating($id){
    $dsn = 'mysql:host=localhost;dbname=abc_hosting';
    $dbh = new PDO($dsn, 'root', '');
    $query = "SELECT * FROM rating WHERE product_id = :product_id";
    $stmt = $dbh->prepare($query);
    $stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (count($results) > 0){
        $countRating = count($results);

        $sum = 0;
        foreach ($results as $item) {
            $sum += $item->rating;
        }

        if ($averageRating = $sum / $countRating) {
            return $averageRating = $sum / $countRating;
        } else {
            return false;
        }
    } else {
        return false;
    }

}

function getProductRatings($id){
    $rating = getProductRating($id);

    if ($rating == 5) {
        return '<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>';
    }
    elseif ($rating == 4) {
        return '<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>';
    }
    elseif ($rating == 3) {
        return '<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>';
    }
    elseif ($rating == 2) {
        return '<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>';
    }
    elseif ($rating == 1) {
        return '<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>';
    }

}