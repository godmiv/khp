<script type="text/javascript">
$(document).ready(function(){

	if($("#osin :selected").val()=='1') {
		$("#instrument").hide();
	} else {
		$("#instrument").show();
	}
	$("#osin").change(
		function(){
			if(this.value != '1'){
				$.ajax({
					url: "<?php echo URL::base()?>ajax/nextnumber/"+this.value,
					cache: false,
					success: function(data){
						//alert( "data: " + data );
						var temp = new Array();
						temp = data.split('|');
						$("#kodinstr").val(temp[0]);
						$("#nazvdet").val(temp[1]);
					}
				});
				$("#instrument").show();
			} else {
				$("#instrument").hide();
				$("#nazvdet").val('');
			}
		}
	)
	//$("#box").resizable();
	createdialog();
	createdialogfile();
	<?php if(isset ($_POST['showform'])) echo 'opendialog();';?>
	$('#addbutton').focus();
});

$(function(){
jQuery("#detal").jqGrid({
    url:'<?php echo URL::base()?>order/detal',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['detal']);?>"],
   	colModel:[
		<?php foreach($columns['detal'] as $key=>$col){
			echo "{name:'$key',";
			echo "index:'$key',";
			echo "width:'$col[1]',";
			if ($key == 'comment_start'){
				echo "edittype:'textarea',";
				echo "editoptions: {rows:'5',cols:'50'},";
			}
			echo "editable:";
			if($key != 'id') echo "true},\r\n";
			else echo "false},\r\n";
			//echo '},';
		};?>
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    caption: "Детали, которым не присвоен номер заказа",
	//autowidth: true,
	height: "100%",
	editurl: "<?php echo URL::base()?>order/edit",
	multiselect: true,
	gridComplete: function(){
		decorateColumnFile("#detal");
	}
});
//jQuery("#grid").jqGrid('gridResize');

jQuery("#detal").jqGrid('navGrid','#pager',
	{edit:true,add:false,del:true}, //options
	{width:650,
		afterSubmit:function(data_from_server, array_data) {
			var result =data_from_server.responseText.split(';');
			if (result[0] == 'fail') {
				return [false,result[1]]
			} else {
				return [true,result[2]];
			}
		 }
	}, // edit options
	{}, // add options
	{width:320}, // del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600} // search options
	);
});
//jQuery("#detal").jqGrid('gridResize',{minWidth:350,maxWidth:800,minHeight:80, maxHeight:350});

$("#detal").click(function(){
	var gr = jQuery("#detal").jqGrid('getGridParam','selrow');
	alert (gr);
	//if( gr != null ) jQuery("#grid").jqGrid('editGridRow',gr,{height:280,reloadAfterSubmit:false});
	//else alert("Please Select Row");
});

$(function(){
jQuery("#orders").jqGrid({
    url:'<?php echo URL::base()?>order/orders',
    datatype: 'xml',
    mtype: 'POST',
   	colNames:["<?php echo implode('","',$colnames['orders']);?>"],
   	colModel:[
		<?php foreach($columns['orders'] as $key=>$col):?>
		{name:'<?=$key;?>',
			index:'<?=$key;?>',
			width:<?=$col[1];?>,
			editable:<?php
			if($key != 'id') echo 'true';
			else echo 'false'
			?>},
		<?php endforeach;?>
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pagerorders',
   	sortname: 'number',
    viewrecords: true,
    sortorder: "desc",
    caption: "Детали, которым присвоен номер заказа",
	//autowidth: true,
	height: "100%",
	//editurl: "../order/edit",
	multiselect: true,
	gridComplete: function(){
		decorateColumnFile("#orders");
	}
});

jQuery("#orders").jqGrid('navGrid','#pagerorders',
	{edit:false,add:false,del:false}, //options
	{},// edit options
	{},// add options
	{},// del options
	{multipleSearch:true, sopt:['eq','ne','lt','le','gt','ge','bw','bn','ew','en','cn','nc','in','ni'], width:600}// search options
	);
});

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
function createdialog(){
	$("#dialog").dialog({
		title: "Добавление детали",//тайтл, заголовок окна
		width: 750,//ширина
		height: 600,//высота
		modal: true,//true - окно модальное, false - нет
		autoOpen:false,
		close: function(){$('#showform').value="false"}
	});
}
function opendialog(){
	$("#dialog").dialog('open');
}

function createdialogfile(){
	$('#loadfile').dialog({
		title: "Прикрепление файла",//тайтл, заголовок окна
		width: 600,//ширина
		height: 200,//высота
		modal: true,//true - окно модальное, false - нет
		autoOpen:false
	})
}
function opendialogfile(){
	$("#loadfile").dialog('open');
}

function addtoorder(){
	var s=s1=z='';
	s = jQuery("#detal").jqGrid('getGridParam','selarrrow');
	s1= jQuery("#orders").jqGrid('getGridParam','selarrrow');
	if(s1 != 0) z = jQuery("#orders").jqGrid('getCell',s1,'number');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/addtoorder/",
			data: 'ids='+s+'&order='+z,
			type: 'POST',
			cache: false,
			success: function(data){
				$('#detal').trigger('reloadGrid');
				$('#orders').trigger('reloadGrid');
				//$('#startedorders').trigger('reloadGrid');
			}
		});
	}
}
function delfromorder(){
	s = jQuery("#orders").jqGrid('getGridParam','selarrrow');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/delfromorder/",
			data: 'ids='+s,
			type: 'POST',
			cache: false,
			success: function(data){
				$('#detal').trigger("reloadGrid");
				$('#orders').trigger("reloadGrid");
				//$('#startedorders').trigger('reloadGrid');
			}
		});
	}
	//alert(s);
}
function startorder(){
	s = jQuery("#orders").jqGrid('getGridParam','selarrrow');
	if(s != ''){
		$.ajax({
			url: "<?php echo URL::base()?>order/startorder/",
			data: 'ids='+s,
			type: 'POST',
			cache: false,
			success: function(data){
				//$('#detal').trigger("reloadGrid");
				$('#orders').trigger("reloadGrid");
				$('#startedorders').trigger('reloadGrid');
				//alert( "data: " + data );
			}
		});
	}
}
function addfile(){
	var s = jQuery("#detal").jqGrid('getGridParam','selarrrow');
	if(s.length > 1) alert('Файл можно прикрепить только к одной детали');
	else if(s.length < 1) alert('Нужно выбрать к какой детали прикрепить файл');
	else {
		// Выводим диалог выбора файлов, загружаем файлы на сервер...
		$('#selectedrow').val(s);
		opendialogfile();
		//alert('ОК');
	}
}

function showfiles(id){
	$("#showfiles").load('<?php echo URL::base()?>file/showall/'+id).dialog();
	return false;
}
</script>

<h3>Выдача заказов</h3>
<input type="button" onclick="opendialog();" id="addbutton" value="Добавить деталь" />
<input type="button" onclick="addtoorder();" value="Добавить детали в заказ" />
<input type="button" onclick="delfromorder();" value="Удалить детали из заказа" />
<input type="button" onclick="addfile();" value="Прикрепить файл" />
<div id="dialog">
<?php if (isset($errors)): ?>
	<div class="ui-state-error ui-dialog-titlebar ui-corner-all ui-helper-clearfix">
	Ошибка при заполнении полей.</div>
	<br />
<?php endif ?>

<?php
echo form::open(NULL, array('id'=>'formadd'));
?>
<?php foreach ($codifier_instr as $item) {
	$opt[$item['id']]= $item['name'].'     ('.$item['numstart'].')';
}
echo form::select('osin', $opt, $codifier_instr_selected, array('id'=>'osin'));
?>
<table>
	<?php foreach ($form_osn as $field):?>
	<tr>
		<td><?php echo $field['attr']['desc']?></td>
		<td><?php echo form::input($field['name'], $field['value'], $field['attr'])?></td>
		<td style="color:red"><?php if(isset ($errors[$field['name']])) echo $errors[$field['name']]; ?></td>
	</tr>
	<?php endforeach;?>
</table>
<div id="instrument">
<table>
	<?php foreach ($form_ins as $field):?>
		<tr>
			<td><?php echo $field['attr']['desc'];?></td>
			<td><?php echo form::input($field['name'], $field['value'], $field['attr'])?></td>
			<td style="color:red"><?php if(isset ($errors[$field['name']])) echo $errors[$field['name']]; ?></td>
		</tr>
	<?php endforeach;?>
</table>
</div>
<table>
	<?php foreach ($form_all as $field):?>
		<tr>
			<td><?php echo $field['attr']['desc']?></td>
			<td><?php echo form::textarea($field['name'], $field['value'], $field['attr'])?></td>
			<td style="color:red"><?php if(isset ($errors[$field['name']])) echo $errors[$field['name']]; ?></td>
		</tr>
	<?php endforeach;?>
</table>

<table>
	 <tr><td><?php echo form::submit('add','Добавить деталь')?></td><td></td></tr>
</table>
	<input type="hidden" name="showform" id="showform" value="" />
	<?php echo form::close();?>

</div>
<div id="loadfile">
	<?php echo Form::open( 'file/upload', array('id'=>'uploadform','enctype' => 'multipart/form-data' ) );?>
	<?php echo Form::file('userfile',array('size'=>'45'));?>
	Описание файла: <?php echo Form::input('description',NULL,array('size'=>'30'));?>
	<?php echo Form::submit('btnupload', 'Загрузить');?>
	<?php echo Form::hidden('selectedrow', '0', array('id'=>'selectedrow'));?>
	<?php echo Form::hidden('returnurl', 'order/start');?>
	<?php echo form::close();?>
</div>

<div id="showfiles"></div>

<table id="detal"></table>
<div id="pager"></div>
<br />
<table id="orders"></table>
<div id="pagerorders"></div>
<input type="button" onclick="startorder();" value="Выдать заказ" />
<br />
<table id="startedorders"></table>
<div id="pagerstartedorders"></div>
