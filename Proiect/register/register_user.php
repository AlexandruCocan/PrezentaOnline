<?php
session_start();
if(isset($_POST['register_btn'])){
		//anti-SQL injection
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$nume = mysqli_real_escape_string($con, $_POST['nume']);
		$prenume = mysqli_real_escape_string($con, $_POST['prenume']);
		$semigrupa = mysqli_real_escape_string($con, $_POST['semigrupa']);
		$an = mysqli_real_escape_string($con, $_POST['an']);
		$semestru = mysqli_real_escape_string($con, $_POST['semestru']);
		$parola = mysqli_real_escape_string($con, $_POST['parola']);

		if(empty($email)){
			array_push($erori, "Este necesar un email");
		}
		if(empty($nume)){
			array_push($erori, "Este necesar un nume");
		}
		if(empty($prenume)){
			array_push($erori,"Este necesar un prenume");
		}
		if(empty($parola)){
			array_push($erori, "Este necesară o parolă");
		}
		if(empty($semigrupa)){
			array_push($erori, "Este necesară semigrupa");
		}
		if(empty($an)){
			array_push($erori, "Este necesar un an");
		}
		if(empty($semestru)){
			array_push($erori, "Este necesar un semestru");
		}
		if (strpos($email, '@ulbsibiu.ro') == false) {
			array_push($erori, "Adresa de email nu este de ulbs");
		}
		if (strpos($semigrupa, '/') == false) {
			array_push($erori, "Format Grupa/Semigrupa");
		}

		$check_users = mysqli_query($con, "SELECT * FROM conturi WHERE email='" . $email . "'");
		$row = mysqli_fetch_array($check_users);

		if(is_array($row)){
			if(count($row)>0){
				array_push($erori, "Există deja acest email");
			}
		}else{
				if(count($erori)==0){
						$_SESSION["ok_pass"] = 1;
						//criptare parolă
						$parola = password_hash($parola, PASSWORD_DEFAULT);
						$sql = "INSERT INTO conturi (email,nume,prenume,parola,semigrupa,an,semestrul) VALUES ('$email', '$nume', '$prenume' ,'$parola', '$semigrupa', '$an', '$semestru')";
						$register=mysqli_query($con, $sql);
						if($register){
								$add_la_prezenta = mysqli_query($con, 'SELECT M.ID as idmaterie, C.ID as idcont FROM materi M, conturi C WHERE M.an = '.$an.' and M.semestrul = '.$semestru.' and C.email = "'.$email.'"');
								while($row_la_prezenta = mysqli_fetch_assoc($add_la_prezenta)) {
											$sql_prezenta_sapt = 'INSERT INTO prezenta_sapt (id_student,id_materie,tip_materie,saptamana_1,saptamana_2,saptamana_3,saptamana_4,saptamana_5,saptamana_6,saptamana_7,saptamana_8,saptamana_9,saptamana_10,saptamana_11,saptamana_12,saptamana_13,saptamana_14) VALUES ('.$row_la_prezenta["idcont"]. ', '.$row_la_prezenta["idmaterie"].', "Curs", "","","","","","","","","","","","","","")';
											mysqli_query($con, $sql_prezenta_sapt);
											$sql_prezenta_sapt_lab = 'INSERT INTO prezenta_sapt (id_student,id_materie,tip_materie,saptamana_1,saptamana_2,saptamana_3,saptamana_4,saptamana_5,saptamana_6,saptamana_7,saptamana_8,saptamana_9,saptamana_10,saptamana_11,saptamana_12,saptamana_13,saptamana_14) VALUES ('.$row_la_prezenta["idcont"]. ', '.$row_la_prezenta["idmaterie"].', "Lab", "","","","","","","","","","","","","","")';
											mysqli_query($con, $sql_prezenta_sapt_lab);
								}
								header("Location: ../login/index ");	//redirectionare catre pagina de login
					}
			}
		}
}
?>
