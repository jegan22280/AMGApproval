<?php

session_unset(); 
session_start();
header('Set-Cookie: ' . session_name() . '=' . session_id() . '; SameSite=None; Secure');

function errorMessage(){
  if (isset($_SESSION["errorMessage"])){
    $output = "<div class=\"alert alert-danger text-center mt-5\">";
    $output .= htmlentities($_SESSION["errorMessage"]);
    $output .= "</div>";
    $_SESSION["errorMessage"]=null;
    return $output;
  }
}

function successMessage(){
  if (isset($_SESSION["successMessage"])){
    $output = "<div class=\"alert alert-success text-center mt-5\">";
    $output .= htmlentities($_SESSION["successMessage"]);
    $output .= "</div>";
    $_SESSION["successMessage"]=null;
    return $output;
  }
}

  ?>
