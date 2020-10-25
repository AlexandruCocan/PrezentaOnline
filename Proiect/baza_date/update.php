<?php
// $sql_check = 'SELECT ID from conturi where ID = '.$_POST["id_cont"];
// $result_check = mysqli_query($con, $sql_check);
// $row_check = mysqli_fetch_array($result_check);

if(isset($_POST['update_btn'])){
    if (isset($_GET['add_btn']) && isset($_GET['an']) && isset($_GET['sem']) && isset($_GET['semigrupa']) && isset($_GET['tip']) && isset($_GET['materie'])) {
          $an = mysqli_real_escape_string($con, $_GET['an']);
          $semestrul = mysqli_real_escape_string($con, $_GET['sem']);
          $semigrupa = mysqli_real_escape_string($con, $_GET['semigrupa']);
          $tip = mysqli_real_escape_string($con, $_GET['tip']);
          $materie = mysqli_real_escape_string($con, $_GET['materie']);
          $sql_prezenta_sapt = 'SELECT C.*,C.ID as id_cont, M.materia, M.ID, P.* from conturi C, materi M, prezenta_sapt P where C.an='.$an.' and C.semestrul = '.$semestrul.' and C.semigrupa = "'.$semigrupa.'" and C.an=M.an and C.semestrul=M.semestrul and P.tip_materie = "'.$tip.'" and P.id_materie='.$materie.' and P.id_materie=M.ID and P.id_student=C.ID';
          $result_prezenta_sapt = mysqli_query($con, $sql_prezenta_sapt);
          if ($result_prezenta_sapt) {
              $resultCheck_prezenta_sapt = mysqli_num_rows($result_prezenta_sapt);
              if($resultCheck_prezenta_sapt > 0){
                  while ($row_prezenta_sapt = mysqli_fetch_array($result_prezenta_sapt)) {	//separam in linii

                      $sql_delete = 'UPDATE prezenta_sapt SET
                      saptamana_1="' . (!empty($_POST['s_1_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_2="' . (!empty($_POST['s_2_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_3="' . (!empty($_POST['s_3_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_4="' . (!empty($_POST['s_4_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_5="' . (!empty($_POST['s_5_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_6="' . (!empty($_POST['s_6_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_7="' . (!empty($_POST['s_7_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_8="' . (!empty($_POST['s_8_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_9="' . (!empty($_POST['s_9_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_10="' . (!empty($_POST['s_10_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_11="' . (!empty($_POST['s_11_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_12="' . (!empty($_POST['s_12_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_13="' . (!empty($_POST['s_13_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '",
                      saptamana_14="' . (!empty($_POST['s_14_'.$row_prezenta_sapt['id_cont']]) ? "P" : "") . '"
                      where id_student = '.$row_prezenta_sapt['id_cont'].' and id_materie = '.$row_prezenta_sapt['id_materie'].' and tip_materie = "'.$tip.'"';
                       $result_delete = mysqli_query($con, $sql_delete);
                  }
              }
          }
    $_SESSION['ok_pass']=2;
    }
}
if (isset($_GET['add_btn']) && isset($_GET['an']) && isset($_GET['sem']) && isset($_GET['semigrupa']) && isset($_GET['delete'])) {
    $sql_delete_cont = 'DELETE FROM conturi where ID='.$_GET['delete'];
    mysqli_query($con, $sql_delete_cont);
    $sql_delete_prezenta = 'DELETE FROM prezenta_sapt where id_student='.$_GET['delete'];
    mysqli_query($con, $sql_delete_prezenta);
    $_SESSION['ok_pass']=3;
}
?>
