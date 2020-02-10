<html>
 <head>
  <title>Status</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> 


  <!-- <link rel="stylesheet" href="https://github.com/hernansartorio/jquery-nice-select/blob/master/css/nice-select.css" />
  <script src="https://github.com/hernansartorio/jquery-nice-select/blob/master/js/jquery.nice-select.js" /> -->

  <style>
	  body {
	   margin:0;
	   padding:0;
	   background-color:#f1f1f1;
	  }
	  .box
	  {
	   width:1270px;
	   padding:20px;
	   background-color:#fff;
	   border:1px solid #ccc;
	   border-radius:5px;
	   margin-top:25px;
	   box-sizing:border-box;
	  }
	  .row {
	  	margin-left: 0px;
	  	margin-right: 0px;
	  }
	  .form-control {
	  	height: 42px;
	  }
    .select2-container .select2-selection--single {
      height: 42px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
      height: 42px;
      padding-top: 5px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 42px;
    }
  </style>
 </head>
 <body>
  <div class="container box">
	<h1 align="center">Status</h1>
	<br />
	<div class="table-responsive">
	<br />
	<div class="row">
   	<div class="col-md-2">
   		<a href="<?php echo site_url('LinkController/index') ?>">Go to Link page</a>
   	</div>
   	<div class="col-md-2 wrapper">
   		<select id="option" style="width: 100%">
   			<option data-display="-- Select Option --">No option</option>
   			<option value="Daily">Daily</option>
   			<option value="Monthly">Monthly</option>
   			<option value="Yearly">Yearly</option>
   			<option value="Range">Range</option>
   		</select>
   	</div>
   	<div class="col-md-2">
   		<input type="text" class="form-control" id="datepicker1" placeholder="MM/DD/YYYY"></span>
   	</div>
   	<div class="col-md-2">
   		<input type="text" class="form-control" id="datepicker2" placeholder="MM/DD/YYYY"></span>
   	</div>
   	<div class="col-md-2">
   		<button type="button" class="btn btn-info go_btn" style="display: inline-block; height: 42px;">Go</button>
   	</div>
   	</div>

    <br />
    <div id="alert_message"></div>
    <table id="status_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th style="text-align: center; width: 15%;">No</th>
       <th style="text-align: center; width: 15%;">Campaign ID</th>
       <th style="text-align: center; width: 20%;">Real Traffic</th>
       <th style="text-align: center; width: 20%;">Filtered Traffic</th>
       <th style="text-align: center; width: 15%;">Normal</th>
      </tr>
     </thead>
     <tbody id="status_table_body">
     	<?php
     		$status_index = 1;
     		foreach($status as $state) {
     			?>
     			<tr>
     				<td style="text-align: center;"><?php echo $status_index; ?></td>
     				<td style="text-align: center;"><?php echo $state['campaign_id'] ?></td>
     				<td style="text-align: center;"><?php echo $state['real_traffic'] ?></td>
     				<td style="text-align: center;"><?php echo $state['filter_traffic'] ?></td>
     				<td style="text-align: center;"><i class="fa fa-circle fa-2x" style="color:green;"></i></td>
     			</tr>
	            <?php 
	            $status_index++;
	        }?>
     </tbody>
    </table>
   </div>
  </div>
 </body>
 <script>
 	var option = null;

 	$(function() {
 		$('#option').select2();
 		$('#datepicker1').datepicker({
 			minDate: '-10Y',
 			maxDate: '+10Y'
 		});
 		$('#datepicker2').datepicker();
 		$('#datepicker1').hide();
 		$('#datepicker2').hide();
 		$('.go_btn').hide();
	    if(!window.location.href.includes('StatusController')) {
	      window.location.href = "<?php echo site_url('StatusController/index'); ?>";
	    }
 	});

 	$('.wrapper').on('change', 'select', function() {
 		option = $('#option').val();
 		if(option === 'Daily') {
 			$('#datepicker1').show();
 			$('.go_btn').show();
 		}
 		else if(option === 'Monthly') {
 			$('#datepicker1').show();
 			$('.go_btn').show();
 		} else if(option === 'Yearly') {
 			$('#datepicker1').show();
 			$('.go_btn').show();
 		} else if(option === 'Range') {
 			$('#datepicker1').show();
 			$('#datepicker2').show();
 			$('#datepicker1').attr('placeholder', 'From');
 			$('#datepicker2').attr('placeholder', 'To');
 			$('.go_btn').show();
 		} else {
 			$('#datepicker1').hide();
 			$('#datepicker2').hide();
 			$('.go_btn').show();
 		}
 	});

 	$(".go_btn").click(function(){
 		var status_table = $('#status_table_body');
 		var from_date = $('#datepicker1').datepicker("getDate");
 		var to_date = $('#datepicker2').datepicker("getDate");
 		var from_year = from_date.getFullYear();
 		var from_month = from_date.getMonth();
 		var from_day = from_date.getDate();
 		if(option === "Range") {
 			var to_year = to_date.getFullYear();
	 		var to_month = to_date.getMonth();
	 		var to_day = to_date.getDate();	
 		}
 		
    console.log(from_year + ":" +from_month + ":" + from_day);
 		
 		$.ajax({
 			type: "post",
 			url: "../StatusController/getByOption",
 			dataType: "json",
 			data: {option: option, from_year: from_year, from_month: from_month, from_day: from_day, to_year: to_year, to_month: to_month, to_day: to_day},
 			success: function(data) {
 				status_table.empty();
 				// console.log(data);
 				// var index = 1;
 				var ind = 0;

 				$.each(data, function(index, jsonObject) {
 					if(ind != 0) {
 						$.each(jsonObject, function(key, value) {
 							status_table.append("<tr><td style='text-align: center;'>" + ind + "</td><td style='text-align: center;'>" + value['campaign_id'] + "</td><td style='text-align: center;'>" + value['real_traffic'] + "</td><td style='text-align: center;'>" + value['filter_traffic'] + "</td><td style='text-align: center;'><i class='fa fa-circle fa-2x' style='color:green;'></i></td></tr>");
 							ind++;
	 					});
 					}
 					ind++;
 				});
 			},
 			error: function() {
 				console.log("Error");
 			}
 		});
	});
 </script>
</html>
