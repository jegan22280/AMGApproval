<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="Justin Egan">
      
      <!-- Font Awesome CDN -->
      <script src="https://kit.fontawesome.com/6bcd09c114.js" crossorigin="anonymous"></script>
      
      <!-- favicon -->
      <link rel="icon" href="https://payments.dblinc.net/php/payments/img/DBLIconSmall.ico">

      <!-- Bootstrap CSS/CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      

      
      
      <!-- jquery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      <!-- jquery ui -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
      <!-- jqueri ui css -->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      
      <!-- Tabulator  -->
      <link href="css/tabulator_bootstrap4.min.css" rel="stylesheet">
      <script type="text/javascript" src="js/tabulator.min.js"></script>

      <!-- Custom CSS -->
      <link rel="stylesheet" href="css/styles.css">

      <!-- <script>
        window.history.forward();
      </script>  -->

      <title><?php  echo TITLE  ?></title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand navbar-light fixed-top bg-light">
        <span class=navbar-brand><img src="img/AMG_logo.png" alt="propane tank" class="img-fluid navbar-brand-img mr-3">Amerigas Approvals</span>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>  <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <li class="nav-item active">
              <a class="nav-link" href="log.php">Logs<span class="sr-only">(current)</span></a>
          </li>  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </ul>
        <a class="ml-auto" href="logout.php"><button id="logoutButton" class="btn btn-link logout" type="button" name="button"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
      </nav>
    </header>
    <main role= "main">