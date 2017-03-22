<?php
   include('session.php');

function addPost($conn) {
      $mypost = mysqli_real_escape_string($conn,$_POST["txtAddPost"]);
      if ($mypost != "")
      {
        $sql = "INSERT INTO post (userID, post)
            VALUES ('$_SESSION[login_user]', '$mypost')";
        if (mysqli_query($conn, $sql)) {
          $info = "Post Created Successfully!";
          header("Location: dashboard.php");
        } 
      }
	  return $info;
}

function updatePost($conn) {
      $postID = mysqli_real_escape_string($conn,$_POST["txtPostID"]);
      $post = mysqli_real_escape_string($conn,$_POST["txtPost"]);
	  $sql = "UPDATE post SET post = '$post' WHERE postID = '$postID'";
      if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php");
      } else {
            $info = "Error updating User: ". mysqli_error($conn); 
      }
      return $info;
}

function deletePost($conn) {
	  $postID = mysqli_real_escape_string($conn,$_POST["txtPostID"]);   
      $sql = "DELETE FROM post WHERE postID = '$postID'";
      if (mysqli_query($conn, $sql)) {
             header("Location: dashboard.php");
      } else {
             $info = "Error deleting User: " . mysqli_error($conn);
      } 
      return $info;
}

   if(isset($_POST["btnPost"])){
      $info = addPost($conn);
   }
   
   else if(isset($_POST["btnUpdate"])){
	  $info = updatePost($conn, $rowPost["postDate"]);    
   }
   
   else if(isset($_POST["btnDelete"])){
	  $info = deletePost($conn);    
   }
   
   else
   {
	  $sql = "SELECT userID, username, password, firstname, lastname, email, image FROM user WHERE userID = '$_SESSION[login_user]' ";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $sqlPost = "SELECT postID, userID, post, postDate FROM post WHERE userID = '$_SESSION[login_user]' ORDER BY postDate DESC";
   $resultPost = mysqli_query($conn, $sqlPost);
   }
  
?>

<html>
   
   <head>
      <title>Welcome </title>
   </head>
<meta content="width=device-width, initial-scale=1.0" name="viewport" >
      
       <!-- Style Sheets -->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="css/mystyle.css" type="text/css" rel="stylesheet"/>
        <link href="css/hover-min.css" rel="stylesheet" media="all">
 <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">

            <body class="play">

<!--nav START-->
        <div class="navbar navbar-inverse navbar-fixed-top" id="fade2">
            <div class="container">
                <a href="index.html" id="bt" class="navbar-brand play hvr-float-shadow">Kyle's Site</a>
                <!--mobile menu-->
                <button id="nh" class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span> Menu </button></span>
                </button>
                <!--collapse menu-->
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right play">
                        <li><a id="bt" class="hvr-float-shadow" href="index.html">Home</a></li>
                        <li><a id="bt" class="hvr-float-shadow" href="interests.html">Interests</a></li>
                        <li><a id="bt" class="hvr-float-shadow" href="qualifications.html">Qualifications</a></li>
                        <li><a id="bt" class="hvr-float-shadow" href="goals.html">Goals</a></li>
                        <li><a id="bt" class="hvr-float-shadow" href="achievements.html">Achievements</a></li>
                        <li class="active"><a class="hvr-float-shadow" href="RegisterandLogin.php" data-toggle="modal">Register | Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    <!--nav END-->
<style>
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
			margin:10px 0px 10px 0px; 
            border:#666666 solid 1px;
            width:500px;
            padding:10px;
         }
</style>
   
<div id="parallaxlogin" class="container paddingtonbear ct">
      <h1 class="ct" id="wtbig">Welcome <?php echo $row["firstname"]; ?></h1>
     <?php echo "<img class='img-responsive img-circle center-block' src='uploads/" . $row["image"] . "'/></br>"; ?> 
 
<p id="wt">
<?php echo "Username: " . $row["username"] . "</br>"; ?>
<?php echo "Firstname: " . $row["firstname"] . "</br>"; ?>
<?php echo "Lastname: " . $row["lastname"] . "</br>"; ?>
<?php echo "Email: " . $row["email"] . "</br>"; ?>
</p>
</div>

<div class="container">
<a id="wt" class="ct" href="logout.php"><button id="parallaxlogin" class=" btn btn-primary btn-block play">Sign Out</button></a>
<a id="wt" class="ct mt" href="update.php"><button id="parallaxlogin" class="mt btn btn-primary btn-block play">Update Details</button></a>
</div>

<div id="parallaxlogin" class="container paddingtonbear ct">

<h2 id="wtbig">Timeline</h2>

<form id='bt' class="form-group" action = "" method = "post">
  <textarea class="form-control" rows="5" cols="40" name = "txtAddPost"/></textarea><br/>
  <input type = "submit" value = "Post" name = "btnPost"/><br />
       </form>
    

<?php
if (mysqli_num_rows($resultPost) > 0) {
    // output data of each row
    while($rowPost = mysqli_fetch_assoc($resultPost)) {
        echo " <form class='form-group' action id='wt' = '' method = 'post'> ";
		
		echo "<textarea cols='40' class='form-control' id='bt' name='txtPost' >" . $rowPost["post"] . "</textarea>";
		echo "<br >" . " Date / Time:" . $rowPost["postDate"] . "<br>"; 
		echo "<input type='hidden' name='txtPostID' value='$rowPost[postID]'>";
		echo "<button id='bt' type='submit' name='btnUpdate'>Update</button>";
		echo "<button id='bt' type='submit' name='btnDelete'>Delete</button>";
		echo "</form>";

    }
}
mysqli_close($conn);
?>
     
</div>

<!--footer Start-->
    <!--footer START-->
        <div class="navbar navbar-default navbar-fixed-bottom col-md-12 mt " id="parallaxloginfoot">
                <p class="text-center play" id="tt2"> Kyle Papachristophorou's Website 2016 <br /> Find Me On:</p>
        <div class="container col-md-3 col-xs-6 col-sm-3">
            <a class="navbar-btn btn-block btn btn-default pull-left facebook-button hvr-float-shadow play   " href="https://www.facebook.com/" target="_blank">Facebook</a>
            <a class="navbar-btn btn-block btn btn-default pull-left twitter-button hvr-float-shadow play   " href="https://www.twitter.com/" target="_blank">Twitter</a>
            </div>
            
            <div class="container col-md-3 col-xs-6 col-sm-3">
            <a class="navbar-btn btn-block btn btn-default pull-left github-button .btn-xs hvr-float-shadow play" href="https://github.com/" >Github</a>
            <a class="navbar-btn btn-block btn btn-default pull-left linkedin-button .btn-xs hvr-float-shadow play" href="https://uk.linkedin.com/" >LinkedIn</a>
        </div>   
              
            <div class="container col-md-3 col-xs-6 col-sm-3">
            <a class="navbar-btn btn-block btn btn-default pull-right youtube-button .btn-xs hvr-float-shadow play   " href="https://www.youtube.com/" target="_blank" >Youtube</a>
            <a class="navbar-btn btn-block btn btn-default pull-right .btn-xs hvr-float-shadow play" href="dashboard.php" >Return to Top</a>
            </div>
            
            <div class="container col-md-3 col-xs-6 col-sm-3">
            <a class="navbar-btn btn-block btn btn-default pull-right insta-button .btn-xs hvr-float-shadow play   " href="https://www.instagram.com/" target="_blank" >Instagram</a>
            <a class="navbar-btn btn-block btn btn-default pull-left .btn-xs hvr-float-shadow play" href="#contact   " >Coming Soon</a>
             </div>  
    </div>
    <!--footer END-->

<!-- Scripts -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

   </body>  
</html>			