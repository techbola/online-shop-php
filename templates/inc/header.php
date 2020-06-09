<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shop</title>
<!--    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="front.php"><?php echo SITE_NAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="front.php">Home</a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>
        </ul>
        <div class="d-inline my-2 my-lg-0">
          <span class="text-white">
            <a href="logout.php">Logout</a>
          </span>
        </div>
    </div>
</nav>
<div class="container" style="padding-top: 80px;">
  <div class="row">
    <div class="col-md-12">
        <?php displayMessage(); ?>
    </div>
  </div>
</div>