<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- Fetching Existing Data -->
<?php
$SearchQueryParameter = $_GET["username"];
global   $ConnectingDB;
$sql    =  "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt   =  $ConnectingDB->prepare($sql);
$stmt   -> bindValue(':userName', $SearchQueryParameter);
$stmt   -> execute();
$Result = $stmt->rowcount();
if( $Result==1 ){
	while ( $DataRows   = $stmt->fetch() ) {
		$ExistingName     = $DataRows["aname"];
		$ExistingBio      = $DataRows["abio"];
		$ExistingImage    = $DataRows["aimage"];
		$ExistingHeadline = $DataRows["aheadline"];
	}
}else {
	$_SESSION["ErrorMessage"]="Bad Request !!";
	Redirect_to("Blog.php?page=1");
}


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

<title>Profile</title>
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-1">
<div class="container">
<a href="index.php?page=1" class="navbar-brand">CMSsite</a>
<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarcollapseCMS">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a href="Home.php?page=1" class="nav-link">Home</a>
</li>
<li class="nav-item">
<a href="Blog.php #AboutUs" class="nav-link">About Us</a>
</li>
<li class="nav-item">
<a href="Blog.php?page=1" class="nav-link">Blog</a>
</li>
<li class="nav-item">
<a href="ContactUs.php" class="nav-link">Contact Us</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">Features</a>
</li>
</ul>
<ul class="navbar-nav ml-auto">
<form class="form-inline d-none d-sm-block" action="Blog.php">
<div class="form-group">
<input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
<button  class="btn btn-info text-info bg-dark " name="SearchButton"><i class="fa fa-search"></i></button>
<a type="button" href="login.php" class="btn btn-info text-info bg-dark ml-4" name="button">Sign in</a>

</div>
</form>
</ul>
</div>
</div>
</nav>
<!-- NAVBAR END -->
<!-- HEADER -->
<header class="bg-dark text-white py-3">
<div class="container">
<div class="row">
<div class="col-md-6">
<h3><i class="fas fa-user text-info mr-2" style="color:#27aae1;"></i><?php echo $ExistingName; ?></h3>
<h4><?php echo $ExistingHeadline; ?></h4>
</div>
</div>
</div>
</header>
<!-- HEADER END -->
<section class="container py-2 mb-4">
<div class="row">
<div class="col-md-3">
<img src="Images/<?php echo $ExistingImage; ?>" style="width:200px; height:210px;" class="d-block img-fluid mb-3 rounded-circle" alt="">
</div>
<div class="col-md-9" style="min-height:400px;">
<div class="card">
<div class="card-body">
<p class="lead"> <?php echo $ExistingBio; ?> </p>
</div>

</div>

</div>

</div>

</section>


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
