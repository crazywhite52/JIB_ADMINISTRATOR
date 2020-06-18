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
  <div class="row">
   <div class="col-xs-6 col-md-6">
     <div class="box box-success">
      <div class="box-body">
        <div class="row">
          <div class="col-xs-2">
            <div class="form-group has-success">
              <label>ID USER</label>
              <input type="text" class="form-control" id="name" value="<?php echo ($data["name"]) ? $data["name"] : null ?>" placeholder="...">
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group has-success">
              <label>ชื่อจริง</label>
              <input type="text" class="form-control" id="fullname" value="<?php echo ($data["fullname"]) ? $data["fullname"] : null ?>" placeholder="...">
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group has-success">
              <label>นามสกุล</label>
              <input type="text" class="form-control" id="surname" value="<?php echo ($data["surname"]) ? $data["surname"] : null ?>" placeholder="...">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group has-success">
              <label>ชื่อเล่น</label>
              <input type="text" class="form-control" id="nickname" value="<?php echo ($data["nickname"]) ? $data["nickname"] : null ?>" placeholder="...">
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-xs-4">
          <div class="form-group has-success">
            <label>รหัสผ่านใหม่</label>
            <input type="password" id="pass" name="pass" class="form-control input-sm" autocomplete="off">
          </div>
        </div>
        <div class="col-xs-4">
          <div class="form-group has-success">
            <label>งาน</label>
            <?php echo CHtml::dropDownList("job",($data["job"]) ? $data["job"] : null, Centerdb::Depastlist(), array("class" => "form-control input-sm select2")); ?>
          </div>
        </div>
        <div class="col-xs-4">
          <div class="form-group has-success">
            <label>แผนก</label>
            <?php echo CHtml::dropDownList("depast",($data["depast"]) ? $data["depast"] : null, Centerdb::Depastlist(), array("class" => "form-control select2")); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="form-group has-success">
            <label>สาขา</label>
            <?php echo CHtml::dropDownList("branch",($data["branch"]) ? $data["branch"] : null, Centerdb::listBranch2(), array("class" => "form-control input-sm select2")); ?>
          </div>
        </div>
      </div>
      <?php $sql="SELECT branch,branchname FROM branch WHERE branch='".$data["branch"]."' ";
      $re = Yii::app()->db->createCommand($sql)->queryRow();?>
      <input type="hidden" id="branchname" name="branchname" value="<?php echo trim($re["branchname"]); ?>">
      <input type="hidden" id="ref_user_id" name="ref_user_id" value="<?php echo $data['id']; ?>">
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

      <button type="button" id="save_ed" name="save_ed" class="btn btn-block btn-success btn-sm"><i class="fa fa-fw fa-save"></i> แก้ไขข้อมูล</button>

    </div>
    <!-- /.box-footer -->
  </div>
</div>
<div class="col-xs-6 col-md-6">
  <div class="box box-success">
    <div class="box-body">
     <div class="row">
      <div class="col-xs-6 col-md-6">
        <div class="form-group has-success">
          <label>รายชื่อโปรแกรม</label>
          <?php echo CHtml::dropDownList("project",null, Centerdb::Projectlist(), array("class" => "form-control input-sm select2")); ?>
        </div>
      </div>
      <div class="col-xs-2 col-md-2">
        <div class="form-group has-success">
          <label>บันทึก</label>
          <button type="button" id="addpro" class="btn btn-block btn-success btn-sm"><i class="fa fa-fw fa-toggle-down"></i> ADD</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div id="grid1"></div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</section>


<script type="text/javascript">
  $(document).ready(function () {
   $('#addpro').on('click', function (event) {
    var project = $("#project").val();
    var rowindex=$('#grid1').jqxGrid('getdatainformation').rowscount;
    //alert(rowindex);
    if(rowindex>0){
      for (var i = 0; i < rowindex; i++) {
        var datafield=$('#grid1').jqxGrid('getrowdata', i);
        if(datafield.program_id==project){
          swal("มีโปรแกรมนี้แล้ว!", "You clicked the button!", "error");
          return false;
        }
      }
      
    }
    //alert($("#project").val());
    

    $.post('<?php echo $this->createUrl("manageuser/projectlist") ?>', {project: project}, function (data) {
      var varsplit = data.split("||");

      if (varsplit[0] == '') {
        swal("กรุณาเลือกโปรแกรม", "You clicked the button!", "error");
        return false;
      }
      var program_id = varsplit[0];
      var program_name = varsplit[1];
      var program_text = varsplit[2];
      var program_user = varsplit[3];
      if(program_user==1){
        var st='เปิดใช้งาน';
      }else{
        var st='ปิดใช้งาน';
      }

      var rows={};
      rows['program_id']=program_id;
      rows['program_name']=program_name;
      rows['program_text']=program_text;
      rows['program_user']=st;
      $("#grid1").jqxGrid('addrow', null, rows);

      var rowsed={};
      rowsed['program_id']=program_id;
      rowsed['ref_user_id']=$("#ref_user_id").val();
      $.post("<?php echo $this->createUrl("manageuser/addprogram"); ?>", $.param(rowsed))
      .done(function( data,status ) {
        if(data=='Message sent!'){
         swal("Update Data!", "Save is success!", "success");
         setTimeout(function () {

          location.reload();
        }, 1500);
       }else{
        swal("Update Error!", "You clicked the button!", "error");
        location.reload();
      }
    });

    });


  });
   var getDatamanage = function () {
    var source =
    {
      datatype: "json",
      datafields: [
      {name: 'program_id', type: 'string'},
      {name: 'program_name', type: 'string'},
      {name: 'program_text', type: 'string'},
      {name: 'program_user', type: 'string'}
      ],
      url: '<?php echo $this->createUrl("manageuser/prouser"); ?>',
      cache: false,
      records: 'content',
    };
    var dataAdapter = new $.jqx.dataAdapter(source, {
      formatData: function (data) {
        data.id = '<?php echo $_GET['id']; ?>';
        return data;
      }
    });
    return dataAdapter;
  }


  $("#grid1").jqxGrid(
  {
    source: getDatamanage(),
    theme: 'metro',
    width: '100%',
    height: '670',
    pagesize: 50,
    pagesizeoptions: ['50', '100'],
    showfilterrow: true,
    filterable: true,
    altrows: true,
    columnsresize: true,
    columnsreorder: true,
    sortable: true,
    pageable: true,
    showstatusbar: true,
    statusbarheight: 0,
    columns: [
    {text: 'ID',datafield :'program_id', width: '5%', align: 'center',cellsalign: 'center',},
    {text: 'รายชื่อโปรแกรมทั้งหมด',datafield :'program_name', width: '30%', align: 'center',cellsalign: 'left'},
    {text: 'title',datafield :'program_text', width: '30%', align: 'center',cellsalign: 'left'},
    {text: 'สถานะโปรแกรม',datafield:'program_user', width: '15%', align: 'center',cellsalign: 'center'},
    {text: 'สิทธิ์', width: '10%', align: 'center',cellsalign: '',cellsrenderer: function (row) {
      var dataread = $('#grid1').jqxGrid('getrowdata',row);
      var program_id = dataread.program_id;
      return '<button style="padding-top: 1px;padding-bottom: 6px;margin-top: 1px;margin-left: 1px;margin-right: 1px;" class="btn btn-block btn-warning btn-flat" id="' + program_id + '"  onClick="gotoNode('+dataread.program_id+')" >'+'<i class="fa fa-fw fa-check-square"></i>'+'</button>';
    }},
    {text: '#', editable: false, align: 'center',  width: '10%',cellsalign:'center',columntype: 'button',cellsrenderer: function (row) {return 'ลบ'},
    buttonclick: function (row) {
      var dataread = $('#grid1').jqxGrid('getrowdata',row);
      var program_id = dataread.program_id;
      var ref_user_id = $("#ref_user_id").val();
        //alert(id);
        var data = "&ref_program_id="+program_id+"&ref_user_id="+ref_user_id;
        swal({
          title: "ต้องการลบใช่หรือไม่?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          $.ajax({
            type: "POST",
            url: "<?php echo $this->createUrl("manageuser/delpro"); ?>",
            data: data,
            success: function(data, status, xhr) {
              location.reload();
              //$("#grid1").jqxGrid({source: dataAdapter});
                      //alert(data);  
                      commit(true);
                    }
                  });
          swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
      }},
      ]
    });
});
</script>
<!-- <script type="text/javascript">
  $(document).ready(function () {

    var getDatauser = function () {
      var source =
      {
        datatype: "json",
        datafields: [
        {name: 'program_id', type: 'int'},
        {name: 'program_name', type: 'string'},
        {name: 'program_text', type: 'string'}
        
        ],
        url: '<?php echo $this->createUrl("manageuser/userprogram"); ?>',
        unboundmode: true,
        cache: false,
        records: 'content',
      };
      var dataAdapter = new $.jqx.dataAdapter(source, {
        formatData: function (data) {
          data.ref_user_id = $("#ref_user_id").val();
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
        {name: 'program_user', type: 'int'},
        {name: 'program_name', type: 'string'},
        {name: 'program_text', type: 'string'},
        ],
        url: '<?php echo $this->createUrl("manageuser/listprogram"); ?>',
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
      enablebrowserselection: true,
      enabletooltips: true,
      altrows: true,
      sortable: true,
      //pageable: true,
      showfilterrow: true,
      showstatusbar: true,
      statusbarheight: 0,
      //pagesizeoptions: ['20', '50', '100'],
      filterable: true,
      filtermode: 'simple',
      selectionmode: 'checkbox',
      columns: [
      {text: 'ID',datafield :'program_id', width: '10%', align: 'center',cellsalign: '',},
      {text: 'รายชื่อโปรแกรมทั้งหมด',datafield :'program_name', width: '30%', align: 'center',cellsalign: ''},
      {text: 'title',datafield :'program_text', width: '30%', align: 'center',cellsalign: ''},
      {text: 'สถานะโปรแกรม',datafield:'program_user', width: '20%', align: 'center',cellsalign: 'center'},

      ]
    });
    $("#grid2").jqxGrid(
    {
      source: getDatauser(),
      theme: 'metro',
      width: '100%',
      enablebrowserselection: true,
      enabletooltips: true,
      altrows: true,
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
      {text: 'ตั้งค่า',datafield :'program_id', width: '10%', align: 'center',cellsalign: '',cellsrenderer: function (row) {
        var dataread = $('#grid2').jqxGrid('getrowdata',row);
        var program_id = dataread.program_id;
        return '<button style="" class="btn btn-block btn-success btn-flat" id="' + program_id + '"  onClick="buttonclick(event)" >'+'คลิก'+'</button>';
      }},
      {text: 'รายชื่อโปรแกรมที่ใช้อยู่',datafield :'program_name', width: '30%', align: 'center',cellsalign: ''},
      {text: 'title',datafield :'program_text', width: '30%', align: 'center',cellsalign: ''},
      {text: 'สถานะโปรแกรม', width: '20%', align: 'center',cellsalign: ''},

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
        var rowsd={};
        rowsd['program_id']=datafield.program_id;
        rowsd['ref_user_id']=$("#ref_user_id").val();
        $.post('<?php echo $this->createUrl("manageuser/delprogram"); ?>', $.param(rowsd), function(data, textStatus, xhr) {});
        //alert(datafield.program_id);
        
        swal("Save is success!", "You clicked the button!", "success");
        setTimeout(function () {
         $("#grid2").jqxGrid('deleterow', id);
         $('#grid2').jqxGrid('clearselection');
         location.reload();
       }, 2000);

      }else{
        swal('กรุณาเลือก พนักงานที่ต้องการตั้งค่า');
        return false;
      }

    });

    $('#save').on('click', function (event) {

      var selectindex=$('#grid2').jqxGrid('getselectedrowindexes');
      var rowindex1=selectindex.length;

      if(rowindex1>0){
        var addRow=new Array();
        for(var i=0; i<rowindex1; i++){
          if(selectindex[i] != -1){
            var id = $("#grid2").jqxGrid('getrowid', selectindex[i]);
            var datafield1=$('#grid2').jqxGrid('getrowdata', selectindex[i]);

          }
        }
      }
      var rowsd={};
      rowsd['program_id']=datafield1.program_id;
      rowsd['ref_user_id']=$("#ref_user_id").val();
      $.post('<?php echo $this->createUrl("manageuser/delprogram"); ?>', $.param(rowsd), function(data, textStatus, xhr) {});


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
                $.post('<?php echo $this->createUrl("manageuser/savelistpro"); ?>', $.param(rows), function(data, textStatus, xhr) {
                  if(point==(rowindex-1)){
                    //$("#staff2").jqxGrid({ source: getAdapter2()});
                  }
                });
              }
            }(rows,i),250*i);

            
            swal("Save is success!", "You clicked the button!", "success");
            setTimeout(function () {
             $("#grid2").jqxGrid({ source: getDatauser()});
             //location.reload();
           }, 3000);

            //swal("Save is success!", "You clicked the button!", "success");
            //location.reload();
          }
        //swal($.param(rows));
      }

    });    

  });
</script> -->
<!-- <div class="row">
  <div class="col-md-5">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">user</h3>
      </div>
   
      <div class="box-body no-padding">
        <div id="grid2"></div>
      </div>
     
    </div>
  </div> -->
  <!-- <div class="col-md-2">
    <button type="button" id="backward" class="btn btn-block btn-warning "><i class="fa fa-fw fa-backward"></i> เพิ่ม</button>
    <button type="button" id="forward" class="btn btn-block btn-danger "><i class="fa fa-fw fa-close"></i> ลบ</button>
    <br><br><br><br>
    <div align="center">
      <button type="button" id="save" class="btn btn-block btn-success btn-lg"><i class="fa fa-save"></i> Save</button>
      
    </div>



  </div> -->
  <!-- <div class="col-md-5">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Master</h3>
      </div>
    
      <div class="box-body no-padding">
        <div id="grid1"></div>
      </div>
   
    </div>
  </div>
</div> -->

<script>
  function gotoNode(name) {
    //alert(name);
    var w =800;
    var h =500;
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;

    var program_id = name;
    var title="notes";
    var url = "http://172.18.0.30/admin2018/index.php/manageuser/popupmanage?program_id="+program_id+'&id='+'<?php echo $data['id'] ?>';
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);


    if (window.focus) {
      newWindow.focus();
    }
  }
  var buttonclick = function (event) {


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

      var rowsed={};
      rowsed['id']=id;
      rowsed['name']=name;
      rowsed['fullname']=fullname;
      rowsed['surname']=surname;
      rowsed['nickname']=nickname;
      rowsed['depast']=depast;
      rowsed['job']=job;
      rowsed['branch']=branch;
      rowsed['branchname']=branchname;
      if(password==''){
        rowsed['password']='null';
      }else{
        rowsed['password']=password;
      }


//alert($.param(rowsed));

$.post("<?php echo $this->createUrl("manageuser/updatauser"); ?>", $.param(rowsed))
.done(function( data,status ) {
  if(data=='Message sent!'){
   swal("Update Data!", "Save is success!", "success");
   setTimeout(function () {

    location.reload();
  }, 1500);
 }else{
  swal("Update Error!", "You clicked the button!", "error");
  location.reload();
}
});

});
  });
</script>