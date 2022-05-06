<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); 
// $_SESSION["testings"]="nice";
// $_SESSION["testings"]=null;
// session_destroy();
?>
<?php       
if (isset($_POST["ContactUsSubmit"])) {
  $Email = $_POST["email"];
  $Message = $_POST["message"];
  if (empty($Email)||empty($Message)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    $_SESSION["ContactusPlaceMessage"]= "All fields must be filled";
    Redirect_to("Blog.php?page=1#contactusform");
  }
  else {
    
    global $ConnectingDB;
    $sql = "INSERT INTO contactus(email,message)";
    $sql .= "VALUES(:emailx,:messagex)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':emailx',$Email);
    $stmt->bindValue(':messagex',$Message);
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="Message Sent Sucessfully to team";
      Redirect_to("Blog.php");
    }else {
      $_SESSION["ErrorMessage"]= "Sending failed...";
      Redirect_to("Blog.php");
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
      Redirect_to("Blog.php");
    } else {
      $_SESSION['ErrorMessage']="Sending failed...";
      Redirect_to("Blog.php");
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

<title>Blog Page</title>
<style media="screen">

.heading{
  font-family: Bitter,Georgia,"Times New Roman",Times,serif;
  font-weight: bold;
  color: #005E90;
}
.heading:hover{
  color: #0090DB;
}


</style>
</head>
<body>
<!-- NAVBAR -->

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-1">
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
<input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="<?php /*echo ($_SESSION["testings"]);*/?>">
<button  class="btn btn-info text-info bg-dark " name="SearchButton"><i class="fa fa-search"></i></button>
<a type="button" href="Login.php" class="btn btn-info text-info bg-dark ml-4" name="button">Sign in</a>

<?php
// session_start();
// $_SESSION["testingss"]="gghhhh";
// session_destroy();
?>
</div>
</form>
</ul>
</div>
</div>
</nav>
<!-- NAVBAR END -->
<!-- HEADER -->
<div class="container">
<div class="row mt-4">

<!-- Main Area Start-->
<div class="col-sm-8 ">
<h2>Responsive CMS Blogs</h2>
<h2 class="lead">The complete blog using PHP</h2>
<?php
echo ErrorMessage();
echo SuccessMessage();

?>
<?php
global $ConnectingDB;
// SQL query when Searh button is active
if(isset($_GET["SearchButton"])){
  $Search = $_GET["Search"];
  $sql = "SELECT * FROM posts
  WHERE datetime LIKE :search
  OR title LIKE :search
  OR category LIKE :search
  OR post LIKE :search";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':search','%'.$Search.'%');
  $stmt->execute();
}// Query When Pagination is Active i.e Blog.php?page=1
elseif (isset($_GET["page"])) {
  $Page = $_GET["page"];
  if($Page==0||$Page<1){
    $ShowPostFrom=0;
  }else{
    $ShowPostFrom=($Page*5)-5;
  }
  $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
  $stmt=$ConnectingDB->query($sql);
}
// Query When Category is active in URL Tab
elseif (isset($_GET["category"])) {
  $Category = $_GET["category"];
  $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
  $stmt=$ConnectingDB->query($sql);
}

// The default SQL query
else{
  $sql  = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
  $stmt =$ConnectingDB->query($sql);
}
//  echo "<pre>";
// print_r($stmt->fetch());
// echo"</pre>";
while ($DataRows = $stmt->fetch()) {
  $PostId          = $DataRows["id"];
  $DateTime        = $DataRows["datetime"];
  $PostTitle       = $DataRows["title"];
  $Category        = $DataRows["category"];
  $Author           = $DataRows["author"];
  $Image           = $DataRows["image"];
  $PostDescription = $DataRows["post"];
  
  ?>
  <div class="card">
  <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
  <div class="card-body">
  <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
  <small class="text-muted">Category: <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Author); ?>"> <?php echo htmlentities($Author); ?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>
  <span style="float:right;" class="badge badge-dark text-light">Comments:
  <?php echo ApproveCommentsAccordingtoPost($PostId);?>
  </span>
  <hr>
  <p class="card-text">
  <?php if (strlen($PostDescription)>150) { $PostDescription = substr($PostDescription,0,150)."...";} echo htmlentities($PostDescription); ?></p>
  <!-- /////////////////////////////**********@@@@@@@@@@@@@@@****************** */ -->
  <a href="FullPost.php?id=<?php echo $PostId; ?>&&author=<?php echo $Author; ?>" style="float:right;">
  <span class="btn btn-info btn-block text-info bg-dark">Read More &rang;&rang; </span>
  </a>
  </div>
  </div>
  <br>
  <?php   } ?>
  <!-- Pagination start -->
  
  <nav >
  <div class="pagination pagination-md">
  <!-- Creating Backward Button -->
  <?php if( isset($Page) ) {
    if ( $Page>1 ) {?>
      <a  href="Blog.php?page=<?php  echo $Page-1; ?>" class="page-link bg-dark">&laquo;Back</a>
      <?php } }?>
      <?php
      global $ConnectingDB;
      $sql           = "SELECT COUNT(*) FROM posts";
      $stmt          = $ConnectingDB->query($sql);
      $RowPagination = $stmt->fetch();
      $TotalPosts    = array_shift($RowPagination);
      // echo $TotalPosts."<br>";
      $PostPagination=$TotalPosts/5;
      $PostPagination=ceil($PostPagination);
      // echo $PostPagination;
      for ($i=1; $i <=$PostPagination ; $i++) {
        if( isset($Page) ){
          if ($i == $Page) {  ?>
            <a  href="Blog.php?page=<?php  echo $i; ?>" class="page-link active bg-info text-dark"><?php  echo $i; ?></a>
            <?php
          }else {
            ?> 
            <a  href="Blog.php?page=<?php  echo $i; ?>" class="page-link bg-dark"><?php  echo $i; ?></a>
            <?php  }
          }
        } ?>
        <!-- Creating Forward Button -->
        <?php if ( isset($Page) && !empty($Page) ) {
          if ($Page+1 <= $PostPagination) {?>
            <a  href="Blog.php?page=<?php  echo $Page+1; ?>" class="page-link bg-dark">Next&raquo;</a>
            <?php } }?>
            </div>
            </nav>
            <!-- Pagination end -->
            
            </div>
            <!-- Main Area End-->
            
            <!-- Side Area Start -->
            <div id="sidebar" class="col-sm-4">
            <div class="card mt-4 ">
            <div class="card-body">
            <img src="images/startblog.png" class="d-block img-fluid mb-3" alt="">
            <div class="text-center">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            </div>
            </div>
            <br>
            <div class="card ">
            <div class="card-header bg-dark text-light">
            <h2 class="lead">Sign Up !</h2>
            </div>
            <div class="card-body">
            <a type="button" href="Admins.php" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</a>
            <a type="button" href="login.php" class="btn btn-primary btn-block text-center text-white mb-4" name="button">Login</a>
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
            <div class="input-group-append">
            <button  style="z-index:0;" class="z-indez-n2 btn btn-info text-info bg-dark " name="button">Subscribe Now</button>
            </div>
            </div>
            </div>
            </div>
            <br>
            <div class="card">
            <div class="card-header bg-dark text-light">
            <h2 class="lead">Categories</h2>
            </div>
            <div class="card-body">
            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM category ORDER BY id desc";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
              $CategoryId = $DataRows["id"];
              $CategoryName=$DataRows["title"];
              ?>
              <a href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
              <?php } ?>
              </div>
              </div>
              <br>
              <div style="z-index:0; margin-bottom:68px;" class="card sticky-top">
              <div class="card-header bg-dark text-white">
              <h2 class="lead"> Recent Posts</h2>
              </div>
              <div class="card-body">
              <?php
              global $ConnectingDB;
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= $ConnectingDB->query($sql);
              while ($DataRows=$stmt->fetch()) {
                $Id     = $DataRows['id'];
                $Title  = $DataRows['title'];
                $DateTime = $DataRows['datetime'];
                $Image = $DataRows['image'];
                $Author = $DataRows['author'];
                ?>
                <div class="media">
                <img src="Uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="FullPost.php?id=<?php echo $Id ?>&&author=<?php echo $Author; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
                </div>
                <hr>
                <?php } ?>
                </div>
                </div>
                
                </div>
                <!-- Side Area End -->
                
                
                </div>
                
                </div>
                
                <!-- HEADER END -->
                <br>
                
                
                
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
                <?php //require_once("footer.php");?> 
                