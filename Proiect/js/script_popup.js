$(document).ready(function(){
	var anul = 0;
	var semestrul = 0;
	var materie_id = 1;
	var semigr = '113/2';
	var form = $(".popup_profil");
	var status = false;
	$("#pop_up").on("click", function(event){
		event.preventDefault();
		if(status == false){
			form.fadeIn();
			status = true;
		}else{
			form.fadeOut();
			status=false;
		}
	});

	var searchMaterii = () => {
			if(anul != 0 && semestrul != 0) {
				materie_id = $('.insert_materii').data('materie');
				$('.insert_materii').html('<option disabled selected>Materie</option>');
				$.ajax({
						url: "../baza_date/data.php",
						data: {an: anul, sem: semestrul},
						type: 'POST',
						success: function(json) {
							var materii = JSON.parse(json);
							if(materii.length > 0){
									for(var i = 0; i < materii.length; i++) {
											$('.insert_materii').append('<option value="' + materii[i].ID + '" ' + (materii[i].ID == materie_id ? "selected" : "") + '>' + materii[i].materia + '</option>');
									}
							}
						}
				});
				semigr = $('.find_semigrupa').data('semigrupa');
				$('.find_semigrupa').html('<option disabled selected>Semigrupa</option>');
				$.ajax({
						url: "../baza_date/data.php",
						data: {type:'semigrupa', an: anul, sem: semestrul},
						type: 'POST',
						success: function(jsonn) {
							var sgr = JSON.parse(jsonn);
							if(sgr.length > 0){
									for(var i = 0; i < sgr.length; i++) {
											$('.find_semigrupa').append('<option value="' + sgr[i].semigrupa + '" ' + (sgr[i].semigrupa == semigr ? "selected" : "") + '>' + sgr[i].semigrupa + '</option>');
									}
							}
						}
				});
		}
	}

	anul = $('.insert_an').data('an');
  semestrul = $('.insert_sem').data('sem');
	searchMaterii();

  $('.insert_an').on('change', function() {
      anul = $(this).val();
      searchMaterii();
  });

  $('.insert_sem').on('change', function() {
      semestrul = $(this).val();
      searchMaterii();
  });

});
