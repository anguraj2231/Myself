
<?php
$guHost = 'localhost';
$guName = 'my_db';
$guUser = 'root';
$guPass = '';

$g_mail    = filter_input(INPUT_POST, 'g_mail', FILTER_SANITIZE_EMAIL);
$g_password = filter_input(INPUT_POST, 'g_password', FILTER_SANITIZE_STRING);

try {
  $gu = new PDO("mysql:host=$guHost;dbname=$guName", $guUser, $guPass);
  $gu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $vi = $gu->prepare("SELECT g_mail,g_password FROM my_tab WHERE g_mail=:g_mail AND g_password =:g_password");
  $vi->bindParam(':g_mail', $g_mail);
  $vi->bindParam(':g_password', $g_password);
  $vi->execute();

  $user = $vi->fetch(PDO::FETCH_ASSOC);

  if($user) {
    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'error' => 'Invalid email or password'));
  }
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>