<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();

$Admin           = $_SESSION["UserName"];

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
<title>Comments</title>
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
<i class="fa fa-sign-out" style="font-size:18px"></i>Logout</a></li>
</ul>
</div>
</div>
</nav>
<!-- NAVBAR END -->
<!-- HEADER -->
<header class="bg-dark text-white py-3">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3><i class="fas fa-comments" style="color:#27aae1;"></i> Manage Comments</h3>
</div>
</div>
</div>
</header>
<!-- HEADER END -->
<!-- Main Area Start -->
<section class="container py-2 mb-4">
<div class="row" style="min-height:30px;">
<div class="col-lg-12 table-responsive" style="min-height:400px;">
<?php
echo ErrorMessage();
echo SuccessMessage();
?>
<h4>Un-Approved Comments</h4>
<table class="table  table-striped table-hover text-light">
<thead class="thead-dark">
<tr>
<th>No. </th>
<th>Date&Time</th>
<th>Name</th>
<th>Comment</th>
<th>Post Author</th>
<th>Approve</th>
<th>Action</th>
<th>Details</th>
</tr>
</thead>
<?php
// WHERE category='$Category'
global $ConnectingDB;
$sql = "SELECT * FROM comments WHERE status='OFF' AND post_author='$Admin' ORDER BY id desc";
$Execute =$ConnectingDB->query($sql);
$SrNo = 0;
while ($DataRows=$Execute->fetch()) {
  $CommentId = $DataRows["id"];
  $DateTimeOfComment = $DataRows["datetime"];
  $CommenterName = $DataRows["name"];
  $CommentContent= $DataRows["comment"];
  $PostAuthor= $DataRows["post_author"];
  $CommentPostId = $DataRows["post_id"];
  $SrNo++;
  ?>
  <tbody>
  <tr>
  <td><?php echo htmlentities($SrNo); ?></td>
  <td><?php echo htmlentities($DateTimeOfComment); ?></td>
  <td><?php echo htmlentities($CommenterName); ?></td>
  <td><?php echo htmlentities($CommentContent); ?></td>
  <td><?php echo htmlentities($PostAuthor); ?></td>
  <td> <a href="ApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Approve</a>  </td>
  <td> <a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Delete</a>  </td>
  <td style="min-width:140px;"> <a class="btn btn-info btn-block text-info bg-dark" href="FullPost.php?id=<?php echo $CommentPostId; ?>&&author=<?php echo $Admin; ?>" target="_blank">Live Preview</a> </td>
  </tr>
  </tbody>
  <?php } ?>
  </table>
  <h4>Approved Comments</h4>
  <table class="table  table-striped table-hover text-light">
  <thead class="thead-dark">
  <tr>
  <th>No. </th>
  <th>Date&Time</th>
  <th>Name</th>
  <th>Comment</th>
  <th>Approved by</th>
  <th style="padding-left:55px;">Revert</th>
  <th>Action</th>
  <th>Details</th>
  </tr>
  </thead>
  <?php
  global $ConnectingDB;
  $sql = "SELECT * FROM comments WHERE status='ON' AND post_author='$Admin' ORDER BY id desc";
  $Execute =$ConnectingDB->query($sql);
  $SrNo = 0;
  while ($DataRows=$Execute->fetch()) {
    $CommentId         = $DataRows["id"];
    $DateTimeOfComment = $DataRows["datetime"];
    $CommenterName     = $DataRows["name"];
    $ApprovedBy        = $DataRows["approvedby"];
    $CommentContent    = $DataRows["comment"];
    $CommentPostId     = $DataRows["post_id"];
    $SrNo++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($SrNo); ?></td>
    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
    <td><?php echo htmlentities($CommenterName); ?></td>
    <td><?php echo htmlentities($CommentContent); ?></td>
    <td><?php echo htmlentities($ApprovedBy); ?></td>
    <td style="min-width:140px;"><a href="DisApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Dis-Approve</a>  </td>
    <td> <a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Delete</a>  </td>
    <td style="min-width:140px;"> <a class="btn btn-info btn-block text-info bg-dark"href="FullPost.php?id=<?php echo $CommentPostId; ?>&&author=<?php echo $Admin; ?>" target="_blank">Live Preview</a> </td>
    </tr>
    </tbody>
    <?php } ?>
    </table>
    
    <?php
    if(isset($_SESSION["UserName"]) && ($_SESSION["UserName"]=='attiqueurrehman12') ){
      $Admin = $_SESSION["UserName"];
      ?>
      <h4>All Comments</h4>
      <table class="table  table-striped table-hover text-light">
      <thead class="thead-dark">
      <tr>
      <th>No. </th>
      <th>Date&Time</th>
      <th>Name</th>
      <th>Comment</th>
      <th>Post Author</th>
      <th>Approve</th>
      <th>&nbsp Action</th>
      <th> &nbsp&nbsp&nbsp&nbsp&nbspDetails</th>
      </tr>
      </thead>
      <?php
      // WHERE category='$Category'
      global $ConnectingDB;
      $sql = "SELECT * FROM comments WHERE status='OFF' OR status='ON' ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $CommentId = $DataRows["id"];
        $DateTimeOfComment = $DataRows["datetime"];
        $CommenterName = $DataRows["name"];
        $CommentContent= $DataRows["comment"];
        $PostAuthor= $DataRows["post_author"];
        $CommentPostId = $DataRows["post_id"];
        $SrNo++;
        ?>
        <tbody>
        <tr>
        <td><?php echo htmlentities($SrNo); ?></td>
        <td><?php echo htmlentities($DateTimeOfComment); ?></td>
        <td><?php echo htmlentities($CommenterName); ?></td>
        <td><?php echo htmlentities($CommentContent); ?></td>
        <td><?php echo htmlentities($PostAuthor); ?></td>
        <td> <a href="ApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Approve</a>  </td>
        <td> <a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-info btn-block text-info bg-dark">Delete</a>  </td>
        <td style="min-width:140px;"> <a class="btn btn-info btn-block text-info bg-dark"href="FullPost.php?id=<?php echo $CommentPostId; ?>&&author=<?php echo $Admin; ?>" target="_blank">Live Preview</a> </td>
        </tr>
        </tbody>
        <?php } ?>
        </table>
        <?php }
        ?>
        </div>
        </div>
        </section>
        <!--  Main Area End -->
        
        
        
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
        