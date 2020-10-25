<?php
  if(!isset($_SESSION['user']['is_profesor']) && !isset($_SESSION['user']['is_admin'])){
    $sql_materii_curs = "select M.ID as id_materie, M.materia, P.* from materi M, prezenta_sapt P where M.an = ".$_SESSION['user']['an']." and M.semestrul =".$_SESSION['user']['semestrul']." and P.tip_materie = 'Curs' and P.id_materie = M.ID and P.id_student = ".$_SESSION['user']['ID'];
    $result_materii_curs = mysqli_query($con, $sql_materii_curs);
    $resultCheck_materii_curs = mysqli_num_rows($result_materii_curs); //numara datele
    echo "<p>Curs:</p>";

        while ($row_prezenta_curs = mysqli_fetch_array($result_materii_curs)) {

            $result_numar_prezente_curs = array_count_values($row_prezenta_curs);	//Numără toate valorile unui tablou
            if(isset(($result_numar_prezente_curs['P']))){
                echo $row_prezenta_curs['materia']." : ".($result_numar_prezente_curs['P']/2)."<br>";
            }else{
                echo $row_prezenta_curs['materia']." : 0<br>";
            }
        }

    $sql_materii_lab = "select M.ID as id_materie, M.materia, P.* from materi M, prezenta_sapt P where M.an = ".$_SESSION['user']['an']." and M.semestrul =".$_SESSION['user']['semestrul']." and P.tip_materie = 'Lab' and P.id_materie = M.ID and P.id_student = ".$_SESSION['user']['ID'];
    $result_materii_lab = mysqli_query($con, $sql_materii_lab);
    $resultCheck_materii_lab = mysqli_num_rows($result_materii_lab); //numara datele
      echo "<br><p>Laborator:</p>";
    while ($row_prezenta_lab = mysqli_fetch_array($result_materii_lab)) {
            $result_numar_prezente_lab = array_count_values($row_prezenta_lab);	//Numără toate valorile unui tablou
            if(isset(($result_numar_prezente_lab['P']))){
                echo $row_prezenta_lab['materia']." : ".($result_numar_prezente_lab['P']/2)."<br>";
            }else{
                echo $row_prezenta_lab['materia']." : 0<br>";
            }
        }
  }
  if(isset($_SESSION['user']['is_profesor'])){
    //pentru curs
    $sql_absenti = "select M.ID as id_materie, M.materia, P.*, C.nume as student_nume, C.prenume as student_prenume, A.nume as profesor_nume, A.prenume as profesor_prenume from materi M, prezenta_sapt P, conturi C, profesori A where C.semigrupa ='".$_SESSION['user']['semigrupa']."' and P.tip_materie = 'Curs' and P.id_materie = M.ID and P.id_student = C.ID and P.id_materie = A.id_materie";

    $result_absenti = mysqli_query($con, $sql_absenti);
    $resultCheck_absenti = mysqli_num_rows($result_absenti); //numara datele
    echo "<br><p>Curs:</p>";
    $array_abs = array();
    $it=0;
    while ($row_array = mysqli_fetch_array($result_absenti)) {
      $result_numar_abs_curs = array_count_values($row_array);	//Numără toate valorile unui tablou
          if(isset(($result_numar_abs_curs['P']))){
              $abs= ($data_current-($result_numar_abs_curs['P']/2))-2;
              $array_add = array("Absente" => "$abs","Nume" => $row_array['student_nume'],"Prenume" => $row_array['student_prenume']);
              array_push($array_abs, $array_add);
      }else{
        $abs= ($data_current-2);
        $array_add = array("Absente" => "$abs","Nume" => $row_array['student_nume'],"Prenume" => $row_array['student_prenume']);
        array_push($array_abs, $array_add);
      }
  }
    arsort($array_abs);
    foreach ($array_abs as $key) {
      echo $key['Nume']." ".$key['Prenume']." : ".$key['Absente']."<br>";
      $it = $it+1;
      if($it>4){
        break;
      }
    }
    //pentru laborator
    $sql_absenti_lab = "select M.ID as id_materie, M.materia, P.*, C.nume as student_nume, C.prenume as student_prenume, A.nume as profesor_nume, A.prenume as profesor_prenume , A.id_materie as profesor_materie from materi M, prezenta_sapt P, conturi C, profesori A where C.semigrupa ='".$_SESSION['user']['semigrupa']."' and P.tip_materie = 'Lab' and P.id_materie = M.ID and P.id_student = C.ID and P.id_materie = A.id_materie";

    $result_absenti_lab = mysqli_query($con, $sql_absenti_lab);
    $resultCheck_absenti_lab = mysqli_num_rows($result_absenti_lab); //numara datele
    echo "<br><p>Laborator:</p>";
    $array_abs_lab = array();
    $it_lab=0;
    while (($row_array_lab = mysqli_fetch_array($result_absenti_lab))) {
      $result_numar_abs_lab = array_count_values($row_array_lab);	//Numără toate valorile unui tablou
          if(isset(($result_numar_abs_lab['P']))){
              $abs_lab = ($data_current-($result_numar_abs_lab['P']/2))-2;
              $array_add_lab = array("Absente" => "$abs_lab","Nume" => $row_array_lab['student_nume'],"Prenume" => $row_array_lab['student_prenume']);
              array_push($array_abs_lab, $array_add_lab);
      }else{
        $abs_lab= ($data_current-2);
        $array_add_lab = array("Absente" => "$abs_lab","Nume" => $row_array_lab['student_nume'],"Prenume" => $row_array_lab['student_prenume']);
        array_push($array_abs_lab, $array_add_lab);
      }
  }
    arsort($array_abs_lab);
    foreach ($array_abs_lab as $key_lab) {
      echo $key_lab['Nume']." ".$key_lab['Prenume']." : ".$key_lab['Absente']."<br>";
      $it_lab = $it_lab+1;
      if($it_lab>4){
        break;
      }
    }
  }
 ?>
