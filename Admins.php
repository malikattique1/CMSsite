<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
// $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];

// if(isset($_SESSION["UserName"])){
  // Confirm_Login();
  // }
  
  
  
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
  
  
  
  
  
  if(isset($_SESSION["UserName"])){
    $Username = $_SESSION["UserName"];
    $Name = $_SESSION["AdminName"];
  }
  
  ?>
  <?php
  
  if(isset($_SESSION["UserName"]) && ($_SESSION["UserName"]=='attiqueurrehman12') ){
    $Admin = $_SESSION["UserName"];
    
    if(isset($_POST["Submit"])){
      $UserName        = $_POST["Username"];
      $Name            = $_POST["Name"];
      $Password        = $_POST["Password"];
      $ConfirmPassword = $_POST["ConfirmPassword"];
      $Admin           = $_SESSION["UserName"];
      date_default_timezone_set("Asia/Karachi");
      $CurrentTime=time();
      $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
      
      if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("Admins.php");
      }elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
        Redirect_to("Admins.php");
      }elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
        Redirect_to("Admins.php");
      }elseif (CheckUserNameExistsOrNot($UserName)) {
        $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
        Redirect_to("Admins.php");
      }else{
        // Query to insert new admin in DB When everything is fine
        global $ConnectingDB;
        $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
        $stmt->bindValue(':aName',$Name);
        $stmt->bindValue(':adminName',$Admin);
        $Execute=$stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]="New Admin with the name of ".$Name." added Successfully";
          Redirect_to("Admins.php");
        }else {
          $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
          Redirect_to("Admins.php");
        }
      }
    } //Ending of Submit Button If-Condition
    
    
    
    
  }
  
  
  elseif(isset($_SESSION["UserName"]) && ($_SESSION["UserName"]!='attiqueurrehman12') ){
    $Admin = $_SESSION["UserName"];
    
    if(isset($_POST["Submit"])){
      $UserName        = $_POST["Username"];
      $Name            = $_POST["Name"];
      $Password        = $_POST["Password"];
      $ConfirmPassword = $_POST["ConfirmPassword"];
      $Admin           = $_SESSION["UserName"];
      date_default_timezone_set("Asia/Karachi");
      $CurrentTime=time();
      $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
      
      if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("Admins.php");
      }elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
        Redirect_to("Admins.php");
      }elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
        Redirect_to("Admins.php");
      } else{
        // Query to update users passwords/usernames in DB When everything is fine
        // update posts set datetime=replace(datetime,2019,2022);
        global $ConnectingDB;
        $sql = "UPDATE admins
        SET datetime='$DateTime', username='$UserName', password='$Password', aname='$Name', addedby='$Admin'
        WHERE username='$Admin'";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
        $stmt->bindValue(':aName',$Name);
        $stmt->bindValue(':adminName',$Admin);
        $Execute=$stmt->execute();
        if($Execute){
          //////@@@@@@@@@@@@@@@@@@@@@@@@////SESSION UPDATING//@@@@@@@@@@@@@@@@@@///////////@@@@@@@@
          $_SESSION["UserName"]=null;
          $_SESSION["AdminName"]=null;
          $_SESSION["UserName"]=$UserName;
          $_SESSION["AdminName"]=$Name;
          $_SESSION["SuccessMessage"]="Updated Succesfully!";
          // Redirect_to("Login.php");
          Redirect_to("Admins.php");
        }else {
          $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
          Redirect_to("Admins.php");
        }
      }
    } //Ending of Submit Button If-Condition
  }
  
  
  
  
  
  
  
  else{
    
    if(isset($_POST["Submit"])){
      $UserName        = $_POST["Username"];
      $Name            = $_POST["Name"];
      $Password        = $_POST["Password"];
      $ConfirmPassword = $_POST["ConfirmPassword"];
      date_default_timezone_set("Asia/Karachi");
      $CurrentTime=time();
      $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
      
      if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("Admins.php");
      }elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
        Redirect_to("Admins.php");
      }elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
        Redirect_to("Admins.php");
      }elseif (CheckUserNameExistsOrNot($UserName)) {
        $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
        Redirect_to("Admins.php");
      }else{
        // Query to insert new admin in DB When everything is fine
        global $ConnectingDB;
        $sql = "INSERT INTO admins(datetime,username,password,aname)";
        $sql .= "VALUES(:dateTime,:userName,:password,:aName)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
        $stmt->bindValue(':aName',$Name);
        $Execute=$stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]="New Admin with the name of ".$Name." added Successfully";
          Redirect_to("Login.php");
        }else {
          $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
          Redirect_to("Admins.php");
        }
      }
    } //Ending of Submit Button If-Condition
    
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
  
  <title>Admin Page</title>
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
  <header class="bg-dark text-white py-3">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <h3><i class="fas fa-user" style="color:#27aae1;"></i> Admins</h3>
  </div>
  </div>
  </div>
  </header>
  <!-- HEADER END -->
  
  <!-- Main Area -->
  <!-- <section class="container py-2 mb-4">
  <div class="row">
  <div class="offset-lg-1 col-lg-10" style="min-height:400px;"> -->
  <section class="container py-2 mb-4">
  <div class="row">
  <div class="offset-lg-1 col-lg-10">
  <?php
  echo ErrorMessage();
  echo SuccessMessage();
  ?>
  <form class="" action="Admins.php" method="post">
  <div class="card bg-dark text-light mb-3">
  <div class="card-header">
  <h4>Admin Signup !</h4>
  </div>
  <div class="card-body bg-dark">
  <div class="form-group ">
  <label for="username"> <span class="FieldInfo"> Username: </span></label>
  <input class="form-control text-light" type="text" name="Username" id="username"  value="<?php if(isset($_SESSION["UserName"])){ echo $UserName = $_SESSION["UserName"];}?>">
  </div>
  <div class="form-group">
  <label for="Name"> <span class="FieldInfo"> Name: </span></label>
  <input class="form-control text-light" type="text" name="Name" id="Name" value="<?php if(isset($_SESSION["UserName"])){ echo $_SESSION["AdminName"];}?>">
  <small class="text-muted">*Optional</small>
  </div>
  <div class="form-group">
  <label for="Password"> <span class="FieldInfo"> Password: </span></label>
  <input class="form-control text-light" type="password" name="Password" id="Password" value="">
  </div>
  <div class="form-group">
  <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password:</span></label>
  <input class="form-control text-light" type="password" name="ConfirmPassword" id="ConfirmPassword"  value="">
  </div>
  <div class="row">
  <div class="col-lg-6 mb-2">
  <a href="Dashboard.php" class="btn btn-info btn-block text-info bg-dark"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
  </div>
  <div class="col-lg-6 mb-2">
  <button type="submit" name="Submit" class="btn btn-info btn-block text-info bg-dark">
  <i class="fas fa-check"></i> Submit
  </button>
  </div>
  </div>
  </div>
  </div>
  </form>
  </div>
  </div>
  </section>
  
  
  <?php
  if(isset($_SESSION["UserName"])){
    $Admin = $_SESSION["UserName"];
    if($Admin=='attiqueurrehman12'){
      ?>
      <section class="container py-2 mb-4">
      <h4>Existing Admins</h4>
      <div class="row">
      <div class=" col-lg-12 table-responsive">
      <table class="table  table-striped table-hover text-light">
      <thead class="thead-dark">
      <tr>
      <th>No. </th>
      <th>Date&Time</th>
      <th>Username</th>
      <th>Admin Name</th>
      <th>Added by</th>
      <th>Action</th>
      </tr>
      </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM admins ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $AdminId = $DataRows["id"];
        $DateTime = $DataRows["datetime"];
        $AdminUsername = $DataRows["username"];
        $AdminName= $DataRows["aname"];
        $AddedBy = $DataRows["addedby"];
        $SrNo++;
        ?>
        <tbody>
        <tr>
        <td><?php echo htmlentities($SrNo); ?></td>
        <td><?php echo htmlentities($DateTime); ?></td>
        <td><?php echo htmlentities($AdminUsername); ?></td>
        <td><?php echo htmlentities($AdminName); ?></td>
        <td><?php echo htmlentities($AddedBy); ?></td>
        <td> <a href="DeleteAdmin.php?id=<?php echo $AdminId;?>" class="btn btn-info btn-block text-info bg-dark">Delete</a>  </td>
        </tbody>
        <?php } ?>
        </table>
        <?php
      }
    }
    ?>
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
    