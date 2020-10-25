<?php if (count($erori) > 0): ?>
	<div class="error">
		<?php foreach ($erori as $erori): ?>
			<p><?php echo $erori; ?></p>
		<?php endforeach ?>
	</div>	
<?php  endif ?>