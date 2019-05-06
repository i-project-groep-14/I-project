<!doctype html>

<html lang="NL">
<title>Home</title>
<head>

  <?php include_once "Header.php"; ?>
  <?php include_once "database.php"; ?>
</head>

<body>

<?php 
$data = $db->query("select * from Rubrieken");





?>

<aside  class="NavRubriekAside">

<?php include_once "RubNav.php"; ?>


</aside>

</body>
</html>