<?php
include "connect_cocan.php ";
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../login/index");
}
if(!isset($_SESSION['user']['is_profesor'])) {
	if(!isset($_SESSION['user']['is_admin'])) {
		header("Location: profile");
	}
}else{
	if(!isset($_SESSION['user']['is_admin'])) {
		if(!isset($_SESSION['user']['is_profesor'])) {
			header("Location: profile");
		}
	}
}

if(isset($_POST['add_prof_btn'])){
  $nume = mysqli_real_escape_string($con, $_POST['nume_profesor']);
  $prenume = mysqli_real_escape_string($con, $_POST['prenume_profesor']);
  $email = mysqli_real_escape_string($con, $_POST['email_profesor']);
  $an = mysqli_real_escape_string($con, $_POST['an_profesor']);
  $semestrul = mysqli_real_escape_string($con, $_POST['semestru_profesor']);
  $semigrupa = mysqli_real_escape_string($con, $_POST['semigrupa_profesor']);
  $tip = mysqli_real_escape_string($con, $_POST['tip_materie_profesor']);
  $materie = mysqli_real_escape_string($con, $_POST['materie_profesor']);
  $sql_add_prof = "INSERT INTO profesori (nume,prenume,email,an,semestrul,semigrupa,tip_materie,id_materie) VALUES ('$nume', '$prenume', '$email', '$an', '$semestrul','$semigrupa', '$tip', '$materie')";
  //  die(print_r($sql_add_prof));
  mysqli_query($con, $sql_add_prof);
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
	<meta charset="utf-8">
	<title>Test</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/menu_style.css">
	<link rel="stylesheet" href="../css/login_style.css">
	<link rel="stylesheet" href="../css/insert_prof.css">
	<link rel="stylesheet" href="../css/popup_profil.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous">
	</script>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
  <header>
    <?php include "../baza_date/meniu.php "; ?>
  </header>
  <div class="container_prof">
    <div class="insert-content">
      <form class="add_prof" action="adauga_profesor" method="post">
        <h2>Adaugă un profesor nou</h2>
        <div class="input-div user">
            <i class="fa fa-user-ninja" aria-hidden="true"></i>
            <div class="div">
                <input class="input" type="text" name="nume_profesor" required>
                     <label>Nume Profesor</label>
            </div>
        </div>
        <div class="input-div user">
            <i class="fa fa-users" aria-hidden="true"></i>
            <div class="div">
                <input class="input" type="text" name="prenume_profesor" required>
                     <label>Prenume</label>
            </div>
        </div>
        <div class="input-div user">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <div class="div">
                <input class="input" type="email" name="email_profesor" required>
                     <label>Email</label>
            </div>
        </div>
        <div class="input-div user" >
           	<i class="fas fa-calendar" aria-hidden="true"></i>
           	<div class="div"  >
  						<select name="an_profesor" class="insert_an" required>
  							<option value ="an"> An </option>
  							<option value ="1"> 1 </option>
  							<option value ="2"> 2 </option>
  							<option value ="3"> 3 </option>
  							<option value ="4"> 4 </option>
  						</select>
           	</div>
        </div>
				<div class="input-div user" >
           	<i class="far fa-calendar" aria-hidden="true"></i>
           	<div class="div">
           		<select name="semestru_profesor" class="insert_sem"  required>
  							<option value ="semestru"> Semestru </option>
  							<option value ="1"> 1 </option>
  							<option value ="2"> 2 </option>
						  </select>
            </div>
        </div>
				<div class="input-div user">
           	<i class="fa fa-users" aria-hidden="true"></i>
           	<div class="div">
           		 <input type="text" name="semigrupa_profesor" class="input" required>
						         <label>Grupa / Semigrupa</label>
           	</div>
        </div>
				<div class="input-div user">
           	<i class="far fa-calendar" aria-hidden="true"></i>
           	<div class="div">
           		<select name="tip_materie_profesor" required>
  							<option value ="tip_materie"> Tip Materie </option>
  							<option value ="Curs"> Curs </option>
  							<option value ="Lab"> Laborator </option>
						  </select>
            </div>
        </div>
        <div class="input-div user">
          <i class="far fa-calendar" aria-hidden="true"></i>
          <div class="div">
            <select name="materie_profesor"  class="insert_materii" required>
              <option disabled selected>Materie</option>
            </select>
          </div>
        </div>
        <input type="submit" class="btn_add" name="add_prof_btn" value="Adaugă">
      </form>
    </div>
  </div>

</body>
  <script src="../js/script_popup.js"></script>
  </html>
