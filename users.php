<?php
   include("config.php");
   
$sql = "SELECT userID, username, password, firstname, lastname, email FROM user";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row['userID']. " username:" . $row['username'] . " password: " . $row['password'] . " - Name: " . $row['firstname']. " " . $row['lastname']. " email: ". $row['email'] ."<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
