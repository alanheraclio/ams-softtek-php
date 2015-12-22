<?php
  include_once("db.php");

  if($query = mysqli_query($connect, "SELECT * FROM persona")){
    while ($fila = mysqli_fetch_assoc($query)) {
      var_dump($fila);
    }
  }
  
  mysqli_close($connect);
?>