<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
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
<title>Posts</title>
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
<h3><i class="fas fa-blog" style="color:#27aae1;"></i> Blog Posts</h3>
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
<div class="col-lg-3 mb-2">
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
<div class="col-lg-12 ">
<?php
echo ErrorMessage();
echo SuccessMessage();
?>
<table class="table  table-striped table-hover text-light table-responsive">
<thead class="thead-dark">
<tr>
<th>#</th>
<th>Title</th>
<th>Category</th>
<th>Date&Time</th>
<th>Author</th>
<th>Banner</th>
<th>Comments</th>
<th>Action</th>
<th>Live Preview</th>
</tr>
</thead>
<?php
global $ConnectingDB;
if(isset($_SESSION["UserName"])){
  $Admin = $_SESSION["UserName"];
  if($Admin=='attiqueurrehman12'){
    $sql  = "SELECT * FROM posts ORDER BY id desc";
    $stmt = $ConnectingDB->query($sql);
    $Sr = 0;
    while ($DataRows = $stmt->fetch()) {
      $Id        = $DataRows["id"];
      $DateTime  = $DataRows["datetime"];
      $PostTitle = $DataRows["title"];
      $Category  = $DataRows["category"];
      $Admin     = $DataRows["author"];
      $Image     = $DataRows["image"];
      $PostText  = $DataRows["post"];
      $Sr++;
      ?>
      <tbody>
      <tr>
      <td>
      <?php echo $Sr; ?>
      </td>
      <td>
      <?php
      if(strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
      echo $PostTitle;
      ?>
      </td>
      <td>
      <?php
      if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
      echo $Category ;
      ?>
      </td>
      <td>
      <?php
      if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
      echo $DateTime ;
      ?>
      </td>
      <td>
      <?php
      if(strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
      echo $Admin ;
      ?>
      </td>
      <td><img src="Uploads/<?php echo $Image ; ?>" width="170px;" height="50px"</td>
      <td>
      <?php $Total = ApproveCommentsAccordingtoPost($Id);
      if ($Total>0) {
        ?>
        <span class="badge badge-success">
        <?php
        echo $Total; ?>
        </span>
        <?php  }  ?>
        <?php $Total = DisApproveCommentsAccordingtoPost($Id);
        if ($Total>0) {
          ?>
          <span class="badge badge-danger">
          <?php
          echo $Total;  ?>
          </span>
          <?php  }    ?>
          </td>
          <td>
          <a href="EditPost.php?id=<?php echo $Id; ?>"class="btn btn-info  text-info bg-dark"><span >Edit</span></a>
          <a href="DeletePost.php?id=<?php echo $Id; ?>"class="btn btn-info  text-info bg-dark"><span >Delete</span></a>
          </td>
          <td>
          <a href="FullPost.php?id=<?php echo $Id; ?>&&author=<?php echo $Admin; ?>" class="btn btn-info  text-info bg-dark" target="_blank"><span>Live Preview</span></a>
          </td>
          </tr>
          </tbody>
          <?php }}
          
          else{
            
            
            $sql  = "SELECT * FROM posts WHERE author='$Admin' ORDER BY id desc";
            $stmt = $ConnectingDB->query($sql);
            $Sr = 0;
            while ($DataRows = $stmt->fetch()) {
              $Id        = $DataRows["id"];
              $DateTime  = $DataRows["datetime"];
              $PostTitle = $DataRows["title"];
              $Category  = $DataRows["category"];
              $Admin     = $DataRows["author"];
              $Image     = $DataRows["image"];
              $PostText  = $DataRows["post"];
              $Sr++;
              ?>
              <tbody>
              <tr>
              <td>
              <?php echo $Sr; ?>
              </td>
              <td>
              <?php
              if(strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
              echo $PostTitle;
              ?>
              </td>
              <td>
              <?php
              if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
              echo $Category ;
              ?>
              </td>
              <td>
              <?php
              if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
              echo $DateTime ;
              ?>
              </td>
              <td>
              <?php
              if(strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
              echo $Admin ;
              ?>
              </td>
              <td><img src="Uploads/<?php echo $Image ; ?>" width="170px;" height="50px"</td>
              <td>
              <?php $Total = ApproveCommentsAccordingtoPost($Id);
              if ($Total>0) {
                ?>
                <span class="badge badge-success">
                <?php
                echo $Total; ?>
                </span>
                <?php  }  ?>
                <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                if ($Total>0) {
                  ?>
                  <span class="badge badge-danger">
                  <?php
                  echo $Total;  ?>
                  </span>
                  <?php  }    ?>
                  </td>
                  <td>
                  <a href="EditPost.php?id=<?php echo $Id; ?>" class="btn btn-info text-info bg-dark"><span class="btn btn-warning">Edit</span></a>
                  <a href="DeletePost.php?id=<?php echo $Id; ?>" class="btn btn-info text-info bg-dark"><span >Delete</span></a>
                  </td>
                  <td>
                  <a href="FullPost.php?id=<?php echo $Id; ?>&&author=<?php echo $Admin; ?>" class="btn btn-info  text-info bg-dark" target="_blank"><span>Live Preview</span></a>
                  </td>
                  </tr>
                  </tbody>
                  <?php }
                  
                  
                  
                  
                  
                  
                }
                
              } ?>   <!--  Ending of While loop -->
              </table>
              </div>
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
              