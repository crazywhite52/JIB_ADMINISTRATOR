<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script>
$(document).ready(function() {
	document.getElementById('clear').disabled = true;
	$('#dialog').hide();
	if(screen.height>=1080){
			wgheigth = 680;
		}else if(screen.height>=768){
			wgheigth = 370;
		}else if(screen.height>=720){
			wgheigth = 330;
		}


            $("#classname").change(function() {
            	$("#classid").val($("#classname").val());
            });
            $("#classid").keyup(function() {
            	$("#classname").val($("#classid").val());

            });

            $('#search').click(function(event) {
            	if(document.getElementById("br6").checked==true){
            		$('#branch').val(6);
            	}else if(document.getElementById("br21").checked==true){
            		$('#branch').val(21);
            	}else if(document.getElementById("br24").checked==true){
                $('#branch').val(24);
              }else if(document.getElementById("br139").checked==true){
                $('#branch').val(139);
              }

            	$("#jqgrid").jqxGrid({ source: getData()  }); 
            	$("#clear").removeAttr("disabled");
            });

            $('#clear').click(function(event) {
            	swal({
				  title: "ล้างทั้งหมดใช่หรือไม่?",
				  text: "- เมื่อคุณล้างการกระจายนี้ สถานะรายการกระจายจะเป็น 2 ถือเป็นการเสร็จสิ้นกระบวนการล้างกระจาย.",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Yes, ล้างเดี๋ยวนี้!",
				  cancelButtonText: "No, cancel plx!",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
				function(isConfirm) {
				  if (isConfirm) {
				  	var rows={};
					        rows['classid']=$("#classid").val();
					        rows['product']=$("#product").val();
					        rows['branch']=$("#branch").val();
					$.post('<?php echo $this->createUrl("Disstock/updateorderbranch") ?>', $.param(rows), function(data, textStatus, xhr) {
		                    $("#jqgrid").jqxGrid({ source: getData() }); 
        					document.getElementById('clear').disabled = true;
		                });
					setTimeout(function () {
					    swal("Deleted!", "Your imaginary file has been deleted.", "success");
					  }, 2000);
				    
				  } else {
				    swal("Cancelled", "Your imaginary file is safe :)", "error");
				  }
				});

            	
            });


             $('#clearnow').click(function(event) {
            	
             	var rows={};
		        rows['classid']=$("#classid").val();
		        rows['product']=$("#product").val();
		        rows['branch']=$("#branch").val();

		        $.post('<?php echo $this->createUrl("Disstock/updateorderbranch") ?>', $.param(rows), function(data, textStatus, xhr) {
		                    
		                    $("#jqgrid").jqxGrid({ source: getData() }); 
		                    var dialog = $('#dialog').data('dialog');
        					dialog.close();
        					$("#clear").attr("disabled","disabled");
		                });

            });






            var getData=function(){



			var source =
			{

				datatype: "json",
				datafields: [
				{ name: 'ordid', type: 'string' },
				{ name: 'orddate', type: 'string' },
				{ name: 'product', type: 'string' },
				{ name: 'Name', type: 'string' },
				{ name: 'ordnum', type: 'number' },
				{ name: 'authorname', type: 'string' },
				{ name: 'stockbranch', type: 'string' },
				{ name: 'stockprint', type: 'string' },
				],
				url: '<?php echo $this->createUrl("Disstock/dissdata"); ?>',

                };

                var dataAdapter = new $.jqx.dataAdapter(source,{
                	formatData: function (data) {
                		data.classid = $("#classid").val();
                		data.product = $("#product").val();
                		data.branch = $("#branch").val();
                		return data;
                	}
                });





                return dataAdapter;
            };



            $("#jqgrid").jqxGrid({
           // source: getData(),
            theme: 'orange',
            width: '100%',
            height: wgheigth,

		    columnsresize: true,
		    columnsreorder: true,
		    showstatusbar: true,
		    statusbarheight: 25,


		    columns: [
		    {text: 'ordID',  datafield: 'ordid', align: 'center',cellsalign:'center', width: '150px'},
		    {text: 'วันที่กระจาย',  datafield: 'orddate',cellsalign:'center', align: 'center' ,width: '130'},
		    {text: 'Product',  datafield: 'product', align: 'center', width: '150px' ,cellsalign:'left'},
		    {text: 'productName',  datafield: 'Name', align: 'center' },
		    { text: 'จำนวน',  datafield: 'ordnum', width: '80px',align: 'center', cellsalign: 'right'},
		    {text: 'ผู้กระจาย', datafield: 'authorname', width: '200px', align: 'center',cellsalign:'center'},
		    {text: 'Branch', datafield: 'stockbranch', width: '80px', align: 'center',cellsalign:'center'},
		    {text: 'Stockprint', datafield: 'stockprint', width: '80px', align: 'center',cellsalign:'center'},



		    ]
		});



});

</script>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clear Distribution
        <small>ระบบล้างกระจายสินค้า Br.6 || Br.21</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Clear Distribution</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<input type="hidden" id="branch">
    	<div class="row">
                <div class="col-md-2 col-xs-6">
                  <input type="text" id="product" name="product" class="form-control" placeholder="product">
                </div>
                <div class="col-md-1 col-xs-3">
                  <input type="text" id="classid" class="form-control" placeholder="">
                </div>
                <div class="col-md-2 col-xs-6">
                  <?php echo CHtml::dropDownList("classname",null,White::Listcat(),array('class'=>'form-control'));?>
                </div>
                <div class="col-md-3 col-xs-2">
                	<div class="form-group">
                <label>
                  <input type="radio" name="n3" class="flat-red" value="6" checked id="br6">
                  Br.6
                </label>
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="n3" class="flat-red" value="21" id="br21">
                  Br.21
                </label>
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="n3" class="flat-red" value="24" id="br24">
                  Br.24
                </label>
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="n3" class="flat-red" value="139" id="br139">
                  Br.139
                </label>
              	</div>
                </div>
                <div class="col-md-2 col-xs-4">
                 	<button class="btn btn-block btn-success" id="search"><span class="mif-search"></span> Search...</button>
                 </div>
                 <div class="col-md-2 col-xs-4">
                 	<button id="clear" class="btn btn-block btn-danger"><span class="mif-warning" ></span> Clear Distribution</button>
                 </div>
              </div>

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div id="jqgrid">
			
		</div>
	</div>
</div>
    </section>
