<html>
 	<head>
  		<title>Link Management</title>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">Link Management</h1>
		    <br />
    	    <div class="table-responsive">
		    	<br />
			    <div align="left">
			   		<a href="<?php echo site_url('StatusController/index') ?>">Go to Status page</a>
			    </div>
			    <div align="right">
			     	<button name="add" id="add" class="btn btn-info" data-toggle="modal" data-target="#new_link">Add New Link</button>
			    </div>
			    <br />
			    <table id="link_table" class="table table-bordered table-striped">
				    <thead>
				    	<tr>
						    <th style="text-align: center; width: 15%;">No</th>
						    <th style="text-align: center; width: 15%;">Campaign ID</th>
						    <th style="text-align: center; width: 20%;">Real Link</th>
						    <th style="text-align: center; width: 20%;">Filtered Link</th>
						    <th style="text-align: center; width: 15%;">Option</th>
					    </tr>
				    </thead>
			     <tbody>
			     	<?php
			     		$link_index = 1;
			     		foreach($links as $link) {
			     			?>
			     			<tr id=<?php echo $link['id'] ?>>
			     				<td style="text-align: center;"><?php echo $link_index; ?></td>
			     				<td style="text-align: center;"><?php echo $link['campaign_id'] ?></td>
			     				<td style="text-align: center;"><a id="real" href="#"><?php echo $link['real_link'] ?></a></td>
			     				<td style="text-align: center;"><a id="filter" href="#"><?php echo $link['filter_link'] ?></a></td>
			     				<td style="text-align: center;">
					                <button type="button" class="btn btn-info update_btn" data-toggle="modal" data-target="#update_link">Update</button>
					                <button class="btn btn-danger delete_btn">Delete</button>
				                </td>
				            </tr>
				            <?php 
				            $link_index++;
				        }?>
			     </tbody>
			    </table>
	    	</div>

	    	<div class="modal fade" id="new_link">
	    		<div class="modal-dialog">
	    			<div class="modal-content">
	    				<form method="post" action="insert">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add New Link</h4>
							</div>
							<div class="modal-body"> 
								<div class="box-body">
								  <div class = "col-sm-12">
								  	<div class="form-group">
										<label>Campagin ID:</label>
										<select class="form-control select2 select2-hidden-accessible" id="new_campaign_id" name="new_campaign_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<?php
										foreach($campaign_ids as $campaign_id) {
										  ?>
										    <option value=<?php echo $campaign_id['campaign_id']; ?>><?php echo $campaign_id['campaign_id']; ?></option>
										  <?php
										}
										?>
										</select>
				                    </div>
								    <div class="form-group">
				                        <label>New Real Link:</label>
				                        <input type="text" name = "new_real_link" id = "new_real_link" class="form-control" placeholder="Input the new real link.">
				                    </div>
				                    <div class="form-group">
				                        <label>New Filter Link:</label>
				                        <input type="text" name = "new_filter_link" id = "new_filter_link" class="form-control" placeholder="Input the new filter link.">
				                    </div>                     
								  </div>
								</div>
							<!-- /.box-body -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							</form>
	    			</div>
	    		</div>
	    	</div>

	    	<div class="modal fade" id="update_link">
	    		<div class="modal-dialog">
	    			<div class="modal-content">
	    				<form method="post" action="update">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Update Link</h4>
							</div>
							<div class="modal-body"> 
								<div class="box-body">
								  <div class = "col-sm-12">
								  	<div class="form-group">
								  		<input type="hidden" name="update_id" id="update_id">
										<h4></h4>
									</div>
								    <div class="form-group">
				                        <label>Update Real Link:</label>
				                        <input type="text" name = "update_real_link" id = "update_real_link" class="form-control" placeholder="Input the update real link.">
				                    </div>
				                    <div class="form-group">
				                        <label>Update Filter Link:</label>
				                        <input type="text" name = "update_filter_link" id = "update_filter_link" class="form-control" placeholder="Input the update filter link.">
				                    </div>                     
								  </div>
								</div>
							<!-- /.box-body -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							</form>
	    			</div>
	    		</div>
	    	</div>
	  </div>
	</body>
	<script>
	 	$(function() {
	 		// $('#link_table').dataTable({});
	 		mergeTableCells();
	 	});

	 	function mergeTableCells() {
	 		var dimension_cells = new Array();
	 		var dimension_col = null;
	 		var columnCount = $('#link_table tr').length;
	 		var first_instance = null;
	 		var rowspan = 1;
	 		$('#link_table').find('tr').each(function() {
	 			var dimension_td = $(this).find('td:nth-child(2)');
	 			if(first_instance === null) {
 					first_instance = dimension_td;
 				} else if(dimension_td.text() === first_instance.text()) {
 					dimension_td.attr('hidden', true);
 					++rowspan;
 					first_instance.attr('rowspan', rowspan);
 				} else {
 					first_instance = dimension_td;
 					rowspan = 1;
 				}
	 		});

	 		
	 		
	 	}

	 	$('a').click(function() {
	 		var id = $(this).parent().parent().attr("id");
	 		var is_real = $(this).attr("id") === 'real' ? 0 : 1;
	 		$.ajax({
	 			type: "post",
	 			url: "../StatusController/insert",
	 			dataType: "json",
	 			data: {id : id, is_real : is_real},
	 			success: function() {
	 				location.reload(true);
	 			},
	 			failure: function() {
	 				alert("Failed to update clicks.");
	 			}
	 		});
	 	});

	 	$(".delete_btn").click(function(){
		    if (window.confirm('Do you really want to delete it?')) {
				var id = $(this).parent().parent().attr("id");
				$.ajax({
					type: "post",
					url: "../StatusController/delete",
					dataType: "json",
					data: {id : id},
					success: function() {
						location.reload(true);
					},
					failure: function() {
						alert("Failed to delete the link.");
					}
				});
		    }  
		});

		$(".update_btn").click(function() {
			$("#update_id").val($(this).parent().parent().attr("id"));
			var campaign_id = $(this).parent().parent().children()[1].innerHTML;
			var update_real_link = $(this).parent().parent().children()[2].innerText;
			var update_filter_link = $(this).parent().parent().children()[3].innerText;
			$("#update_real_link").val(update_real_link);
			$("#update_filter_link").val(update_filter_link);
			$("h4").html(campaign_id);
		});
 	</script>
</html>