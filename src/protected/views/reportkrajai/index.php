<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script type="text/javascript">
$(document).ready(function () {

var theme = 'ui-smoothness';
if(screen.height>=1080){
      wgheigth = 680;
    }else if(screen.height>=768){
      wgheigth = 370;
    }else if(screen.height>=720){
      wgheigth = 330;
    }

    
$("#date_befor").jqxDateTimeInput({width: '100%', height: '30px'});
$("#date_after").jqxDateTimeInput({width: '100%', height: '30px'});

var getAdapter=function(){
  var source =
  {
    datatype: "json",
    datafields: [
    { name: 'userid',type: 'string' },
    { name: 'starttime',type: 'string' },
    { name: 'endtime',type: 'string'},
    { name: 'result',type: 'number'},
    { name: 'upd',type: 'string'},
   
    ],

    url: '<?php echo $this->createUrl("Reportkrajai/showlog");?>',
    cache: false,
   
  };

  var dataAdapter = new $.jqx.dataAdapter(source,{
    formatData: function (data) {
    	 data.date_befor = $("#date_befor").val();   //
      	 data.date_after = $("#date_after").val();   //
      return data;
    }
  }); 

  return dataAdapter;
};



            ///////////////////////////////////// initialize jqxGrid/////////////////////
      $("#jqxgrid").jqxGrid(
      {
      source: getAdapter(),
      width: '100%',
      height: wgheigth,
      sortable: true,
      columnsresize: true,
      // columnsreorder: true,  
      // altrows: true,
       selectionmode: 'multiplecellsextended',
      // showstatusbar: true,
      // statusbarheight: 25,
      filterable: true,
      showfilterrow: true,


      
      columns: [
     
      { text: 'User',datafield: 'userid', editable: false, align: 'center',cellsalign: 'left',width:300},
      { text: 'Starttime',datafield: 'starttime', align: 'center', editable: false,cellsalign: 'left',filterable: false},
      { text: 'Endtime',datafield: 'endtime',align: 'center', editable: false,cellsalign: 'left',filterable: false},
      { text: 'Result',datafield: 'result',editable:false, align: 'center' ,cellsalign: 'center'},
      { text: 'UPD',datafield: 'upd',editable:false, align: 'center',cellsformat: 'c2' ,cellsalign: 'center',width:170,filterable: false},
    
      
      
      
     
      

      ]
   });

$("#search").on("click",function(){
   
   $("#jqxgrid").jqxGrid({source: getAdapter()});
  });
});
</script>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report Distribution
        <small>รายงานการกระจาย</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">รายงานการกระจาย</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2 col-sm-2 col-lg-2 col-xs-4">
<div  id="date_befor"></div>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2 col-xs-4">
         <div id="date_after"></div> 
       </div>
       <div class="col-md-2 col-sm-2 col-lg-2 col-xs-4">
         <button class="btn btn-block btn-success" id="search"><span class="mif-search"></span> Search...</button>
       </div>
     </div>
     <br>
   
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div id="jqxgrid">
            
          </div>
        </div>
      </div>
      </section>