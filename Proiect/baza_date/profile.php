<?php
include "connect_cocan.php ";
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../login/index");
}
$sql_prof = "SELECT * from profesori where email='".$_SESSION["user"]["email"]."'";
$result_prof = mysqli_query($con, $sql_prof);
$row_prof = mysqli_fetch_array($result_prof);
if ($row_prof) {
	$resultCheck_prof = mysqli_num_rows($result_prof);
	if($resultCheck_prof > 0){
		$sql_sterge = "DELETE from prezenta_sapt where id_student=".$_SESSION['user']['ID'];
		mysqli_query($con, $sql_sterge);
		unset($_SESSION['user']);
		$_SESSION['user']=$row_prof;
		$_SESSION['user']['is_profesor']=true;
	}
}
$sql_admin ="SELECT * from admin where email='".$_SESSION["user"]["email"]."'";
$result_admin = mysqli_query($con, $sql_admin);
$row_admin = mysqli_fetch_array($result_admin);
if($row_admin){
	$resultCheck_admin = mysqli_num_rows($result_admin);
	if($resultCheck_admin > 0){
		$sql_sterge = "DELETE from prezenta_sapt where id_student=".$_SESSION['user']['ID'];
		mysqli_query($con, $sql_sterge);
		unset($_SESSION['user']);
		$_SESSION['user']=$row_admin;
		$_SESSION['user']['is_admin']=true;
	}
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
		<div class="continut">
			<div style="overflow-x:auto;">
			<table class="popup_table">
				<thead>
				<tr>
					<th colspan="6" class="centru">Date Student</th>
					<th colspan="14" class="centru"> Saptamani (<?php print_r($data_current-2); ?>)</th>
				</tr>
				<tr>
					<th>Nume</th>
					<th>Prenume</th>
					<th>An</th>
					<th>Sgr</th>
					<th>Tip</th>
					<th>Materie</th>
					<?php
					if($data_current > 2)	{
					echo "<th>1</th>";
				}
				if($data_current > 3)	{
					echo "<th>2</th>";
				}
				if($data_current > 4)	{
					echo "<th>3</th>";
				}
				if($data_current > 5)	{
					echo "<th>4</th>";
				}
				if($data_current > 6)	{
					echo "<th>5</th>";
				}
				if($data_current > 7)	{
					echo "<th>6</th>";
				}
				if($data_current > 8)	{
					echo "<th>7</th>";
				}
				if($data_current > 9)	{
					echo "<th>8</th>";
				}
				if($data_current > 10)	{
					echo "<th>9</th>";
				}
				if($data_current > 11)	{
					echo "<th>10</th>";
				}
				if($data_current > 12)	{
					echo "<th>11</th>";
				}
				if($data_current > 13)	{
					echo "<th>12</th>";
				}
				if($data_current > 14)	{
					echo "<th>13</th>";
				}
				if($data_current > 15)	{
					echo "<th>14</th>";
				}
				 ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql_prezenta_sapt = 'SELECT C.*, M.materia, M.ID, P.* from conturi C, materi M, prezenta_sapt P where C.ID = P.id_student and M.ID = P.id_materie';
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
									<td>".$row_prezenta_sapt['tip_materie']."</td>
									<td>".$row_prezenta_sapt['materia']."</td>";
								if($data_current > 2)	{
										echo "<td ".(empty($row_prezenta_sapt['saptamana_1']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_1']."</td>";
								}if($data_current > 3){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_2']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_2']."</td>";
								}if($data_current > 4){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_3']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_3']."</td>";
								}if($data_current > 5){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_4']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_4']."</td>";
								}if($data_current > 6){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_5']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_5']."</td>";
								}if($data_current > 7){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_6']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_6']."</td>";
								}if($data_current > 8){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_7']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_7']."</td>";
								}if($data_current > 9){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_8']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_8']."</td>";
								}if($data_current > 10){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_9']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_9']."</td>";
								}if($data_current > 11){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_10']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_10']."</td>";
								}if($data_current > 12){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_11']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_11']."</td>";
								}if($data_current > 13){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_12']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_12']."</td>";
								}if($data_current > 14){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_13']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_13']."</td>";
								}if($data_current > 15){
									echo "<td ".(empty($row_prezenta_sapt['saptamana_14']) ? 'class="empty_cell"' : 'class="full_cell"').">".$row_prezenta_sapt['saptamana_14']."</td>";
								}
								echo"</tr>";
								}
						}
				 }
				 ?>
		 </tbody>
			</table>
		</div>
	</div>




	<script src="../js/script_popup.js"></script>
</body>
</html>
