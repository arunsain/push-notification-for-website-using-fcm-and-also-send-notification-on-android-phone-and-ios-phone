<?php
$servername = YOUR_HOST_NAME;
$username = YOUR_USER_NAME;
$password = YOUR_PASSWORD;
$dbname = YOUR_DB_NAME;
$cdate = date('Y-m-d');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($_POST['token'] && $_POST['token'] !=""){
    
    $sqlSelect = "SELECT * FROM token where token = '".$_POST['token']."'";
$getResult = $conn->query($sqlSelect);

if ($getResult->num_rows > 0) {
    
    echo "found";
 
} else {
    $sql = "INSERT INTO token (token, created_at)
    VALUES ('".trim($_POST['token'])."', '".$cdate."')";
    
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
    
    
    

   




}else{
    
    echo "some thing went worng";
    
}
mysqli_close($conn);
?>

