<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title></title>
		<?php echo HTML::style('assets/css/start/jquery-ui-1.8.18.custom.css'), PHP_EOL ?>
		<?php echo HTML::style('assets/css/ui.jqgrid.css'), PHP_EOL ?>
		
		<?php echo HTML::style('assets/css/jsgantt.css'), PHP_EOL ?>
		<?php echo HTML::style('assets/css/my.css'), PHP_EOL ?>
		
		<?php echo HTML::script('assets/js/jquery-1.7.1.min.js'), PHP_EOL ?>
		<?php echo HTML::script('assets/js/grid.locale-ru.js'), PHP_EOL ?>
		<?php echo HTML::script('assets/js/jquery.jqGrid.min.js'), PHP_EOL ?>
		<?php echo HTML::script('assets/js/jquery-ui-1.8.18.custom.min.js'), PHP_EOL ?>

		<?php echo HTML::script('assets/js/jsgantt.compressed.js'), PHP_EOL ?>
    </head>
    <body>
		<table style="background-color:lightgray">
			<tr>
				<td><?php echo Html::anchor('order/start','Выдача нового заказа');?></td>
				<td><?php echo Html::anchor('order/accept','Приемка заказа');?></td>
				<td><?php echo Html::anchor('order/plan','Планирование заказа');?></td>
				<td><?php echo Html::anchor('order/finish','Завершение заказа');?></td>
				<td><?php echo View::factory('user/login');?></td>
			</tr>
		</table>
		<?=$content?>
    </body>
</html>