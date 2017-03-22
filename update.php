<?php
   include('session.php');

function displayUser($conn, $login_user) {
      $sql = "SELECT userID, username, password, firstname, lastname, email FROM user WHERE userID = '$login_user'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      return $row;
}

function updateUser($conn, $login_user) {
      $myfirstname = mysqli_real_escape_string($conn,$_POST["txtFirstname"]);
      $mylastname = mysqli_real_escape_string($conn,$_POST["txtLastname"]);
      $myemail = mysqli_real_escape_string($conn,$_POST["txtEmail"]);
      
      $sql = "UPDATE user SET firstname = '$myfirstname', lastname = '$mylastname', email = '$myemail' WHERE userID = '$_SESSION[login_user]'";

      if (mysqli_query($conn, $sql)) {
            $info = "Updated User successfully "; 
      } else {
            $info = "Error updating User: ". mysqli_error($conn); 
      }
      return $info;
}

function deleteUser($conn, $login_user) {

      
      $sql = "DELETE user, post FROM user INNER JOIN post ON user.userID = post.userID WHERE user.userID = '$_SESSION[login_user]'";
      //$sql = "DELETE FROM user WHERE userID = '$_SESSION[login_user]'";
      if (mysqli_query($conn, $sql)) {
             $info = "User deleted successfully";
             header("Location: logout.php");
      } else {
             $info = "Error deleting User: " . mysqli_error($conn);
      } 
      return $info;
}


if(isset($_POST["update"])){
     $info = updateUser($conn, $_SESSION["login_user"]);
}

else if (isset($_POST["delete"])){
     $info = deleteUser($conn, $_SESSION["login_user"]);
}

else
{
      $row = displayUser($conn, $_SESSION["login_user"]);
}
      mysqli_close($conn);
?>

<html>
   
   <head>
      <title>Update Page</title>
      
      <meta content="width=device-width, initial-scale=1.0" name="viewport" >
      
<!-- Style Sheets -->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="css/mystyle.css" type="text/css" rel="stylesheet"/>
        <link href="css/hover-min.css" rel="stylesheet" media="all">
<!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet"> 
       
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
       
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body class="play">
	
      <div align = "center">
         <div  id="parallaxlogin" class="container paddingtonbear">
            <div> <legend id="wtbig">Update Information</legend> </div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label id="wt">User Name  : <?php echo $row['username']?></label><br /><br />
                  <label id="wt">First Name  :</label><input type = "text" name = "txtFirstname" value = "<?php echo $row["firstname"]?>" class = "box"/><br /><br />
                  <label id="wt">Last Name  :</label><input type = "text" name = "txtLastname" value = "<?php echo $row["lastname"]?>" class = "box"/><br /><br />
                  <label id="wt">Email  :</label><input type = "text" name = "txtEmail" value = "<?php echo $row["email"]?>"class = "box"/><br /><br />
                  <button type="submit" name="update">Update</button><br /><br /><br />
                  <button type="submit" name="delete">Delete Account</button>
               </form>                   
            <div style = "font-size:15px; color:#FFF; margin-top:10px"><?php echo $info; ?></div>				
            </div>	
         </div>	
<div class="container">
<a id="wt" class="ct" href="logout.php"><button id="parallaxlogin" class=" btn btn-primary btn-block play">Sign Out</button></a>
<a id="wt" class="ct mt" href="dashboard.php"><button id="parallaxlogin" class="mt btn btn-primary btn-block play"> Return To Dashboard</button></a>
</div>	
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
            <a class="navbar-btn btn-block btn btn-default pull-right .btn-xs hvr-float-shadow play" href="update.php" >Return to Top</a>
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