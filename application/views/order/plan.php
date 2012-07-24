<script type="text/javascript">
$(function(){
var lastsel;
jQuery("#plan").jqGrid({
    url:'<?php echo URL::base()?>order/tableplan',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['plan']);?>"],
   	colModel:[
		<?php foreach($columns['plan'] as $key=>$col):?>
		{name:'<?=$key;?>',index:'<?=$key;?>',width:<?=$col[1];?>,editable:<?php if($key == 'doer') echo 'true';else echo 'false';if($key == 'doer'):?>,edittype:"select",editoptions:{value:"<?=$col['values'];?>"}<?php endif;?>},
		<?php endforeach;?>
   	],
   	rowNum:20,
   	rowList:[5,10,20,30],
   	pager: '#pagerplan',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Выданные заказы",
	autowidth: true,
	height: "100%",
	editurl: "<?php echo URL::base()?>order/saveplan",
	multiselect: false,
	gridComplete: function(){
		decorateColumnFile("#plan");
	},
	onSelectRow: function(id){
		//alert(id)
		if(id && id!==lastsel){
			jQuery('#plan').restoreRow(lastsel);
			jQuery('#plan').editRow(id,true,null,refreshGrid);
			lastsel=id;
		}
	}
});
function refreshGrid(){
	$('#plan').trigger('reloadGrid');
}
jQuery("#plan").jqGrid('navGrid','#pagerplan',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});
function decorateColumnFile(t){
		var ids = jQuery(t).jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
			hr = "<a href = '<?php echo URL::base()?>file/showall/"+cl+"'><img height=\"16px\" src=\"<?php echo URL::base()?>assets/img/Floppy.png\" border=\"0\"></a>";
			//hr = "<a onclick='showfiles("+cl+")'>Test</a>";
			if(jQuery(t).getRowData(ids[i]).files == "1"){
				jQuery(t).jqGrid('setRowData',ids[i],{files:hr});			
			}
			//alert (status);
		}
	}
</script>
<h3>Планирование</h3>
<table id="plan"></table>
<div id="pagerplan"></div>