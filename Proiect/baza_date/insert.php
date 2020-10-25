<?php
include "connect_cocan.php ";
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../login/index");
}
if(!isset($_SESSION['user']['is_profesor']) && !isset($_SESSION['user']['is_admin'])) {
	header("Location: profile");
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
      <form class="form_add" action="insert " method="get">
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
					</select>
          <select name="tip">
            <option disabled selected>Tip</option>
            <option value="Curs" <?php echo ((isset($_GET['tip']) && $_GET['tip'] == "Curs") ? 'selected' : ''); ?>>Curs</option>
            <option value="Lab" <?php echo ((isset($_GET['tip']) && $_GET['tip'] == "Lab") ? 'selected' : ''); ?>>Laborator</option>
          </select>
          <select name="materie" class="insert_materii" data-materie="<?php echo $_GET['materie']; ?>">
            <option disabled selected>Materie</option>
          </select>
          <input type="submit" class="btn_add" name="add_btn" value="Caută">
      </form>
    </div>
      <?php
          if (isset($_GET['add_btn']) && isset($_GET['an']) && isset($_GET['sem']) && isset($_GET['semigrupa']) && isset($_GET['tip']) && isset($_GET['materie'])) {
              $an = mysqli_real_escape_string($con, $_GET['an']);
              $semestrul = mysqli_real_escape_string($con, $_GET['sem']);
              $semigrupa = mysqli_real_escape_string($con, $_GET['semigrupa']);
              $tip = mysqli_real_escape_string($con, $_GET['tip']);
              $materie = mysqli_real_escape_string($con, $_GET['materie']);
         print("
				 <div class='continut'>
				 	<div style='overflow-x:auto;'>
						<form action='insert ?an=".$an."&sem=".$semestrul."&semigrupa=".$semigrupa."&tip=".$tip."&materie=".$materie."&add_btn=Caută' method='post'>
			     			<table class='popup_table'>
								<thead>
									<tr>
										<th colspan=6 class=centru>Date Student</th>
										<th colspan=14 class=centru> Saptamani (".($data_current-2).")</th>
									</tr>
									<tr>
										<th>Nume</th>
										<th>Prenume</th>
										<th>An</th>
										<th>Sgr</th>
										<th>Tip</th>
										<th>Materie</th>");
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
					echo "</tr>
								</thead>
								<tbody>";
			     					$sql_prezenta_sapt = 'SELECT C.*,C.ID as id_cont, M.materia, M.ID, P.* from conturi C, materi M, prezenta_sapt P where C.an='.$an.' and C.semestrul = '.$semestrul.' and C.semigrupa = "'.$semigrupa.'" and C.an=M.an and C.semestrul=M.semestrul and P.tip_materie = "'.$tip.'" and P.id_materie='.$materie.' and P.id_materie=M.ID and P.id_student=C.ID';
			     					$result_prezenta_sapt = mysqli_query($con, $sql_prezenta_sapt);
			              if ($result_prezenta_sapt) {
			         					$resultCheck_prezenta_sapt = mysqli_num_rows($result_prezenta_sapt);
			         					if($resultCheck_prezenta_sapt > 0){
			         						while ($row_prezenta_sapt = mysqli_fetch_array($result_prezenta_sapt)) {	//separam in linii
													echo "<tr>
																<td>".$row_prezenta_sapt['nume']."</td>
																<td>".$row_prezenta_sapt['prenume']."</td>
																<td>".$row_prezenta_sapt['an']."</td>
																<td>".$row_prezenta_sapt['semigrupa']."</td>
																<td>".$row_prezenta_sapt['tip_materie']."</td>
																<td>".$row_prezenta_sapt['materia']."</td>";
																if($data_current > 2)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_1"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_1_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_1"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}if($data_current > 3)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_2"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_2_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_2"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 4)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_3"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_3_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_3"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 5)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_4"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_4_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_4"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 6)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_5"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_5_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_5"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 7)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_6"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_6_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_6"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 8)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_7"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_7_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_7"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 9)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_8"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_8_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_8"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 10)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_9"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_9_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_9"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 11)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_10"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_10_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_10"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 12)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_11"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_11_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_11"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 13)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_12"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_12_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_12"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 14)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_13"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_13_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_13"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}	if($data_current > 15)	{
																echo "<td class='prezenta_cell " . (empty($row_prezenta_sapt["saptamana_14"]) ? 'empty_cell' : 'full_cell') . "'>
              										<div class='checkbox'>
                										<input name='s_14_".$row_prezenta_sapt['id_cont']."' type='checkbox' " . (!empty($row_prezenta_sapt["saptamana_14"]) ? 'checked="checked"' : '') . ">
                										<span class='checkmark'></span>
										              </div>
										            </td>";
															}
												echo"</tr>";
			         							}
			         					 }
			               }
			             }
			     				 ?>
							 </tbody>
			     		</table>
							<div class="center">
								<?php
											if(isset($_GET['add_btn']) && isset($_GET['an']) && isset($_GET['sem']) && isset($_GET['semigrupa']) && isset($_GET['tip']) && isset($_GET['materie'])) {
											echo '<input type="submit" class="btn_add center" name="update_btn" value="Adaugă">';									}
								?>
							</div>
					</form>
				</div>
				<?php
					 if (isset($_SESSION['ok_pass']) && $_SESSION['ok_pass']==2){
							echo "<div class='ok_pass'>
							<p>Prezențele au fost actualizate cu succes!<p>
							</div>";
							unset($_SESSION['ok_pass']);
					}
				?>
     	</div>

    <script src="../js/script_popup.js"></script>
  </body>
  </html>
