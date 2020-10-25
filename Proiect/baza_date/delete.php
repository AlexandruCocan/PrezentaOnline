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
$sir_id=array();
include "update.php ";
?>
<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/menu_style.css">
	<link rel="stylesheet" href="../css/insert.css">
	<link rel="stylesheet" href="../css/popup_profil.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous">
	</script>
</head>
<body>
	<header>
		<?php include "../baza_date/meniu.php "; ?>
	</header>
    <div class="container_insert">
      <form class="form_add" action="delete " method="get">
            <select name="an" class="insert_an" data-an="<?php echo $_GET['an']; ?>">
            <option disabled selected>An</option>
            <option value="1" <?php echo ((isset($_GET['an']) && $_GET['an'] == 1) ? 'selected' : ''); ?>>1</option>
            <option value="2" <?php echo ((isset($_GET['an']) && $_GET['an'] == 2) ? 'selected' : ''); ?>>2</option>
            <option value="3" <?php echo ((isset($_GET['an']) && $_GET['an'] == 3) ? 'selected' : ''); ?>>3</option>
            <option value="4" <?php echo ((isset($_GET['an']) && $_GET['an'] == 4) ? 'selected' : ''); ?>>4</option>
          </select>
          <select name="sem" class="insert_sem" data-sem="<?php echo $_GET['sem']; ?>">
            <option disabled selected>Semestrul</option>
            <option value="1" <?php echo ((isset($_GET['sem']) && $_GET['sem'] == 1) ? 'selected' : ''); ?>>1</option>
            <option value="2" <?php echo ((isset($_GET['sem']) && $_GET['sem'] == 2) ? 'selected' : ''); ?>>2</option>
          </select>
          <select name="semigrupa" class="find_semigrupa" data-semigrupa="<?php echo $_GET['semigrupa']; ?>">
            <option disabled selected>Semigrupa</option>
						<?php
								$sql_semigrupa = 'SELECT * FROM conturi GROUP BY semigrupa ORDER BY semigrupa ASC ';
								$result_semigrupa= mysqli_query($con, $sql_semigrupa);
								while ($row_semigrupa = mysqli_fetch_array($result_semigrupa)) {
										echo '<option value="'.$row_semigrupa['ID'].'"'. ((isset($_GET["semigrupa"])) ? "selected" : "").'>'.$row_semigrupa['semigrupa'].'</option>';
								}
							?>
					</select>
          <input type="submit" class="btn_add" name="add_btn" value="Caută">
      </form>
    </div>
      <?php
          if (isset($_GET['add_btn']) && isset($_GET['an']) && isset($_GET['sem']) && isset($_GET['semigrupa'])) {
              $an = mysqli_real_escape_string($con, $_GET['an']);
              $semestrul = mysqli_real_escape_string($con, $_GET['sem']);
              $semigrupa = mysqli_real_escape_string($con, $_GET['semigrupa']);
         print("
				 <div class='continut'>
				 	<div style='overflow-x:auto;'>
		     			<table class='popup_table'>
							<thead>
								<tr>
									<th colspan=6 class=centru>Date Student</th>
								</tr>
								<tr>
									<th>Nume</th>
									<th>Prenume</th>
									<th>An</th>
									<th>Sgr</th>
									<th>Sterge</th>
								</tr>
							</thead>
							<tbody>
		     				<tr>");
		     					$sql_prezenta_sapt = 'SELECT * from conturi  where an='.$an.' and semestrul='.$semestrul.' and semigrupa="'.$semigrupa.'"';
		     					$result_prezenta_sapt = mysqli_query($con, $sql_prezenta_sapt);
		              if ($result_prezenta_sapt) {
		         					$resultCheck_prezenta_sapt = mysqli_num_rows($result_prezenta_sapt);
		         					if($resultCheck_prezenta_sapt > 0){
		         						while ($row_prezenta_sapt = mysqli_fetch_array($result_prezenta_sapt)) {	//separam in linii
													echo
													"<tr>
															<td>".$row_prezenta_sapt['nume']."</td>
															<td>".$row_prezenta_sapt['prenume']."</td>
															<td>".$row_prezenta_sapt['an']."</td>
															<td>".$row_prezenta_sapt['semigrupa']."</td>
															<td>
            										<div class='delete_btn'>
																	<form>
																		<a class='delete' href=delete.php?an=".$an."&sem=".$semestrul."&semigrupa=".$semigrupa."&add_btn=Caută&delete=".$row_prezenta_sapt['ID'].">Șterge</a>
																	</form>
									              </div>
													</tr>";
		         							}
		         					 }
		               }
		             }
		     				 ?>
		     			 </tr>
						 </tbody>
		     		</table>
						<?php
							 if (isset($_SESSION['ok_pass']) && $_SESSION['ok_pass']==3){
									echo "<div class='ok_pass'>
									<p>Contul a fost șters cu succes!<p>
									</div>";
									unset($_SESSION['ok_pass']);
							}
						?>
				</div>
     	</div>
    <script src="../js/script_popup.js"></script>
  </body>
  </html>
