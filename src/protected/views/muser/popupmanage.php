 <?php $baseUrl=Yii::app()->request->baseUrl; ?>
 <script src="<?php echo $baseUrl;?>/assets/jquery-2.1.4.min.js"></script>
 <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.base.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.energyblue.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.ui-smoothness.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.metrodark.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.bootstrap.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.metro.css"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcore.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxbuttons.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxchart.core.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdraw.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdata.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxeditor.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxscrollbar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmenu.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxinput.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcheckbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxlistbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdropdownlist.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdatetimeinput.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcalendar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxwindow.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.sort.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.edit.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.storage.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.selection.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.filter.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsresize.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsreorder.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.pager.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.grouping.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.aggregates.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxtooltip.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/globalization/globalize.js"); ?>
 <script type="text/javascript">
        $(document).ready(function () {
   			var data = '';
            var source =
            {
                
                datatype: "json",
                datafields:
                [
                	{ name: 'no', type: 'int' },
                    { name: 'menu', type: 'int'},
                	{ name: 'menu_id', type: 'int'},
                    { name: 'menu_name', type: 'string' },
                    { name: 'views', type: 'tinyint' },
                    { name: 'creates', type: 'tinyint' },
                    { name: 'edits', type: 'tinyint' },
                    { name: 'deletes', type: 'tinyint' },
                    { name: 'approves', type: 'tinyint' },
                    { name: 'printed', type: 'tinyint' }
                ],
                url: '<?php echo $this->createUrl("muser/dataacc"); ?>',
                updaterow: function (rowid, rowdata, commit) {
                	var rows = {};
                		rows['menu_name'] = true;
                        rows['program_id'] = $("#program_id").val();
                        rows['id'] = $("#id").val();
                        rows['menu'] = rowdata.menu;
                		rows['menu_id'] = rowdata.menu_id;
                		rows['views']	= rowdata.views;
                		rows['creates']	= rowdata.creates;
                		rows['edits']	= rowdata.edits;
                		rows['deletes']	= rowdata.deletes;
                		rows['approves']= rowdata.approves;
                		rows['printed']	= rowdata.printed;
                		//alert($.param(rows));
	                	$.post('<?php echo $this->createUrl("muser/editaccess"); ?>', $.param(rows), function(data, textStatus, xhr) {
	                    commit(true);
                    });
                }
            };
            var dataAdapter = new $.jqx.dataAdapter(source,{
            	formatData: function (data) {// ส่ง GET
                    data.program_id = $("#program_id").val();
                    data.id = $("#id").val();
                    return data;
                }
            });
            // initialize jqxGrid
            $("#jqx_acc").jqxGrid(
            {
                width: '100%',
                theme: 'bootstrap',
                height: 450,
                source: dataAdapter,
                editable: true,
                sortable: true,
                filterable: true,
                enabletooltips: true,
                selectionmode: 'multiplecellsadvanced',
                columns: [
                 	{ text: 'No', datafield: 'no',editable: false, width: '5%' },
                    { text: 'hdMenu', datafield: 'menu', hidden: true },
	                { text: 'Menu', datafield: 'menu_name',editable: false, width: '35%' },
	                { text: 'View', datafield: 'views', columntype: 'checkbox', width: '10%' },
	                { text: 'Create', datafield: 'creates', columntype: 'checkbox', width: '10%' },
	                { text: 'Edit', datafield: 'edits', columntype: 'checkbox', width: '10%' },
	                { text: 'Delete', datafield: 'deletes', columntype: 'checkbox', width: '10%' },
	                { text: 'Approve', datafield: 'approves', columntype: 'checkbox', width: '10%' },
	                { text: 'Print', datafield: 'printed', columntype: 'checkbox', width: '10%' },
                ]
            });
        });
</script>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>สิทธฺ์พนักงาน</title>
<body>


<div class="w3-row-padding">

<?php echo CHtml::hiddenField("program_id", $_GET['program_id']); ?>
			<?php echo CHtml::hiddenField("id", $_GET['id']); ?>
			<div id="jqx_acc"></div>

</div>

</body>
</html>

