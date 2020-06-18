<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<style type="text/css" media="screen">
 .color1, .jqx-widget .color1 {
     color: black;
     background-color: #99FFCC;
  }
  .color2, .jqx-widget .color2 {
     color: black;
     background-color: orange;
  }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        if (screen.height >= 1080) {
            wgheigth = 630;
        } else if (screen.height >= 768) {
            wgheigth = 400;
        } else if (screen.height >= 720) {
            wgheigth = 400;
        }
        var photodel = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
	        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/dry_icons/user_remove.png';
	        var url = '<?php echo $this->createUrl("muser/deluser"); ?>'+'/id/'+datafield['id'];
	        var img = '<a href="'+url+'"><div style="background: ;"><img style="margin-top: 3px;margin-left: 15px;margin-right: 15px;" width="20" height="20" src="' + imgurl + '"></div></a>';
	        return img;
	    }
	 	var photoedit = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
	        var imgurl = '<?php echo Yii::app()->request->baseUrl;?>/images/dry_icons/user_add.png';
	        var url = '<?php echo $this->createUrl("muser/manageuser"); ?>'+'/id/'+datafield['id'];
	        var img = '<a href="'+url+'"><div style="background: ;"><img style="margin-top: 3px;margin-left: 15px;margin-right: 15px;" width="20" height="20" src="' + imgurl + '"></div></a>';
	        return img;
	    }
	    var workstat = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        if(value=='user'){
            return "color1";
        }else if(value=='admin'){
            return "color2";
        }
            return "";
    }

        var getDatamanage = function () {
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'id', type: 'int'},
                            {name: 'name', type: 'string'},
                            {name: 'FullName', type: 'string'},
                            {name: 'branchname', type: 'string'},
                            {name: 'branch', type: 'string'},
                            {name: 'depast', type: 'string'},
                            {name: 'job', type: 'string'},
                            {name: 'access_name', type: 'string'}
                        ],
                        url: '<?php echo $this->createUrl("muser/mdata"); ?>',
                        cache: false,
                        records: 'content',
                    };
            var dataAdapter = new $.jqx.dataAdapter(source, {
                formatData: function (data) {
                    data.branch = $("#branch").val();
                    data.name_id = $("#name_id").val();
                    data.depast = $("#depast").val();
                    data.job = $("#job").val();
                    data.fname = $("#fname").val();
                    return data;
                }
            });
            return dataAdapter;
        }
       
        $("#jqx_manage").jqxGrid(
                {
                    theme: 'metrodark',
                    width: '100%',
                    height: wgheigth,
                    pageable: true,
                    sortable: true,
                    pagesize: 20,
                    columnsresize: true,
                    columns: [
                    	{text: 'ลบ',  width: '5%' , align: 'center',cellsalign:'center', cellsrenderer: photodel },
                     	{text: 'แก้ไข',  width: '5%' , align: 'center',cellsalign:'center', cellsrenderer: photoedit },
                        {text: 'รหัสพนักงาน', datafield: 'name', width: '10%', align: 'center'},
                        {text: 'ชื่อ-นามสกุล', datafield: 'FullName', align: 'center'},
                        {text: 'สาขา', datafield: 'branchname', width: '20%', align: 'center'},
                        {text: 'แผนก', datafield: 'depast', width: '20%', align: 'center'},
                        {text: 'งาน', datafield: 'job', width: '20%', align: 'center'},
                        {text: 'สิทธิ', datafield: 'access_name',cellsalign:'center', align: 'center',cellclassname:workstat}

                    ]
                });

        $('#name_id').keyup(function (event) {
            $("#name_id").val($("#name_id").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });
        $('#branch').keyup(function (event) {
            $("#branchname").val($("#branch").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });
        $("#branchname").change(function (event) {
            $("#branch").val($("#branchname").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });
        $("#depast").change(function (event) {
            $("#depast").val($("#depast").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });
        $("#job").change(function (event) {
            $("#job").val($("#job").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });
        $("#fname").keyup(function (event) {
            $("#fname").val($("#fname").val());
            $("#jqx_manage").jqxGrid({source: getDatamanage()});
        });

    });
</script>
    <section class="content-header">
      <h1>
        Manager User
        <small>จัดการสิทธิ์พนักงาน</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manager User</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">ค้นหาข้อมูล</h3>
        </div>
        <div class="box-body">
        	<div class="row">
                <div class="col-md-2 col-xs-4">
                  <input type="text" class="form-control " id="name_id" name="name_id" style="" placeholder="รหัสพนักงาน" autocomplete="off">
                </div>
                <div class="col-md-2 col-xs-6">
                  <input type="text" class="form-control " id="fname" name="fname" style="" placeholder="ชื่อ">
                </div>
                <div class="col-md-2 col-xs-4">
                  <input type="text" class="form-control " id="branch" name="branch" style="" placeholder="Branch No.">
                </div>
                <div class="col-md-2 col-xs-6">
                  <?php echo CHtml::dropDownList("branchname",null, Centerdb::listBranch2(), array("class" => "form-control")); ?>
                </div>
                <div class="col-md-2 col-xs-6">
                  <?php echo CHtml::dropDownList("depast",null, Centerdb::Depastlist(), array("class" => "form-control")); ?>
                </div>
                <div class="col-md-2 col-xs-6">
                  <?php echo CHtml::dropDownList("job",null, Centerdb::Joblist(), array("class" => "form-control")); ?>
                </div>
              </div>
              <br>
<div class="row">
	<div class="col-md-12 col-xs-12 col-lg-12">
        	<div id="jqx_manage">
        		<div class="col-md-1 col-xs-4">
        		</div>
        	</div>
        
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
    <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>