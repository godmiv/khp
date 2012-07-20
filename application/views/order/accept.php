<script type="text/javascript">
$(function(){
jQuery("#startedorders").jqGrid({
    url:'<?php echo URL::base()?>order/started',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['startedorders']);?>"],
   	colModel:[
		<?php foreach($columns['startedorders'] as $key=>$col):?>
		{name:'<?=$key;?>',
			index:'<?=$key;?>',
			width:<?=$col[1];?>,
			editable:<?php
			if($key != 'id') echo 'true';
			else echo 'false'
			?>},
		<?php endforeach;?>
   	],
   	rowNum:20,
   	rowNum:5,
   	rowList:[5,10,20,30],
   	pager: '#pagerstartedorders',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Выданные заказы",
	//autowidth: true,
	height: "100%",
	//editurl: "../order/edit",
	multiselect: true
});

jQuery("#startedorders").jqGrid('navGrid','#pagerstartedorders',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});

$(function(){
jQuery("#acceptorders").jqGrid({
    url:'<?php echo URL::base()?>order/tableaccepted',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['acceptorders']);?>"],
   	colModel:[
		<?php foreach($columns['acceptorders'] as $key=>$col):?>
		{name:'<?=$key;?>',
			index:'<?=$key;?>',
			width:<?=$col[1];?>,
			editable:<?php
			if($key != 'id') echo 'true';
			else echo 'false'
			?>},
		<?php endforeach;?>
   	],
   	rowNum:20,
   	rowList:[5,10,20,30],
   	pager: '#pageracceptdorders',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Принятые заказы",
	//autowidth: true,
	height: "100%",
	//editurl: "../order/edit",
	multiselect: true,
	gridComplete: function() {

	}
});

jQuery("#acceptorders").jqGrid('navGrid','#pageracceptdorders',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});

function acceptorder(){
	s = jQuery("#startedorders").jqGrid('getGridParam','selarrrow');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/acceptorder/",
			data: 'ids='+s+'&comment='+$("#comment").val(),
			type: 'POST',
			cache: false,
			success: function(data){
				//$('#detal').trigger("reloadGrid");
				$('#startedorders').trigger("reloadGrid");
				$('#acceptorders').trigger('reloadGrid');
				//alert( "data: " + data );
			}
		});
	}
}
function notacceptorder(){
	s = jQuery("#startedorders").jqGrid('getGridParam','selarrrow');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/notacceptorder/",
			data: 'ids='+s+'&comment='+$("#comment").val(),
			type: 'POST',
			cache: false,
			success: function(data){
				//$('#detal').trigger("reloadGrid");
				$('#startedorders').trigger("reloadGrid");
				$('#acceptorders').trigger('reloadGrid');
				//alert( "data: " + data );
			}
		});
	}
}
</script>
<h3>Приемка заказов</h3>
<?php echo Form::open('order/accept');?>
<table>
	<tr>
		<td>
			<?php echo Form::button('accept','Принять заказ',array('id'=>'btn_accept','onclick'=>'acceptorder()'));?>
			<?php echo Form::button('notaccept','Вернуть заказ',array('id'=>'btn_notaccept','onclick'=>'notacceptorder()'));?>
		</td>
		<td>Коментарий (к принимаемому или возвращаемому заказу)</td>
		<td><?php echo Form::input('comment', '', array('id'=>'comment','size'=>'70','maxlength'=>'100'));?></td>
		<td><?php echo Form::button('clear','Очистить коментарий',array('onclick'=>'$("#comment").val("")'));?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>№ Служебной</td>
		<td><?php echo Form::input('document', '', array('id'=>'document','size'=>'70','maxlength'=>'100'));?></td>
		<td><?php echo Form::button('clear','Очистить № Служебной',array('onclick'=>'$("#document").val("")'));?></td>
		</td>
	</tr>
</table>
 <?php echo Form::close()?>
<table id="startedorders"></table>
<div id="pagerstartedorders"></div>
<br />
<table id="acceptorders"></table>
<div id="pageracceptdorders"></div>