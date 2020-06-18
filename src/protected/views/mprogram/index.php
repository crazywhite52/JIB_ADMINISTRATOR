<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script>
$(document).ready(function () {
	if(screen.height>=1920){
            var resolutionsHeight="780";
          }else if(screen.height==1080){
            var resolutionsHeight="620";
          }else if(screen.height==900){
            var resolutionsHeight="500";
          }else if(screen.height==768){
            var resolutionsHeight="450";
          }else  if(screen.height==720){
            var resolutionsHeight="350";
          }else{
            var resolutionsHeight="450";
          }
    var photodelete = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/klist/Delete-icon.png';
        var img = '<a href="javascript:deleteList(\''+datafield['id']+'\')" onclick="return confirm(\'คุณต้องการลบรายการนี้หรือไม่\');"><div align="center" style="background: ;"><img style="margin-top: 7px;" width="20" height="20"   src="' + imgurl + '"></div></a>';
        return img;
    }
    var photoedit = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/klist/edit-file-icon.png';
        var url='<?php echo $this->createUrl("index"); ?>'+'/id/'+datafield['id'];
        var img = '<a href="'+url+'"><div align="center" style="background: ;"><img style="margin-top: 7px;" width="20" height="20"   src="' + imgurl + '"></div></a>';
        return img;
    }
    var photoview = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/permission_icon.jpg';
        var url='<?php echo $this->createUrl("mprogram/menulist"); ?>'+'/id/'+datafield['id'];
        var img = '<a href="'+url+'"><div align="center" style="background: ;"><img style="margin-top: 7px;" width="20" height="20"   src="' + imgurl + '"></div></a>'; 
        return img;
    }

    $("#idg").jqxGrid(
            {
                theme: 'metrodark',
                width: '100%',
                height: resolutionsHeight,
                source: getAdapter(),
                rowsheight: 32,                
                pageable: false,
                /*autoheight: true,*/
                showfilterrow: true,
                filterable: true,
                sortable: true,
                altrows: true,
                pageable: true,
                pagermode: 'simple',
                pagesize: 20,

                //enabletooltips: true,
                // editable: true,
                columns: [
                  { text: 'ลบข้อมูล', cellsrenderer: photodelete,align: 'center',width: '7%',filterable: false, },
                  { text: 'แก้ไข',  cellsrenderer: photoedit,  align: 'center', width: '7%',filterable: false, },
                  { text: 'กำหนดสิทธิ์', cellsrenderer:photoview, align: 'center' , width: '7%',filterable: false, },
                  { text: 'ลำดับที่', datafield: 'id',  width: '5%',align: 'center',cellsalign:'center' },
                  { text: 'ชื่อโปแกรม' , datafield: 'program_name',align: 'center' },
                  { text: 'เพิ่มเติม', datafield: 'program_text',align: 'center',width:'25%' },
                  { text: 'สถานะใช้งาน', datafield: 'program_user',align: 'center', width:'15%',cellsalign:'center',filtertype: 'checkedlist', }
                ]
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
            { name: 'id', type: 'int'},
            { name: 'program_name', type: 'string' },
            { name: 'program_text', type: 'string' },
            { name: 'program_user', type: 'string' }
            ],
        cache: false,
        url: '<?php echo $this->createUrl("mprogram/prodate"); ?>',
        };
    var dataAdapter = new $.jqx.dataAdapter(source,
        {
            formatData: function (data) {
                data.program_name = $("#program_name").val();
                return data;
            }
        });
    return dataAdapter;
    };

function deleteList(id) {
    // alert(menu_id);
    $.post('<?php echo $this->createUrl("mprogram/deletelist"); ?>', { id: id }, function(response) {
    $("#idg").jqxGrid({source: getAdapter()});
    });
}


</script>
</script>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manager Program
        <small>การจัดการโปรแกรมต่างๆ</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manager Program</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">
<div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">เพิ่มโปรแกรม</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form role="form" method="post" action="<?php echo $this->createURL('mprogram/dataprogram')?>" >
                <?php echo CHtml::hiddenField("id",($data["id"])?$data["id"]:null,array()); ?>
                <!-- text input -->
                <div class="form-group">
                  <label>ชื่อโปรแกรม</label>
                  <?php echo CHtml::textField("program_name",($data["program_name"])?$data["program_name"]:null, array("class" => "form-control", "placeholder" => "ชื่อโปรแกรม")); ?>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>รายละเอียดเพิ่มเติม</label>
                  <?php echo CHtml::textArea("program_text", ($data["program_text"])?$data["program_text"]:null, array("class" => "form-control", "cols" => 60, "rows" => 3, "placeholder" => "รายละเอียดเพิ่มเติม")); ?>
                </div>
                <!-- select -->
                <div class="form-group">
                  <label>สถานะการใช้งาน</label>
                  <?php echo CHtml::dropDownList("program_user", ($data["program_user"])?$data["program_user"]:null, array('1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน'), array("class" => "form-control"));?>
                </div>
                <button type="submit" name="save" id="save" value="save" class="btn btn-block btn-info"><i class="fa fa-fw fa-save"></i> บันทึก</button>
              </form>
        

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-8">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">รายการโปรแกรม</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="idg"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
    </section>
