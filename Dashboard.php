<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>


<?php
if (isset($_POST["ContactUsSubmit"])) {
  // echo "sssc";
  $Email = $_POST["email"];
  $Message = $_POST["message"];
  if (empty($Email)||empty($Message)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("ContactUS.php");
  }else {
    
    global $ConnectingDB;
    $sql = "INSERT INTO contactus(email,message)";
    $sql .= "VALUES(:emailx,:messagex)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':emailx',$Email);
    $stmt->bindValue(':messagex',$Message);
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="Message Sent Sucessfully to team";
      // Redirect_to("ContactUs.php");
    }else {
      $_SESSION["ErrorMessage"]= "Sending failed...";
      // Redirect_to("ContactUs.php");
    }
    // $sql="INSERT INTO `contactus`(`id`, `email`, `message`) VALUES ('','$Email','$Message')";
    // $stmt = $ConnectingDB->prepare($sql);
    // $Execute=$stmt->execute();
    
    $to_email = "attiqueurrehman12@gmail.com";
    $subject = "CMS ContactUS Query";
    $body = $Message;
    $headers = "From: $Email";
    
    if (mail($to_email, $subject, $body, $headers)) {
      $_SESSION['SuccessMessage']="Message Sent Sucessfully";
      Redirect_to("ContactUs.php");
    } else {
      $_SESSION['ErrorMessage']="Sending failed...";
      Redirect_to("ContactUs.php");
    }
    
  }
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
<title>Dashboard</title>
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
<div class="container">
<div class="row">
<div class="col-md-12">
<h3><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard</h3>
</div>
<div class="col-lg-3 mb-2">
<a href="AddNewPost.php" class="btn btn-info btn-block text-info bg-dark">
<i class="fas fa-edit"></i> Add New Post
</a>
</div>
<div class="col-lg-3 mb-2">
<a href="Categories.php" class="btn btn-info btn-block text-info bg-dark">
<i class="fas fa-folder-plus"></i> Add New Category
</a>
</div>
<div class="col-lg-3 mb-2 ">
<a href="Admins.php" class="btn btn-info btn-block text-info bg-dark">
<i class="fas fa-user-plus"></i> Admin Settings
</a>
</div>
<div class="col-lg-3 mb-2">
<a href="Comments.php" class="btn btn-info btn-block text-info bg-dark">
<i class="fas fa-check"></i> Approve Comments
</a>
</div>

</div>
</div>
</header>
<!-- HEADER END -->

<!-- Main Area -->
<section class="container py-2 mb-4">
<div class="row">
<!-- Left Side Area Start -->
<div class="col-lg-2 d-none d-md-block">
<div class="card text-center bg-dark text-light mb-3">
<div class="card-body">
<h1 class="lead">Posts</h1>
<h4 class="display-5">
<i class="fab fa-readme"></i>
<?php TotalPosts(); ?>
</h4>
</div>
</div>

<div class="card text-center bg-dark text-light mb-3">
<div class="card-body">
<h1 class="lead">Categories</h1>
<h4 class="display-5">
<i class="fas fa-folder"></i>
<?php TotalCategories(); ?>
</h4>
</div>
</div>

<div class="card text-center bg-dark text-light mb-3">
<div class="card-body">
<h1 class="lead">Admins</h1>
<h4 class="display-5">
<i class="fas fa-users"></i>
<?php TotalAdmins(); ?>
</h4>
</div>
</div>
<div class="card text-center bg-dark text-light mb-3">
<div class="card-body">
<h1 class="lead">Comments</h1>
<h4 class="display-5">
<i class="fas fa-comments"></i>
<?php TotalComments(); ?>
</h4>
</div>
</div>

</div>
<!-- Left Side Area End -->
<!-- Right Side Area Start -->
<div class="col-lg-10 table-responsive">
<?php
echo ErrorMessage();
echo SuccessMessage();
?>
<h4 style="color:white;">Top Posts</h4>
<table class="table  table-striped table-hover text-light">
<thead class="thead-dark">
<tr>
<th>No.</th>
<th>Title</th>
<th>Date&Time</th>
<th>Author</th>
<th>Comments</th>
<th>Details</th>
</tr>
</thead>
<?php
$SrNo = 0;
global $ConnectingDB;
$sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
$stmt=$ConnectingDB->query($sql);
while ($DataRows=$stmt->fetch()) {
  $PostId = $DataRows["id"];
  $DateTime = $DataRows["datetime"];
  $Author  = $DataRows["author"];
  $Title = $DataRows["title"];
  $SrNo++;
  ?>
  <tbody>
  <tr>
  <td><?php echo $SrNo; ?></td>
  <td><?php echo $Title; ?></td>
  <td><?php echo $DateTime; ?></td>
  <td><?php echo $Author; ?></td>
  <td>
  <?php $Total = ApproveCommentsAccordingtoPost($PostId);
  if ($Total>0) {
    ?>
    <span class="badge badge-success">
    <?php
    echo $Total; ?>
    </span>
    <?php  }   ?>
    <?php $Total = DisApproveCommentsAccordingtoPost($PostId);
    if ($Total>0) {  ?>
      <span class="badge badge-danger">
      <?php
      echo $Total; ?>
      </span>
      <?php  }  ?>
      </td>
      <td> <a class="btn btn-info btn-block text-info bg-dark"target="_blank" href="FullPost.php?id=<?php echo $PostId; ?>&&author=<?php echo $Author; ?>">
      <span class="">Preview</span>
      </a>
      </td>
      </tr>
      </tbody>
      <?php } ?>
      
      </table>
      
      </div>
      <!-- Right Side Area End -->
      
      
      </div>
      </section>
      <!-- Main Area End -->
      
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
      