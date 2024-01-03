createuser.php
<?php
$servername = "mysql-srv";
$username = "school";
$password = "school";
$useremail = $_POST['user_email'];
$userpass = $_POST['user_password'];

$conn = mysqli_connect($servername, $username, $password,"school");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully</br>";
$sql = "insert into school.user_info values('$useremail','$userpass')";

if ($conn->query($sql) === TRUE) {
  echo "<br>New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<h1> Existing Users: </h1></br>";
$sql1 = "select * from school.user_info";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo  $row["user_email"] . $row["user_password"] . "<br>";
}
} else {
echo "0 results";
}
$conn->close();
?>
