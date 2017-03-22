<?php
   include('config.php');
   
   function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  
      if (empty($_POST["txtUsername"])) {
        $userErr = "username required";
      } 
      else {
        $myusername = mysqli_real_escape_string($conn,$_POST["txtUsername"]);
      }
	
      if (empty($_POST["txtFirstname"])) {
        $firstErr = "firstName required";
      }  
      else {
        $myfirstname = mysqli_real_escape_string($conn,$_POST["txtFirstname"]);
      }
	  
      if (empty($_POST["txtLastname"])) {
        $lastErr = "lastName required";
      }  
      else {
        $mylastname = mysqli_real_escape_string($conn,$_POST["txtLastname"]);
      }

      if (empty($_POST["txtEmail"])) {
        $emailErr = "Email required";
      } else {
        $myemail = test_input(mysqli_real_escape_string($conn,$_POST["txtEmail"]));
        // check if e-mail address is well-formed
        if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
           $emailErr = "Invalid email format"; 
        }
      }
	  
      if (empty($_POST["txtPassword"])) {
        $passErr = "password required";
      }  
      else {
        $mypassword = mysqli_real_escape_string($conn,$_POST["txtPassword"]); 
        $mypasswordConfirm = mysqli_real_escape_string($conn,$_POST["txtPasswordConfirm"]); 
	if ($mypassword == $mypasswordConfirm) {
          $myimage = mysqli_real_escape_string($conn,$_FILES["fileToUpload"]["name"]);
		  $sql = "INSERT INTO user (username, password, firstname, lastname, email, image)
            VALUES ('$myusername', '$mypassword', '$myfirstname', '$mylastname', '$myemail','$myimage')";
          if (mysqli_query($conn, $sql)) {
			include('upload.php');
            $info = "User Created Successfully!";
          } else {
            $info ="Unable to Add User!";
          }
        }
        else {
          $info ="Passwords do not match!";
        }  
     }
   }  
      
?>
<html>
   
   <head>
      <title>Login | Register</title>
       
       <meta content="width=device-width, initial-scale=1.0" name="viewport" >
      
       <!-- Style Sheets -->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="css/mystyle.css" type="text/css" rel="stylesheet"/>
        <link href="css/hover-min.css" rel="stylesheet" media="all">
 <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
</head>
    <body>
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
         body{
         }
          
         label {
            font-weight:bold;
            width:100px;
            font-size:20px;
         }
         
         .box {
            margin:0 0 10 0;
            border:#666666 solid 1px;
         }
		 
         .error {
			color: #FFF;
		 }
      </style>
      
   </head>
   
   <body class="play" bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div id="parallaxlogin" class="container paddingtonbear">
            <legend id="wtbig">Sign Up</legend>
				
            <div>
               
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" enctype="multipart/form-data">
                  <label id="wt">UserName  :</label><input type = "text" name = "txtUsername" class = "box"  value="<?php echo $myusername;?>"/><span class="error">* <?php echo $userErr;?></span>
<br />
                  <label id="wt">Password  :</label><input type = "password" name = "txtPassword"  class = "box" value="<?php echo $mypassword;?>"/><span class="error">* <?php echo $passErr;?></span>
<br />
                  <label id="wt">Confirm Password  :</label><input type = "password" name = "txtPasswordConfirm"  class = "box" value="<?php echo $mypasswordConfirm;?>"/><span class="error">* <?php echo $passErr;?></span>
<br />
                  <label id="wt">First Name  :</label><input type = "text" name = "txtFirstname"  value="<?php echo $myfirstname;?>" class = "box"/><span class="error">* <?php echo $firstErr;?></span>
<br />
                  <label id="wt">Last Name  :</label><input type = "text" name = "txtLastname"  value="<?php echo $mylastname;?>" class = "box"/><span class="error">* <?php echo $lastErr;?></span>
<br />
                  <label id="wt">Email  :</label><input type = "text" name = "txtEmail" value="<?php echo $myemail;?>" class = "box"/><span class="error">* <?php echo $emailErr;?></span>
<br />

                  <label id="wt">Select image to upload:</label>
                  <input id="wt" type="file" name="fileToUpload"><br />
                  <span class="error"> <?php echo $imgErr;?></span><br/>
    
    
                  <input type = "submit" value = " Submit "/><br />
</form>
                  <div style = "font-size:15px; color:#FFF; margin-top:10px"><?php echo $info; ?></div>
					
            </div>
				
         </div>
</div>
   </body>
</html>


<!-- End of Register Code Start of Login Code-->

<?php
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST["txtUsername"]);
      $mypassword = mysqli_real_escape_string($conn,$_POST["txtPassword"]); 
      
      $sql = "SELECT userID FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row["active"];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION["login_user"] = $row["userID"];
         
         header("location: dashboard.php");
      }else {
         $info2 = "Your Login Name or Password is invalid";
      }
   }
   mysqli_close($conn);
?>
<html>
   
   <head>
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
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div id="parallaxlogin" class="container paddingtonbear">
            <legend id="wtbig">Login</legend>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label id="wt">UserName  :</label><input type = "text" name = "txtUsername" class = "box"/><br /><br />
                  <label id="wt">Password  :</label><input type = "password" name = "txtPassword" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <div style = "font-size:15px; color:#FFF; margin-top:10px"><?php echo $info2; ?></div>
					
            </div>
				
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
            <a class="navbar-btn btn-block btn btn-default pull-right .btn-xs hvr-float-shadow play" href="RegisterandLogin.php" >Return to Top</a>
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