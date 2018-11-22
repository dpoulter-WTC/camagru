<?php
require_once('database.php');

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
$sql = file_get_contents('data.sql');
if ($qr = $dbh->exec($sql))
{
  echo "Database setup complete.";
  header("refresh:2;url=../index.php");
}
else {
  echo "Error with setup, please try again.";
}
?>
