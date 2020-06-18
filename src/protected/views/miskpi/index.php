<!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script>
  	$(document).ready(function () {
  	var dd = new Date();
    var mm = dd.getMonth();
    var y = new Date();
    var yy = y.getFullYear();
    var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'personal_name' },
                    { name: 'percen_score' },
                    { name: 'grade' },
                    { name: 'MM/YY'}
                ],
                url: '<?php echo $this->createUrl("miskpi/chartdate"); ?>'
            };
            var dataAdapter = new $.jqx.dataAdapter(source,
                {
                    formatData: function (data) {
                        data.jobmonth = mm+1;
                        data.jobyear = yy;
                        return data;
                    },
                });
        var getAdapter=function(){
        var source =
            {
                datatype: "json",
                datafields: [
                { name: 'personalid', type: 'int'},
                { name: 'score', type: 'string' },
                { name: 'percen_score', type: 'string' },
                { name: 'grade', type: 'string' },
                { name: 'total_grade', type: 'string' },
                { name: 'maxjob', type: 'string' },
                { name: 'joboverdue', type: 'string' },
                { name: 'bar', type: 'string' },
                { name: 'empty_day', type: 'string' },
                { name: 'complete_job', type: 'string' },
                { name: 'personal_name', type: 'string' },
                { name: 'MM/YY', type: 'string' }
                ],
        
            cache: false,
            url: '<?php echo $this->createUrl("miskpi/sdate"); ?>',
	       };
        
            $('#btsearch').click(function(event) {
                $("#idg").jqxGrid({source: getAdapter()});
            });
        
	       var dataAdapter = new $.jqx.dataAdapter(source,
                {
                    formatData: function (data) {
                        data.jobmonth = mm+1;
                        data.jobyear = yy;
                        return data;
                    }
                });
            return dataAdapter;
    };

     var setcolor = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
            if( datafield['total_grade']=='A' || datafield['total_grade']=='A+' || datafield['total_grade']=='A-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#0404B4;">'+value+'</div>';
                return url;
            }else if( datafield['total_grade']=='B' || datafield['total_grade']=='B+' || datafield['total_grade']=='B-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#04B404">'+value+'</div>';
                return url;
            }else if( datafield['total_grade']=='C' || datafield['total_grade']=='C+' || datafield['total_grade']=='C-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#DF0101">'+value+'</div>';
                return url;
            }else{
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#000000">'+value+'</div>';
                return url; 
            }
            
        }
     var setcolor2 = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
            if( datafield['grade']=='A' || datafield['grade']=='A+' || datafield['grade']=='A-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#0404B4;">'+value+'</div>';
                return url;
            }else if( datafield['grade']=='B' || datafield['grade']=='B+' || datafield['grade']=='B-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#04B404">'+value+'</div>';
                return url;
            }else if( datafield['grade']=='C' || datafield['grade']=='C+' || datafield['grade']=='C-'){
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#DF0101">'+value+'</div>';
                return url;
            }else{
                var url='<div style="overflow:hidden;text-overflow:ellipsis;padding-bottom:2px;text-align:center;margin-right:2px;margin-left:4px;margin-top:4px;color:#000000">'+value+'</div>';
                return url; 
            }
            
        }
        //////////////////////////////////////////////////////////////
        $("#idg").jqxGrid(
            	{
                	width: '100%',
                	source: getAdapter(),
                	height: 200,

                	// pageable: true,
                	// autoheight: true,
                	// sortable: true,
                	// altrows: true,
                	// enabletooltips: true,
                	// editable: true,
                	// selectionmode: 'multiplecellsadvanced',
                	columns: [
                  	{ text: 'รหัส.', datafield: 'personalid', align: 'center',width:'4%' },
                  	{ text: 'ชื่อ-นามสกุล', datafield: 'personal_name' ,align: 'center', },
                  	{ text: 'คะแนน', datafield: 'score',  align: 'center', width: '8%' , cellsalign:'center' },
                  	{ text: 'จ๊อบทั้งหมด', datafield: 'maxjob',align: 'center',width: '8%', cellsalign:'center' },
                  	{ text: 'จ๊อบoverdue', datafield: 'joboverdue',align: 'center',width: '8%' , cellsalign:'center'},
                  	{ text: 'จ๊อบที่ค้าง', datafield: 'bar',align: 'center',width: '8%' , cellsalign:'center'},
                  	{ text: 'จำนวนวันว่าง', datafield: 'empty_day',align: 'center',width: '8%' , cellsalign:'center'},
                  	{ text: 'จ๊อบสำเร็จ', datafield: 'complete_job',align: 'center',width: '5%' , cellsalign:'center'},
                  	{ text: 'เปอร์เซ็น', datafield: 'percen_score',align: 'center',width: '5%' , cellsalign:'center'},
                    { text: 'เกรด', datafield: 'grade',align: 'center' , cellsalign:'center',width: '5%',cellsrenderer:setcolor2},
                    { text: 'เกรดรวม', datafield: 'total_grade',align: 'center' , cellsalign:'center',width: '5%',cellsrenderer:setcolor},

                  	{ text: 'เดือนปี',  datafield: 'MM/YY', align: 'center', cellsalign:'center',width: '10%'}
                	],
    	});
    	////////////////////////////////////////////////////////////
            $('#chartContainer').jqxChart(
             {
                title: "ChartScore",
                description: "(กราฟแสดงการทำงานขอแต่ละเดือน)",
                enableAnimations: true,
                showLegend: true,
                showBorderLine: true,
                legendPosition: { left: 520, top: 140, width: 100, height: 100 },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    {
                                        dataField: 'percen_score',
                                        displayText: 'personal_name',
                                        labelRadius: 110,
                                        initialAngle: 15,
                                        radius: 80,
                                        centerOffset: 0,
                                        //formatSettings: { sufix: '%', decimalPlaces: 1 },
                                        formatFunction: function (value) {
                                          if(value!='')
                                            value=value;

                                            /*if (value >= 80)
                                                value = 'A';
                                            else if (value >= 70)
                                                value = 'B+';
                                            else if (value >= 60)
                                                value = 'B';
                                            else if (value >= 50)
                                                value = 'B-';
                                            else if (value < 50)
                                                value = 'C';*/
                                            return value;
                                        },
                                    }
                                ]
                        }
                    ]
            });
  	});
  </script>
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        KPI MIS
        <small>Status คะแนนพนักงาน</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">KPI MIS</li>
      </ol>
    </section>
      <!-- Main content -->
    <section class="content">
    <div class="row">
    	<div class="col-md-6">
    		 <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    	</div>
    	<div class="col-md-6">
    		 <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pie Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chartContainer' style="width: 100%; height: 300px;">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    	</div>
    </div>
</div>
 <div class="row">
 	<div class="col-md-12 col-sm-12 col-lg-12">
 		<div id="idg">
 			
 		</div>
 	</div>
 	</div>
</section>
<?php 
$year=date("Y");
$kpi="SELECT 
a.personalid, a.score, a.percen_score, a.grade, a.maxjob, a.joboverdue, a.empty_day,a.total_grade,a.complete_job, a.jobmonth,a.jobyear,b.fullname, b.surname, b.nickname,
IFNULL((SELECT score FROM es_result WHERE jobyear=(a.jobyear-1) AND jobmonth=a.jobmonth AND personalid=a.personalid),0) AS oldscore

FROM
es_result AS a
LEFT JOIN sysuser AS b ON a.personalid = b.`name`
WHERE a.jobyear=$year AND a.jobmonth='1'
ORDER BY a.percen_score DESC";

$reskpi=Yii::app()->msystem->createCommand($kpi)->queryAll();

$chart_data = '';
foreach ($reskpi as $key => $value) {
  $chart_data.="{ a:'".number_format($value["score"])."', b:'".$value["oldscore"]."',c:'".$value["fullname"]."'}, ";
}
$chart_data = $chart_data;
//echo $chart_data;

 ?>

<script>
  $(function () {
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data:[<?php echo $chart_data; ?>],
      xkey:'c',
      ykeys: ['b', 'a'],
      /*labels:['Profit'],*/
      barColors: ['#00a65a', '#f56954'],
      /*xkey: 'y',
      ykeys: ['a', 'b'],*/
      labels: ['2017', '2018'],
      hideHover: 'auto'
    });
  });
</script>