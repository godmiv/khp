<h3>Файлы</h3>
прикрепленые к детали ID: <?php echo $id?>
<table border="0">
<?php foreach ($result as $file):?>
	<tr style="background-color: lightgray">
		<?php foreach ($file as $key=>$val):?>
			<?php if ($key == 'filename'):?>
				<td><a href="<?php echo url::base().$val; ?>"><?php echo $val; ?></a></td>
			<?php else :?>
				<td><?php echo $val; ?></td>
			<?php endif;?>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
