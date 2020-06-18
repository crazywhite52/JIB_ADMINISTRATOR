 <?php $baseUrl=Yii::app()->request->baseUrl; ?>
 <section class="content-header">
      <h1>
        Manager User
        <small>จัดการสิทธิ์พนักงาน</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Manager User</li>
        <li class="active"> Data User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<?php #echo $data["fullname"].' '.$data["surname"].','.$data["nickname"]?>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูล User</h3>
            </div>
              <div class="box-body">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="form-group">
                  <label for="name" class="col-md-2 control-label text-right">ชื่อผู้ใช้ :</label>
                  <div class="col-md-6">
                    <?php echo CHtml::textField("name", ($data["name"]) ? $data["name"] : null, array("class" => "form-control input-sm")); ?>
                  </div>
                </div>
                  </div>
                <div class="row">
                <div class="form-group">
                  <label for="fullname" class="col-md-2 control-label text-right">ชื่อจริง :</label>
                  <div class="col-md-6">
                    <?php echo CHtml::textField("fullname", ($data["fullname"]) ? $data["fullname"] : null, array("class" => "form-control input-sm")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="surname" class="col-md-2 control-label text-right">นามสกุล :</label>
                  <div class="col-md-6">
                    <?php echo CHtml::textField("surname", ($data["surname"]) ? $data["surname"] : null, array("class" => "form-control input-sm")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="nickname" class="col-md-2 control-label text-right">ชื่อเล่น :</label>
                  <div class="col-md-6">
                    <?php echo CHtml::textField("nickname", ($data["nickname"]) ? $data["nickname"] : null, array("class" => "form-control input-sm")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="depast" class="col-md-2 control-label text-right">แผนก :</label>
                  <div class="col-md-6" style="font-size: 12px;">
                    <?php echo CHtml::dropDownList("depast",($data["depast"]) ? $data["depast"] : null, Centerdb::Depastlist(), array("class" => "form-control input-sm select2")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="job" class="col-md-2 control-label text-right">งาน :</label>
                  <div class="col-md-6" style="font-size: 12px;">
                    <?php echo CHtml::dropDownList("job",($data["job"]) ? $data["job"] : null, Centerdb::Depastlist(), array("class" => "form-control input-sm select2")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="branch" class="col-md-2 control-label text-right">สาขา :</label>
                  <div class="col-md-6" style="font-size: 12px;">
                    <?php echo CHtml::dropDownList("branch",($data["branch"]) ? $data["branch"] : null, Centerdb::listBranch2(), array("class" => "form-control input-sm select2")); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="pass" class="col-md-2 control-label text-right">รหัสผ่านใหม่ :</label>
                  <div class="col-md-6">
                    <input type="password" id="pass" name="pass" class="form-control input-sm" autocomplete="off">
                  </div>
                </div>
              </div>
            <?php $sql="SELECT sysuser.branch,sysuser.branchname FROM sysuser WHERE sysuser.branch='".$data["branch"]."' GROUP BY sysuser.branch ORDER BY sysuser.branch ASC";
                  $re = Yii::app()->db->createCommand($sql)->queryRow();?>
            <input type="hidden" id="branchname" name="branchname" value="<?php echo $re["branchname"]; ?>">
            <input type="hidden" id="ref_user_id" name="ref_user_id" value="<?php echo $data['id']; ?>">
                </div>
                <div class="col-md-2"></div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                 <div class="col-md-5"></div>
                  <div class="col-md-2">
                    <button type="button" id="save_ed" name="save_ed" class="btn btn-block btn-info btn-sm">แก้ไขข้อมูล</button>
                  </div>
                   <div class="col-md-5"></div>
                
                
              </div>
              <!-- /.box-footer -->
          </div>
          <script type="text/javascript">
        $(document).ready(function () {

          var getDatauser = function () {
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'program_id', type: 'int'},
                            {name: 'program_name', type: 'string'}
                        ],
                        url: '<?php echo $this->createUrl("muser/userprogram"); ?>',
                        //id: '',
                        unboundmode: true,
                        cache: false,
                        records: 'content',
                    };
            var dataAdapter = new $.jqx.dataAdapter(source, {
                formatData: function (data) {// ส่ง GET
                    data.ref_user_id = $("#ref_user_id").val();
                    //alert($.param(data));
                    return data;
                }
            });
            return dataAdapter;
        }

          var getDatamanage = function () {
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'program_id', type: 'int'},
                            {name: 'program_name', type: 'string'},
    
                        ],
                        url: '<?php echo $this->createUrl("muser/listprogram"); ?>',
                        //id: '',
                        cache: false,
                        records: 'content',
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);
            return dataAdapter;
        }

              $("#grid1").jqxGrid(
                {
                    source: getDatamanage(),
                    theme: 'metro',
                    width: '100%',
                    //height: resolutionsHeight,
                    enablebrowserselection: true,
                    enabletooltips: true,
                    altrows: true,
                    //selectionmode: 'multiplecellsadvanced',
                    //columnsresize: true,
                    //columnsreorder: true,
                    sortable: true,
                    pageable: true,
                    showfilterrow: true,
                    showstatusbar: true,
                    statusbarheight: 0,
                    //pagesize: 50,
                    pagesizeoptions: ['20', '50', '100'],
                    filterable: true,
                    filtermode: 'simple',
                    selectionmode: 'checkbox',
                            columns: [
                              {text: 'ID',datafield :'program_id', width: '10%', align: 'center',cellsalign: '',},
                              {text: 'รายชื่อโปรแกรมทั้งหมด',datafield :'program_name', width: '30%', align: 'center',cellsalign: ''},
                              {text: 'สถานะโปรแกรม', width: '30%', align: 'center',cellsalign: ''},
                              
                    ]
                });
              $("#grid2").jqxGrid(
                {
                    source: getDatauser(),
                    theme: 'metro',
                    width: '100%',
                    //height: resolutionsHeight,
                    enablebrowserselection: true,
                    enabletooltips: true,
                    altrows: true,
                    //selectionmode: 'multiplecellsadvanced',
                    columnsresize: true,
                    columnsreorder: true,
                    sortable: true,
                    pageable: true,
                    showfilterrow: true,
                    showstatusbar: true,
                    statusbarheight: 0,
                    pagesize: 50,
                    pagesizeoptions: ['20', '50', '100'],
                    filterable: true,
                    filtermode: 'simple',
                    selectionmode: 'checkbox',
                            columns: [
                              /*{text: 'ID',datafield :'program_id', width: '10%', align: 'center',cellsalign: ''},*/
                              {text: 'ตั้งค่า',datafield :'program_id', width: '10%', align: 'center',cellsalign: '',cellsrenderer: function (row) {
          var dataread = $('#grid2').jqxGrid('getrowdata',row);
          var program_id = dataread.program_id;
          return '<button style="" class="btn btn-block btn-success btn-flat" id="' + program_id + '"  onClick="buttonclick(event)" >'+'คลิก'+'</button>';
          }},
                              {text: 'รายชื่อโปรแกรมที่ใช้อยู่',datafield :'program_name', width: '30%', align: 'center',cellsalign: ''},
                              {text: 'สถานะโปรแกรม', width: '30%', align: 'center',cellsalign: ''},
                              
                    ]
                });
        $('#backward').on('click', function (event) {

        var selectindex=$('#grid1').jqxGrid('getselectedrowindexes');
        var rowindex=selectindex.length;

        if(rowindex>0){
        var addRow=new Array();
        for(var i=0; i<rowindex; i++){
          if(selectindex[i] != -1){
            var id = $("#grid1").jqxGrid('getrowid', selectindex[i]);
            var datafield=$('#grid1').jqxGrid('getrowdata', selectindex[i]);

            var rows={};
            rows['program_id']=datafield.program_id;
            rows['program_name']=datafield.program_name;

            addRow.push(rows);
            //swal(datafield.personal_id);
          }
        }

        $('#grid2').jqxGrid('addrow',null,addRow);
        $("#grid1").jqxGrid('deleterow', id);
        $('#grid1').jqxGrid('clearselection');

      }else{
        swal("กรุณาเลือก พนักงานที่ต้องการ ADD","You clicked the button!", "error");
        return false;
      }
    

        });

        $('#forward').on('click', function (event) {
        var selectindex=$('#grid2').jqxGrid('getselectedrowindexes');
        var rowindex=selectindex.length;

         if(rowindex>0){
          var addRow=new Array();
          for(var i=0; i<rowindex; i++){
          if(selectindex[i] != -1){
            var id = $("#grid2").jqxGrid('getrowid', selectindex[i]);
            var datafield=$('#grid2').jqxGrid('getrowdata', selectindex[i]);
            var rows={};
            rows['program_id']=datafield.program_id;
            rows['program_name']=datafield.program_name;

            addRow.push(rows);

          }
        }
          $("#grid2").jqxGrid('deleterow', id);
          $('#grid2').jqxGrid('clearselection');

      }else{
        swal('กรุณาเลือก พนักงานที่ต้องการตั้งค่า');
        return false;
      }

      });

      $('#save').on('click', function (event) {
        $.post('<?php echo $this->createUrl("muser/delprogram"); ?>', { ref_user_id :$("#ref_user_id").val()}, function(data, textStatus, xhr) {});
        var rowindex=$('#grid2').jqxGrid('getdatainformation').rowscount;
        if(rowindex>0){
          for (var i = 0; i < rowindex; i++) {
            var datafield=$('#grid2').jqxGrid('getrowdata', i);
            var rows={};
            rows['program_id']=datafield.program_id;
            rows['ref_user_id']=$("#ref_user_id").val();
            //rows['status']=2; //add

            setTimeout(function(rows,point){
              return function(){
                $.post('<?php echo $this->createUrl("muser/savelistpro"); ?>', $.param(rows), function(data, textStatus, xhr) {
                  if(point==(rowindex-1)){
                    //$("#staff2").jqxGrid({ source: getAdapter2()});
                  }
                });
              }
            }(rows,i),150*i);
            swal({
                  title: "ยืนยันการบันทึกข้อมูล",
                  text: "Submit to save",
                  type: "info",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  showLoaderOnConfirm: true
                }, function () {
                  swal("Save is success!", "You clicked the button!", "success");
                  setTimeout(function () {
                     $("#grid2").jqxGrid({ source: getDatauser()});
                    location.reload();
                  }, 2000);
                });

            //swal("Save is success!", "You clicked the button!", "success");
            //location.reload();
        }
        //swal($.param(rows));
      }

      });    

  });
    </script>
          <div class="row">
          <div class="col-md-5">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">user</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div id="grid2"></div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-2">
            <button type="button" id="backward" class="btn btn-block btn-warning "><i class="fa fa-fw fa-backward"></i></button>
            <button type="button" id="forward" class="btn btn-block btn-warning "><i class="fa fa-fw fa-forward"></i></button>
        <br><br><br><br>
              <div align="center">
                <button type="button" id="save" class="btn btn-block btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
      
              </div>
              
         
            
          </div>
          <div class="col-md-5">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div id="grid1"></div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
</div>
    </section>
  <script>
    var buttonclick = function (event) {
      //function PopupCenterDual(url, title, w, h) {
// Fixes dual-screen position Most browsers Firefox
var w =800;
var h =500;
var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

var left = ((width / 2) - (w / 2)) + dualScreenLeft;
var top = ((height / 2) - (h / 2)) + dualScreenTop;

var program_id = event.target.id;
var title="notes";
var url = "http://172.18.0.30/admin2018/index.php/muser/popupmanage?program_id="+program_id+'&id='+'<?php echo $data['id'] ?>';
var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

// Puts focus on the newWindow
if (window.focus) {
    newWindow.focus();
  }
//}

                /*var program_id = event.target.id;
                window.open("http://mis-archimedes/admin2018/index.php/muser/popupmanage?proid="+program_id, "notes", 'width=1024,height=650,scrollbars=yes');*/
            }

  $(function () {
    $('#save_ed').click(function () {
          var id = $('#ref_user_id').val();
          var name = $('#name').val();
          var fullname = $('#fullname').val();
          var surname = $('#surname').val();
          var nickname = $('#nickname').val();
          var depast = $('#depast').val();
          var job = $('#job').val();
          var branch = $('#branch').val();
          var branchname = $('#branchname').val();
          var password = $('#pass').val();


          $.post("<?php echo $this->createUrl("muser/updatauser"); ?>", { save:"true",id: id, name: name ,fullname : fullname,surname:surname,nickname:nickname,depast:depast,job:job,branch:branch,branchname:branchname,password:password })
          .done(function( data,status ) {
          if(data=='Message sent!'){
            swal("Update Data!", "Save is success!", "success");
            setTimeout(function () {
              
              location.reload();
            }, 2000);
          }else{
            swal("Update Error!", "You clicked the button!", "error");
            location.reload();
          }
        });

      });
  });
  </script>