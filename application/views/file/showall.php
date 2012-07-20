<h3>Файлы</h3>
прикрепленые к детали ID: <?php echo $id?>
<table border="0">
<?php foreach ($result as $file):?>
	<tr style="background-color: lightgray">
		<?php foreach ($file as $val):?>
			<td><?php echo $val; ?></td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
