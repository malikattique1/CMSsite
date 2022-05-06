<?php
session_start();

// $_SESSION["testing"]="hey bro";

function ErrorMessage(){
  if(isset($_SESSION["ErrorMessage"])){
    $Output = "<div class=\"alert alert-danger\">" ;
    $Output .= htmlentities($_SESSION["ErrorMessage"]);
    $Output .= "</div>";
    $_SESSION["ErrorMessage"] = null;
    return $Output;
  }
}
function SuccessMessage(){
  if(isset($_SESSION["SuccessMessage"])){
    $Output = "<div style='' class=\"alert alert-success\">" ;
    $Output .= htmlentities($_SESSION["SuccessMessage"]);
    $Output .= "</div>";
    $_SESSION["SuccessMessage"] = null;
    return $Output;
  }
}


function ContactusPlaceMessage(){
  if(isset($_SESSION["ContactusPlaceMessage"])){
    $Output = "<div style='' class=\"alert alert-warning\">" ;
    $Output .= htmlentities($_SESSION["ContactusPlaceMessage"]);
    $Output .= "</div>";
    
    $_SESSION["ContactusPlaceMessage"] = null;
    return $Output;
  }
}




 ?>
