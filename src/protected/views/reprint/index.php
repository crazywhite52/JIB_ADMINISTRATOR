<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<script>
	$(document).ready(function() {

		if(screen.height>=1080){
			wgheigth = 680;
		}else if(screen.height>=768){
			wgheigth = 370;
		}else if(screen.height>=720){
			wgheigth = 330;
		}
		var setcolorstring= function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
			if(datafield['approve']=="รออนุมัติ(print ส่ง)"){
				var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:left;margin-left:2px;margin-left:4px;margin-top:4px;color:#000000;">'+value+'</div>';
			}else if(datafield['approve']=="แจ้งแก้ไข"){
				var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:left;margin-left:2px;margin-left:4px;margin-top:4px;color:#FE0004;">'+value+'</div>';
			}else if(datafield['approve']=="ยกเลิก"){
				var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:left;margin-left:2px;margin-left:4px;margin-top:4px;color:red;">'+value+'</div>';
			}else if(datafield['approve']=="ตรวจสอบแล้ว"){
				var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:left;margin-left:2px;margin-left:4px;margin-top:4px;color:#ea9107;">'+value+'</div>';
			}else{
				var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:left;margin-left:2px;margin-left:4px;margin-top:4px;color:#07ea4f;">'+value+'</div>';
			}
			return url;
		}

		var input = document.getElementById("rq");

		input.addEventListener("keyup", function(event) {
			event.preventDefault();
			if($('#rq').val()===''){
				swal('กรุณากรอกข้อมูลที่ต้องการค้นหา!!');
				return false;
			}
			if (event.keyCode === 13) {
				$("#jqgrid").jqxGrid({ source: getData()  }); 
				//document.getElementById("myBtn").click();
			}
		});

		$('#search').click(function(event) {
			if($('#rq').val()===''){
				swal('กรุณากรอกข้อมูลที่ต้องการค้นหา!!');
				return false;
			}
			$("#jqgrid").jqxGrid({ source: getData()  }); 
			//$("#clear").removeAttr("disabled");
		});



		var getData=function(){

			var source =
			{

				datatype: "json",
				datafields: [
				{ name: 'rddoc', type: 'string' },
				{ name: 'rdate', type: 'date' },
				{ name: 'subject', type: 'string' },
				{ name: 'depart', type: 'string' },
				{ name: 'descript', type: 'string' },
				{ name: 'refname', type: 'string' },
				{ name: 'totalamount', type: 'number'},
				{ name: 'approve', type: 'string' }
				],
				url: '<?php echo $this->createUrl("reprint/datarq"); ?>',
				cache: false,
				filter: function()
				{

					$("#jqgrid").jqxGrid('updatebounddata', 'filter');
				},
				sort: function()
				{
					$("#jqgrid").jqxGrid('updatebounddata', 'sort');
				},
				root: 'Rows',
				beforeprocessing: function(data)
				{
					if (data != null)
					{
						source.totalrecords = data[0].TotalRows;
					}
				}

			};

			var dataAdapter = new $.jqx.dataAdapter(source,{
				formatData: function (data) {
					data.rq = $("#rq").val();
					return data;
				}
			});
			return dataAdapter;
		};
		$("#jqgrid").jqxGrid({
           // source: getData(),
           theme: 'metro',
           width: '100%',
           height: wgheigth,
           sortable: true, 

           showfilterrow: true,
           filterable: true,

           pagesize:25,
           pagesizeoptions:['30','50','100','1000'],      
           selectionmode: 'singlemode',

           altrows: true,
           columnsresize: true,
           columnsreorder: true,
           showstatusbar: true,
           statusbarheight: 25,
           columns: [

           {text: 'รีปริ้น', editable: false, align: 'center',  width: '5%',cellsalign:'center',columntype: 'button',cellsrenderer: function (row) 
           {return 'รีปริ้น'},
           buttonclick: function (row) {
           	var dataread = $('#jqgrid').jqxGrid('getrowdata',row);
           	var rddoc = dataread.rddoc;

           	//alert(rddoc);
           	swal({
           		title: "คุณต้องการรีปริ้นใช่หรือไม่?",
           		text: "คุณจะไม่สามารถกู้คืนหลังจากกด Yes",
           		type: "warning",
           		showCancelButton: true,
           		confirmButtonClass: "btn-danger",
           		confirmButtonText: "Yes, Reprint it!",
           		cancelButtonText: "No, cancel plx!",
           		closeOnConfirm: false,
           		closeOnCancel: false
           	},
           	function(isConfirm) {
           		if (isConfirm) {
           			var rows={};
           			rows['save']=true;
           			rows['rq']=rddoc;

           			$.post('<?php echo $this->createUrl("reprint/updatestatus") ?>', $.param(rows), function(data, textStatus, xhr) {
           				$("#jqgrid").jqxGrid({ source: getData() });
           			});
           			swal("Success!", "รีปริ้นเอกสารเรียบร้อยแล้ว.", "success");
           			setTimeout(function () {
           				
           				
           			}, 2000);
           		} else {
           			swal("Cancelled", "Your imaginary file is safe :)", "error");
           		}
           	});

           }},
           {text: 'แก้ไข', editable: false, align: 'center',  width: '5%',cellsalign:'center',columntype: 'button',cellsrenderer: function (row) 
           {return 'แก้ไข'},
           buttonclick: function (row) {
           	var dataread = $('#jqgrid').jqxGrid('getrowdata',row);
           	var rddoc = dataread.rddoc;

           	//alert(rddoc);
           	swal({
           		title: "คุณต้องการแก้ไขเอกสารใช่หรือไม่?",
           		text: "คุณจะไม่สามารถกู้คืนหลังจากกด Yes",
           		type: "warning",
           		showCancelButton: true,
           		confirmButtonClass: "btn-danger",
           		confirmButtonText: "Yes, Edit it!",
           		cancelButtonText: "No, cancel plx!",
           		closeOnConfirm: false,
           		closeOnCancel: false
           	},
           	function(isConfirm) {
           		if (isConfirm) {
           			var rows={};
           			rows['save']=true;
           			rows['rq']=rddoc;
           			$.post('<?php echo $this->createUrl("reprint/updatestatus2") ?>', $.param(rows), function(data, textStatus, xhr) {
           				$("#jqgrid").jqxGrid({ source: getData() });

           			});
           			setTimeout(function () {
           				swal("Success!", "ย้อนสถานะแก้ไขเอกสารเรียบร้อยแล้ว.", "success");
           			}, 2000);
           		} else {
           			swal("Cancelled", "Your imaginary file is safe :)", "error");
           		}
           	});

           }},
           { text: 'เลขที่เอกสาร', datafield: 'rddoc', align: 'center', width: '100'},
           { text: 'วันที่', datafield: 'rdate', align: 'center', width: '100' , cellsformat: 'dd/MM/yyyy',filtertype: 'date', filtercondition: 'EQUAL'},
           { text: 'เรื่อง', datafield: 'subject', align: 'center', width: '280' },
           { text: 'แผนก', datafield: 'depart', align: 'center', width: '110' },
           { text: 'วัตถุประสงค์', datafield: 'descript', align: 'center'},
           { text: 'ราคา(บาท)', datafield: 'totalamount',align: 'center',  width: '150',cellsformat:'f2',cellsalign: 'right',filterable: false },
           { text: 'ผู้เบิก', datafield: 'refname', align: 'center', width: '150',cellsalign: 'left' },
           { text: 'สถานะ', datafield: 'approve', align: 'center', width: '120',filtertype: 'list' ,cellsalign: 'center' ,cellsrenderer:setcolorstring}

           ]
       });
});
</script>
<section class="content-header">
	<h1>
		Reprint Request2015
		<small>เอกสารเบิกค่าใช้จ่าย</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Reprint Request2015</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="form-group">
			<div class="col-md-3 col-xs-6">
				<input type="text" id="rq" name="rq" class="form-control" placeholder="RQ...">
			</div>
			<div class="col-md-2 col-xs-4">
				<button class="btn btn-block btn-success" id="search"><span class="mif-search"></span> Search...</button>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div id="jqgrid">

			</div>
		</div>
	</div>
</section>