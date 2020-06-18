<script src="https://cdn.ckeditor.com/4.7.3/standard-all/ckeditor.js"></script>


<br>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<!-- <div class="col-md-8"> -->
			<div class="row">

				<form class="form-horizontal" name="form1" method="POST">
					<div class="form-group has-success">
						<label for="inputTitle" class="col-sm-1 control-label" ><strong>Query</strong></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" for="inputSuccess" name="table1" id="inputTitle1" placeholder="ชื่อ Query">
						</div>
					</div>
					
					<br>
	
		<div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
				<textarea cols="80" id="editor3" name="editor3" rows="10" ></textarea>
			</div>
		  </div>
		</div>
	</section>

		
	<script>
		// We need to turn off the automatic editor creation first.s

		CKEDITOR.disableAutoInline = true;

		CKEDITOR.replace( 'editor3', {
			extraPlugins: 'sourcedialog',
			removePlugins: 'sourcearea'
		} );
	</script>

	<br>


	<P align=center><button type="submit" class="btn btn-success" onclick="return checkfour()">บันทึก</button> &nbsp;&nbsp;
		<a class="btn btn-danger" href="?r=Helpdesk/index">ยกเลิก</a>
	</P>
		</div>
	</div>
</div>
</form>

<script>
	 function checkfour() {
        var detail = document.getElementById('inputTitle1').value;
        if (detail == "") {
            alert("คุณยังไม่ได้กรอกข้อมูล");
            return false;

        }

    }


</script>