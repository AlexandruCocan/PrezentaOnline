<?php
echo"<img class='logo' src='../imagini/logo.png' alt='logo'>";
if(isset($_SESSION['user'])){
  echo "
  <nav>
    <ul class='nav_links'>
      <li><a class='animatie' href='profile '>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Acasă</a>
      </li>";
      if(isset($_SESSION['user']['is_profesor']) || isset($_SESSION['user']['is_admin'])){
          echo "<li><a class='animatie' href='insert '>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              Adaugă Prezențe</a>
            </li>";
          if(isset($_SESSION['user']['is_admin'])){
              echo "<li><a class='animatie' href='delete '>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Șterge Student</a>
              </li>";
              echo "<li><a class='animatie' href='adauga_profesor '>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Adaugă profesor</a>
              </li>";
         }
  }
    echo "</ul>
  </nav>";
}else{
  echo "<a class='cta' href='#'></a><button>";
    if(isset($_SESSION['user'])){
      echo $_SESSION['user']['nume'].' '.$_SESSION['user']['prenume'];
    }else{
      echo 'Contact';
    }
  echo "</button>";
}
if(isset($_SESSION['user']) && !isset($_SESSION['user']['is_profesor']) && !isset($_SESSION['user']['is_admin'])){  //daca e student
  echo "<a id='pop_up' href='#'><button>";
    if(isset($_SESSION['user'])){
      echo $_SESSION['user']['nume'].' '.$_SESSION['user']['prenume'];
    }else{
      echo 'Contact';
    }
    echo "</button></a>
  <div class='popup_profil centru'>
    <div class='popup_nume'>";
        echo $_SESSION['user']['nume'].' '.$_SESSION['user']['prenume'].'<br> An : '.$_SESSION['user']['an'].', Sem : '.$_SESSION['user']['semestrul'].', Semigrupa : '.$_SESSION['user']['semigrupa'];
    echo "</div>
    <div class='popup_date_titlu'>
        <p>Număr prezențe</p>
    </div>
    <div class='popup_date'>
      <!-- Fisier pentru a arata numarul de prezente la curs/laborator la materiile studentului -->";
      include"pop_up_status.php ";
    echo "</div>
    <div class='popup_log_out centru'>
      <a class='popup_link' href='../login/log_out'>Deconectare</a>
    </div>
  </div>";
}
if(isset($_SESSION['user']) ){
  if(isset($_SESSION['user']['is_profesor'])){
      echo "<a id='pop_up' href='#'><button>"
      .$_SESSION['user']['nume'].' '.$_SESSION['user']['prenume']."
      </button></a>
    <div class='popup_profil centru'>
      <div class='popup_nume'>";
          echo $_SESSION['user']['nume'].' '.$_SESSION['user']['prenume'].'<br> An : '.$_SESSION['user']['an'].', Sem : '.$_SESSION['user']['semestrul'].', Semigrupa : '.$_SESSION['user']['semigrupa'];
          $sql_mat = "select materia from materi where id=".$_SESSION['user']['id_materie'];
          $result_mat = mysqli_query($con, $sql_mat);
          $row_mat = mysqli_fetch_array($result_mat);
      echo "</div>
      <div class='popup_date_titlu'>
          <p>Top absenți : <br>".$row_mat['materia']."</p>
      </div>
      <div class='popup_date'>
        <!-- Fisier pentru a arata numarul de prezente la curs/laborator la materiile studentului -->";
        include"pop_up_status.php ";
      echo "</div>
      <div class='popup_log_out centru'>
        <a class='popup_link' href='../login/log_out'>Deconectare</a>
      </div>
    </div>";
  }
}
if(isset($_SESSION['user']) ){
  if(isset($_SESSION['user']['is_admin'])){
      echo "<a id='pop_up' href='#'><button>"
      .$_SESSION['user']['nume'].' '.$_SESSION['user']['prenume']."
      </button></a>
    <div class='popup_profil centru'>
      <div class='popup_nume'>";
          echo $_SESSION['user']['nume'].' '.$_SESSION['user']['prenume'];
      echo "</div>
      <div class='popup_date_titlu'>
          <p>Admin</p>
      </div>
      <div class='popup_date'>
      </div>
      <div class='popup_log_out centru'>
        <a class='popup_link' href='../login/log_out'>Deconectare</a>
      </div>
    </div>";
  }
}
?>
