	<?php echo Form::open( 'file/upload', array('id'=>'uploadform','enctype' => 'multipart/form-data' ) );?>
	<?php echo Form::file('userfile',array('size'=>'45'));?>
	Описание файла: <?php echo Form::input('description',NULL,array('size'=>'30'));?>
	<?php echo Form::submit('btnupload', 'Загрузить');?>
	<?php echo Form::hidden('selectedrow', '0', array('id'=>'selectedrow'));?>
	<?php echo Form::hidden('returnurl', $returnurl);?>
	<?php echo form::close();?>
