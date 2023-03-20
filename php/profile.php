<?php
$guHost = 'localhost';
$guName = 'my_db';
$guUser = 'root';
$guPass = '';
$mysqli = new mysqli($guHost, $guName, $guUser, $guPass);
if($mysqli->connect_error) {
  exit('Could not connect');
}
$sql="SELECT * from my_tab where g_name=?";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s",$_POST["g_name"]);
$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    echo " <b> Hello </b> ". $row["g_name"]."<br>";
    echo " <b> Mail Id  </b> ".$row["g_mail"]. " <br>";
   }
?>