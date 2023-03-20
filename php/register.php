<?php
$guHost = 'localhost';
$guName = 'my_db';
$guUser = 'root';
$guPass = '';

$g_name     = filter_input(INPUT_POST, 'g_name', FILTER_SANITIZE_STRING);
$g_mail    = filter_input(INPUT_POST, 'g_mail', FILTER_SANITIZE_EMAIL);
$g_password = filter_input(INPUT_POST, 'g_password', FILTER_SANITIZE_STRING);

try {
  $gu = new PDO("mysql:host=$guHost;dbname=$guName", $guUser, $guPass);
  $gu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $vi = $gu->prepare("INSERT INTO my_tab (g_name, g_mail, g_password) VALUES (:g_name, :g_mail, :g_password)");
  $vi->bindParam(':g_name', $g_name);
  $vi->bindParam(':g_mail', $g_mail);
  $vi->bindParam(':g_password', $g_password);
  $vi->execute();

  echo json_encode(array('success' => true));
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>