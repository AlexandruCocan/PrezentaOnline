<?php
include "../baza_date/connect_cocan.php ";
include "register_user.php ";
 if(isset($_SESSION['user'])){
	 header("Location: ../baza_date/profile.php ");
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
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<header>
		<?php include "../baza_date/meniu.php "; ?>
	</header>

	<img class="wave" src="../imagini/wave.png" alt="un val verde">
	<div class="container">
		<div class="img">
			<img src="../imagini/bg.svg" alt="versiune mobil">
		</div>
		<div class="login-content">
			<form action="register " method = "post">
				<img src="../imagini/avatar.svg" alt="avatar">
				<h2>Bine ai venit!</h2>
				<?php include("../baza_date/errors.php "); ?>
				<div class="input-div email">
           	<i class="fa fa-envelope" aria-hidden="true"></i>
           	<div class="div">
           		 <input type="email" name="email" class="input" required>
						         <label>Email</label>
           	</div>
        </div>
     		<div class="input-div user">
     		   <i class="fa fa-user-ninja" aria-hidden="true" ></i>
     		    <div class="div">
     		   		   <input type="text" name="nume" class="input"required>
			              <label>Nume</label>
     		   </div>
     		</div>
				<div class="input-div user">
           	<i class="fa fa-user" aria-hidden="true"></i>
           	<div class="div">
           		 <input type="text" name="prenume" class="input" required>
						         <label>Prenume</label>
           	</div>
        </div>
				<div class="input-div user">
           	<i class="fa fa-users" aria-hidden="true"></i>
           	<div class="div">
           		 <input type="text" name="semigrupa" class="input" required>
						         <label>Grupa / Semigrupa</label>
           	</div>
        </div>
				<div class="input-div user">
           	<i class="fas fa-calendar" aria-hidden="true"></i>
           	<div class="div">
  						<select name="an">
  							<option value ="an"> An </option>
  							<option value ="1"> 1 </option>
  							<option value ="2"> 2 </option>
  							<option value ="3"> 3 </option>
  							<option value ="4"> 4 </option>
  						</select>
           	</div>
        </div>
				<div class="input-div user">
           	<i class="far fa-calendar" aria-hidden="true"></i>
           	<div class="div">
           		<select name="semestru">
  							<option value ="semestru"> Semestru </option>
  							<option value ="1"> 1 </option>
  							<option value ="2"> 2 </option>
						  </select>
            </div>
        </div>
        <div class="input-div pass">
           	<i class="fa fa-lock" aria-hidden="true"></i>
           	<div class="div">
           		 <input type="password" name="parola" class="input" required>
						         <label>Password</label>
            </div>
        </div>
        <a class="forma" href="../login/index ">Login</a>
        <input type="submit" class="btn" name="register_btn" value="Sign up">
      </form>
    </div>
  </div>
</body>
</html>
