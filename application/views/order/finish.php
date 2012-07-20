<script type="text/javascript">
$(function(){
jQuery("#finish").jqGrid({
    url:'<?php echo URL::base()?>order/tablefinish',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['finish']);?>"],
   	colModel:[
		<?php foreach($columns['finish'] as $key=>$col):?>
		{name:'<?=$key;?>',index:'<?=$key;?>',width:<?=$col[1];?>,editable:false},
		<?php endforeach;?>
   	],
   	rowNum:20,
   	rowList:[5,10,20,30],
   	pager: '#pagerfinish',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Заказы в работе",
	//autowidth: true,
	height: "100%",
	editurl: "<?php echo URL::base()?>order/savefinish",
	multiselect: true
});

jQuery("#finish").jqGrid('navGrid','#pagerfinish',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});
$(function(){
jQuery("#finished").jqGrid({
    url:'<?php echo URL::base()?>order/tablefinished',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['finished']);?>"],
   	colModel:[
		<?php foreach($columns['finished'] as $key=>$col):?>
		{name:'<?=$key;?>',index:'<?=$key;?>',width:<?=$col[1];?>,editable:false},
		<?php endforeach;?>
   	],
   	rowNum:20,
   	rowList:[5,10,20,30],
   	pager: '#pagerfinished',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Готовые заказы",
	//autowidth: true,
	height: "100%",
	editurl: "<?php echo URL::base()?>order/savefinish",
	multiselect: true
});
jQuery("#finished").jqGrid('navGrid','#pagerfinished',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});

function finishorder(){
	s = jQuery("#finish").jqGrid('getGridParam','selarrrow');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/finishorder",
			data: 'ids='+s+'&comment_finish='+$("#comment_finish").val(),
			type: 'POST',
			cache: false,
			success: function(data){
				$('#finish').trigger("reloadGrid");
				$('#finished').trigger("reloadGrid");
				//alert( "data: " + data );
				$("#comment_finish").val('');
			}
		});
	}
}
</script>
<h3>Завешение заказа</h3>
<?php echo Form::open('order/finish');?>
<?php echo Form::button('accept','Принять заказ',array('id'=>'btn_accept','onclick'=>'finishorder()'));?>
Комментарий: <?php echo Form::input('comment_finish', '', array('id'=>'comment_finish','size'=>'70','maxlength'=>'100'));?></td>
<?php echo Form::close()?>
<table id="finish"></table>
<div id="pagerfinish"></div>
<br />
<table id="finished"></table>
<div id="pagerfinished"></div>
