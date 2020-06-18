<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script>
$(document).ready(function () {
    var photodelete = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/klist/Delete-icon.png';
        var img = '<a href="javascript:deleteList(\''+datafield['menu_id']+'\',\''+datafield['program_id']+'\')" onclick="return confirm(\'คุณต้องการลบรายการนี้หรือไม่\');"><div  style=""><img style="margin:5px; margin-left: 20px;" width="30" height="30"   src="' + imgurl + '"></div></a>';
        return img;
    }
    var photoedit = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/klist/edit-file-icon.png';
        var url='<?php echo $this->createUrl("mprogram/menulist"); ?>'+'/id/'+datafield['program_id']+'/menu_id/'+datafield['menu_id'];
        var img = '<a href="'+url+'"><div style=""><img style="margin:5px; margin-left: 20px;" width="30" height="30"   src="' + imgurl + '"></div></a>';
        return img;
    }
    
    $("#idg").jqxGrid(
            {
                width: '100%',
                source: getAdapter(),
                rowsheight: 40,
                height: 400,
                theme: 'metrodark',
                // pageable: true,
                // autoheight: true,
                // sortable: true,
                // altrows: true,
                // enabletooltips: true,
                // editable: true,
                // selectionmode: 'multiplecellsadvanced',
                columns: [
                  { text: 'ยกเลิก', cellsrenderer: photodelete, align: 'center',width: 80 },
                  { text: 'แก้ไข', cellsrenderer: photoedit ,align: 'center', width: 80 },
                  { text: 'ลำดับที่',  datafield: 'menu_id', align: 'center',width: 80,cellsalign:'center' },
                  { text: 'ชื่อเมนู', datafield: 'menu_name',  align: 'center', },
                  { text: 'การใช้งาน', datafield: 'menu_cancel',align: 'center',width: 80,cellsalign:'center' }
                ],
                });

        $('#btsearch').click(function(event) {
            $("#idg").jqxGrid({source: getAdapter()});
        });
});

function getAdapter(){
    var source =
    {
        datatype: "json",
        datafields: [
        { name: 'menu_id', type: 'int'},
        { name: 'program_id', type: 'int' },
        { name: 'menu_name', type: 'string' },
        { name: 'menu_cancel', type: 'string' }
        ],
        data:{id:'<?php echo $id; ?>'},
        cache: false,
        url: '<?php echo $this->createUrl("mprogram/menudatabase"); ?>',
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    return dataAdapter;
}


function deleteList(menu_id,program_id) {
    // alert(menu_id);
    $.post('<?php echo $this->createUrl("mprogram/deletemenu"); ?>', {menu_id: menu_id,program_id: program_id}, function(response) {
    $("#idg").jqxGrid({source: getAdapter()});
    });
}

</script>
<section class="content-header">
      <h1>
        Manager Menu
        <small>จัดการเมนูโปรแกรม</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manager Menu</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
<div class="row">
	<div class="col-md-4 col-xs-4 col-lg-4">
		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">เพิ่มเมนู</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form role="form" method="post" action="<?php echo $this->createURL('mprogram/datamenu')?>" >
                <?php echo CHtml::hiddenField("menu_id",($menu_id)?$menu_id:null,array()); ?>
                <?php echo CHtml::hiddenField("program_id",($id)?$id:null,array()); ?>
                <!-- text input -->
                <div class="form-group">
                  <label>ชื่อเมนู</label>
                  <?php echo CHtml::textField("menu_name",($data["menu_name"])?$data["menu_name"]:null, array("class" => "form-control", "placeholder" => "ชื่อโปรแกรม")); ?>
                </div>
                <!-- select -->
                <div class="form-group">
                  <label>สถานะการใช้งาน</label>
                  <?php echo CHtml::dropDownList("menu_cancel", null, array('1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน'), array("class" => "form-control"));?>
                </div>
                <button type="submit" name="save" id="save" value="save" class="btn btn-block btn-info"><i class="fa fa-fw fa-save"></i> บันทึก</button>
              </form>
        

            </div>
            <!-- /.box-body -->
          </div>
	</div>
	<div class="col-md-8 col-xs-8 col-lg-8">
			<div id="idg">
		</div>
	</div>
</div>

    </section>
