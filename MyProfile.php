<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
// Fetching the existing Admin Data Start
$AdminId = $_SESSION["UserId"];
global $ConnectingDB;
$sql  = "SELECT * FROM admins WHERE id='$AdminId'";
$stmt =$ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $ExistingName     = $DataRows['aname'];
  $ExistingUsername = $DataRows['username'];
  $ExistingHeadline = $DataRows['aheadline'];
  $ExistingBio      = $DataRows['abio'];
  $ExistingImage    = $DataRows['aimage'];
}
// Fetching the existing Admin Data End
if(isset($_POST["Submit"])){
  $AName     = $_POST["Name"];
  $AHeadline = $_POST["Headline"];
  $ABio      = $_POST["Bio"];
  $Image     = $_FILES["Image"]["name"];
  $Target    = "Images/".basename($_FILES["Image"]["name"]);
  if (strlen($AHeadline)>30) {
    $_SESSION["ErrorMessage"] = "Headline Should be less than 30 characters";
    Redirect_to("MyProfile.php");
  }elseif (strlen($ABio)>500) {
    $_SESSION["ErrorMessage"] = "Bio should be less than than 500 characters";
    Redirect_to("MyProfile.php");
  }else{
    // Query to Update Admin Data in DB When everything is fine
    global $ConnectingDB;
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE admins
      SET aname='$AName', aheadline='$AHeadline', abio='$ABio', aimage='$Image'
      WHERE id='$AdminId'";
    }else {
      $sql = "UPDATE admins
      SET aname='$AName', aheadline='$AHeadline', abio='$ABio'
      WHERE id='$AdminId'";
    }
    $Execute= $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
      $_SESSION["SuccessMessage"]="Details Updated Successfully";
      Redirect_to("MyProfile.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("MyProfile.php");
    }
  }
} //Ending of Submit Button If-Condition
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="Css/Styles.css">
<link rel="stylesheet" href="Css/NavSelect.css">

<title>My Profile</title>
</head>
<body style="  ">
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-1 mb-1">
<div class="container">
<a href="index.php?page=1" class="navbar-brand">CMSsite</a>
<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarcollapseCMS">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-info"></i> My Profile</a>
</li>
<li class="nav-item">
<a href="Dashboard.php" class="nav-link">Dashboard</a>
</li>
<li class="nav-item">
<a href="Posts.php" class="nav-link">Posts</a>
</li>
<li class="nav-item">
<a href="Categories.php" class="nav-link">Categories</a>
</li>
<li class="nav-item">
<a href="Admins.php" class="nav-link">Admins</a>
</li>
<li class="nav-item">
<a href="Comments.php" class="nav-link">Comments</a>
</li>
<li class="nav-item">
<a href="Blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
</li>
</ul>
<ul class="navbar-nav ml-auto">
<li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
<i class="fa fa-sign-out" style="font-size:18px"></i> Logout</a></li>
</ul>
</div>
</div>
</nav>
<!-- NAVBAR END -->
<!-- HEADER -->
<header class="bg-dark text-white py-2">
<div class="container bg-dark ">
<div class="row bg-dark" >
<div class="col-md-12 bg-dark">
<h4><i class="fas fa-user text-info mr-2"></i>@<?php echo $ExistingUsername; ?></h4>
<sup style="" class="ml-5" ><?php echo $ExistingHeadline; ?></sup>
</div>
</div>
</div>
</header>
<!-- HEADER END -->

<!-- Main Area -->
<section class="container py-2 mb-4">
<div class="row">
<!-- Left Area -->
<div class="col-md-3">
<div class="card bg-dark">
<div class="card-header bg-dark text-light">
<h3 style="text-align:center;"> <?php echo $ExistingName; ?></h3>
</div>
<div style="text-align:center;" class="card-body">
<img src="Images/<?php echo $ExistingImage; ?>" style="width:200px; height:210px;" class="block img-fluid mb-3" alt="">
<div>
<?php echo $ExistingBio; ?>  </div>

</div>

</div>

</div>
<!-- Righ Area -->
<div class="col-md-9" style="min-height:400px;">
<?php
echo ErrorMessage();
//  echo SuccessMessage();
?>
<form class="" action="MyProfile.php" method="post" enctype="multipart/form-data">
<div class="card bg-dark text-light">
<div class="card-header bg-dark text-light">
<h4>Edit Profile</h4>
<?php
echo SuccessMessage();
?>

</div>
<div class="card-body">
<div class="form-group">
<input class="form-control" type="text" name="Name" id="title" placeholder="Your name" value="<?php echo $ExistingName; ?>">
</div>
<div class="form-group">
<input class="form-control" type="text" id="title" placeholder="Headline" name="Headline" value="<?php echo $ExistingHeadline; ?>">
<small class="text-muted"> Add a professional headline like, 'Engineer' at XYZ </small>
<span class="text-danger">Not more than 30 characters</span>
</div>
<div class="form-group">
<textarea  placeholder="Bio" class="form-control" id="Post" name="Bio" rows="4" cols="50"><?php echo $ExistingBio; ?></textarea>
</div>

<div class="form-group">
<div class="custom-file">
<input class="custom-file-input mb-1" type="File" name="Image" id="imageSelect" value="">
<img src="Images/<?php echo $ExistingImage; ?>" style="width:80px; height:40px; border-radius:5px;" class="block img-fluid mb-3" alt="">
<label for="imageSelect" class="custom-file-label">Select Image </label>
</div>
</div>
<div class="row">
<div class="col-lg-6 mb-2">
<a href="Dashboard.php" class="btn btn-info btn-block text-info bg-dark"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
</div>
<div class="col-lg-6 mb-2">
<button type="submit" name="Submit" class="btn btn-info btn-block text-info bg-dark">
<i class="fas fa-check"></i> Update
</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>

</section>


<!-- End Main Area -->

<!-- FOOTER -->
<footer class="footer-distributed bg-dark text-white ">
<div class="footer-left">
<h3>CMS<span>site</span></h3>
<p class="footer-links">
<a href="#">Home</a>
·
<a href="#">Blog</a>
·
<a href="#">Pricing</a>
·
<a href="#">About</a>
·
<a href="#">Faq</a>
·
<a href="#">Contact</a>
</p>
<p id="aboutUs" class="">About Us </p>
<p style="margin-top:-12px;" class="small text-info lead">CMSsite is a blog where you can learn</p>
<p class="lead">Copyright &copy; <span id="year"></span> All Rights Reserved.</p>
<div class="footer-icons">
<a href="https://www.facebook.com/malikattique2"><i class="fa fa-facebook-square"></i></a>
<a href="https://www.instagram.com/malikkattik/"><i class="fa fa-instagram"></i></a>
<a href="https://www.linkedin.com/in/attiqueurrehman12/"><i class="fa fa-linkedin"></i></a>
<a href="https://github.com/malikattique1/"><i class="fa fa-github"></i></a>
</div>
</div>
<div class="footer-right">
<?php
echo ContactusPlaceMessage();

?>
<p>Contact Us</p>
<form action="Blog.php" method="post" id="contactusform">
<input type="email" name="email" placeholder="Email">
<textarea type="text" name="message" placeholder="Message"></textarea>
<button class="btn btn-sm btn-info text-light bg-info" type="submit" name="ContactUsSubmit">Send</button>
</form>
</div>
</footer>
<!-- FOOTER END-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
$('#year').text(new Date().getFullYear());
</script>
<script type="text/javascript" src="js/NavSelect.js"></script>



</body>
</html>
