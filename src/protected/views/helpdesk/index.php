<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/js/clipboard.min.js"></script>
<!-- Content Header (Page header) -->
<script type="text/javascript">

  $(document).ready(function() {
    $("#btn_add").click(function(event) {
     window.location.href='<?php echo $this->createUrl("/Helpdesk/Add");  ?>';
   });


    var getList=function(){
     var source = 
     {
      datatype: "json",
      datafields: [
      { name: 'date',type: 'date' },
      { name: 'title',type: 'string' },
      { name: 'detail',type: 'string'},
      { name: 'id',type: 'int'},
      ],

      url: '<?php echo $this->createUrl("/helpdesk/querylist");?>',
      cache: false,
    };

    var dataAdapter = new $.jqx.dataAdapter(source); 

    return dataAdapter;
  };


  $("#jqxgrid").jqxGrid(
  {
    source: getList(),
    theme: 'metrodark',
    width: '100%',
    autoheight: true,
    sortable: true,
              // columnsresize: true,
              pagesize: 10,
              // columnsreorder: true,  
              // altrows: true,
              pageable: true,
              selectionmode: 'multiplecellsextended',
              showstatusbar: false,
              statusbarheight: 30,
              filterable: true,
              showfilterrow: true,
                    // editable:true,



                    columns: 
                    [
                    { text: 'id', datafield: 'id', editable: false, align: 'center',cellsalign: 'center', filterable: false,width: '20%',hidden:true},
                    { text: 'วันที่', datafield: 'date', editable: false, align: 'center',cellsalign: 'center', filterable: false,width: '10%',cellsformat: 'dd-MM-yyyy'},
                    { text: 'ชื่อ Qurey', datafield: 'title', align: 'center', editable: false,cellsalign: 'left',width: '20%'},
                    { text: 'รายละเอียด', datafield: 'detail', align: 'center', editable: false,cellsalign: 'left', filterable: false},
                    { text: ' ',align: 'center', editable: false,cellsalign: 'center',filterable: false,width: '10%',columntype: 'button' ,cellsrenderer: function (row) {
                      return 'ดู';}, buttonclick: function (row) {    
                        var dataread=$('#jqxgrid').jqxGrid('getrowdata',row);  
                        var id =dataread.id;

                        var detail=dataread.detail;
                        var str = detail.toString();
                        var res = str.replace(/<[^>]*>/g, '');

                        $('#title').html(dataread.title);
                        $('#detail').html(res);
                        $('#id').html(id);

                        $('#my-modal').modal('show');

                      }
                    },
                    { text: ' ',editable:false, align: 'center' ,columntype: 'button' , filterable: false,width: '10%',cellsrenderer: function () {
                     return "ลบ";
                   }, buttonclick: function (row) {
                     var conf=confirm('คุณต้องการลบใช่หรือไม่');
                     if(conf==true){
                       var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                       var rows={};
                       rows['id']=datarow.id;

                   //alert(pr_id.USER_PR);
                   $.post('<?php echo $this->createUrl("/Helpdesk/Delete"); ?>',$.param(rows), function(data, textStatus, xhr) {
                     $("#jqxgrid").jqxGrid({ source: getList() });
                   });
                 }
               }} 
               ]
             });
});






</script>





<section class="content-header">
  <h1>
    Query Box
    <small>คิวรี่ที่คุณคู่ควร</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Query Box</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <a id="btn_add" class="btn btn-info btn-block margin-bottom">Create</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Query List</h3>
        </div>
        <div id="jqxgrid"></div>
      </div>
    </div>
  </div>
</section>

<div id="my-modal" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="smaller lighter blue no-margin"><k id='title'></k></h3>
      </div>

      <div class="modal-body">

        <button onclick="myFunction()">Copy text</button>



        <textarea id='detail' rows="15" cols="90" style="color: black;"></textarea>

        <script>
          function myFunction() {
            var copyText = document.getElementById("detail");
            copyText.select();
            document.execCommand("Copy");
            alert("Copied the text");
          }
        </script>
        <br>
      </div>

      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>



<!-- /.content -->
