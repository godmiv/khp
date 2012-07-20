<script type="text/javascript">
function userlogin(){
	var l = $('#login').val();
	var p = $('#pass').val();
	$.ajax({
		url: "<?php echo URL::base()?>user/login",
		data: 'login='+l+'&pass='+p,
		type: 'POST',
		cache: false,
		success: function(data){
			alert( "data: " + data );
		}
	});
}
</script>

<?php $sess = Session::instance()->as_array(); if(!isset ($sess['user'])):?>
<?php print_r(Session::instance()->as_array()); ?>
<div style="font-size: small">
<?php echo Form::open('user/login',array('id'=>'login_form','style'=>'margin: 0;'));?>
<table>
	<tr>
		<td style="text-align: right">Login:</td>
		<td><?php echo Form::input('login', '', array('id'=>'login','size'=>'10','maxlength'=>'100'));?></td>
		<td style="text-align: right">Pass:</td>
		<td><?php echo Form::password('pass', '', array('id'=>'pass','size'=>'10','maxlength'=>'100'));?></td>
		<td><?php echo Form::submit('ok', 'Войти');?></td>
		<td>&nbsp;</td>
	</tr>
</table>
</div>
<?php echo Form::input('url', Request::current()->uri(), array('type'=>'hidden'));?>
<?php echo Form::close()?>
<?php else:?>
Пользователь: <?php echo $sess['user']['f'];?>
<?php echo Html::anchor('user/logout','Выйти');?>
<?php endif; ?>

