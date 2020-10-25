<?php
  require 'connect_cocan.php';

if(isset($_POST['an']) && isset($_POST['sem']) && !isset($_POST['type'])) {
    $sql_materii = "select * from materi where an = ".$_POST['an']." and semestrul = ".$_POST['sem'];
    $result_materii = mysqli_query($con, $sql_materii);
    $resultCheck_materii = mysqli_num_rows($result_materii);
    if($resultCheck_materii > 0) {
      $materii = [];
      while($row_materii = mysqli_fetch_assoc($result_materii)) {
        $materii[] = $row_materii;
      }
      echo json_encode($materii);
    }
  }
  if(isset($_POST['an']) && isset($_POST['sem']) && isset($_POST['type']) && $_POST['type']=='semigrupa') {
    $sql_sgr = "select semigrupa from conturi where an = ".$_POST['an']." and semestrul = ".$_POST['sem']." GROUP BY semigrupa";
    $result_sgr = mysqli_query($con, $sql_sgr);
    $resultCheck_sgr = mysqli_num_rows($result_sgr);
    if($resultCheck_sgr > 0) {
      $materii_sgr = [];
      while($row_sgr = mysqli_fetch_assoc($result_sgr)) {
        $sgr[] = $row_sgr;
      }
      echo json_encode($sgr);
    }
}
 ?>
