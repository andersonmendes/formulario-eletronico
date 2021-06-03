<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario-eletronico";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Perform query
if ($result = $conn -> query("SELECT * FROM consultas")) {
  echo "Returned rows are: " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}

$sql = "SELECT * FROM consultas";
if ($result = $conn -> query($sql)) {
  while ($row = $result -> fetch_row()) {
    //printf ("%s (%s)\n", $row[0], $row[1], $row[2], "\n");
    echo "<p>" . $row[0] ." - ". $row[1] ." - ". $row[2] . "</p>";
  }
  $result -> free_result();
}

echo "<hr>";

$sql2 = "SELECT sexo, COUNT(*) FROM consultas GROUP BY sexo ORDER BY 1 desc";
if ($result = $conn -> query($sql2)) {
  while ($row = $result -> fetch_row()) {
    echo "<p>" . $row[0] ." - ". $row[1] . "</p>";
  }
  $result -> free_result();
}

mysqli_close($conn);
?>