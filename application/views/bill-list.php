   <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-12">
          		<h5 class="text-primary" id="page-heading">My Bill Entries</h5>
          		<hr/>
          		
          		<div class="row">
        		<div class="col">
        			<label>Company</label>
        			<select id="com_filter">
        				<option value="">Select Company</option>
        				<?php foreach($companies as $company) { ?>
        					<option value="<?php echo $company['cid']; ?>" <?php if($company['cid'] == $this->uri->segment('2')){ echo 'selected'; }?>><?php echo $company['name']; ?></option>
        				<?php } ?>
        			</select>
        		</div>
        		<div class="col">
        			<label>Cost-center</label>
        			<select id="costc_filter">
        				<option value="">Select Costcenter</option>
        				<?php foreach ($cost_centers as $cost_center){ ?>
        					<option value="<?php echo $cost_center['costc_id']; ?>" <?php if($cost_center['costc_id'] == $this->uri->segment('3')){ echo 'selected'; }?>><?php echo $cost_center['name']; ?></option>
        				<?php } ?>
        			</select>
        		</div>
        		<div class="col">
        			<label>Location</label>
        			<select id="location_filter">
        				<option value="">Select Location</option>
        				<?php foreach ($locations as $location){ ?>
        					<option value="<?php echo $location['loc_id']; ?>" <?php if($location['loc_id'] == $this->uri->segment('4')){ echo 'selected'; }?>><?php echo $location['name']; ?></option>
        				<?php } ?>
        			</select>
        		</div>
        		<div class="col">
        			<label>Status</label>
        			<select id="status_filter">
        				<option value="">select Status</option>
        				<option value="date_passed" <?php if('date_passed' == $this->input->get('status',true)){ echo 'selected'; }?>>Date Passed</option>
        				<option value="today" <?php if('today' == $this->input->get('status',true)){ echo 'selected'; }?>>Today</option>
        				<option value="date_remaining" <?php if('date_remaining' == $this->input->get('status',true)){ echo 'selected'; }?>>Date Remaining</option>
        				<option value="not_filled" <?php if('not_filled' == $this->input->get('status',true)){ echo 'selected'; }?>>Not Filled</option>
        			</select>
        		</div>
        		<div class="col">
        			<input type="button" id="filter" value="Search" />
        		</div>
        	</div>
          		
          		<?php echo $this->session->flashdata('msg'); ?>
          		<div class="table-responsive">
          		<table class="table table-bordered table-striped table-sm text-sm border" id="bill_test">
          			<thead class="bg-light ">
          				<tr>
          					<th>S.No.</th>
          					<th>Company</th>
          					<th>Cost-Center</th>
          					<th>Location</th>
          					<th>Service No.</th>
          					<th>Billing Period From</th>
          					<th>Billing Period To</th>
          					<th>Bill No.</th>
          					<th>Date of Bill</th>
          					<th>Due Date</th>
          					<th>Current Reading</th>
          					<th>Reading Date</th>
          					<th>Previous Reading</th>
          					<th>Previous Reading Date</th>
          					<th>Total Bill</th>
          					<th>Past Dues</th>
          					<th>Payable Amount</th>
          					<th>Gross Payable Amount</th>
          					<th>Next Date</th>
          					<th>Status</th>
          				</tr>
          			</thead>
          			<tbody>
          			
          				<?php if(count($bills)>0){ $c=1; foreach($bills as $bill){ ?>
          					<tr >
          						<td><?php echo ++$c; ?></td>
          						<td><?php echo $bill['companyName']; ?></td>
          						<td><?php echo $bill['costcenterName']; ?></td>
          						<td><?php echo $bill['locationName']; ?></td>
          						<td>
          							<?php if($bill['sno_id'] != ''){ ?>
          								<a target="_blank" href="bill-upload/<?php echo $bill['sno_id']; ?>"><?php echo $bill['bpno']; ?></a>
          							<?php } else { ?>
          								<?php echo $bill['bpno']; ?>
          							<?php } ?>
          						</td>
								<td>
									<?php
								        if($bill['from_date'] != '')
								            echo date('d/m/Y',strtotime($bill['from_date'])); 
								    ?>
								</td>
								<td>
									<?php 
									   if($bill['to_date'] != '')
									       echo date('d/m/Y',strtotime($bill['to_date'])); 
									?>
								</td>
								<td><?php echo $bill['bill_no']; ?></td>
          						<td>
          							<?php
          						        if($bill['date_of_bill'] != '')
          						        echo date('d/m/Y',strtotime($bill['date_of_bill'])); 
          						    ?>
          						</td>
								<td>
									<?php
									   if($bill['due_date'] != '')
									   echo date('d/m/Y',strtotime($bill['due_date'])); 
									?>
								</td>
								<td><?php echo $bill['reading']; ?></td>
								<td>
									<?php
									   if($bill['reading_date'] != '')
									   echo date('d/m/Y',strtotime($bill['reading_date'])); 
									?>
								</td>
								<td><?php echo $bill['previous_reading']; ?></td>
								<td>
									<?php 
									if($bill['previous_reading_date'] != '')
									echo date('d/m/Y',strtotime($bill['previous_reading_date'])); 
								    ?>
								</td>
								<td><?php echo $bill['total_bill']; ?></td>
								<td><?php echo $bill['past_dues']; ?></td>
								<td><?php echo $bill['payable_amount']; ?></td>
								<td><?php echo $bill['gross_amount']; ?></td>
								<td>
									<?php 
									   if($bill['date_of_bill'] != '')
									   echo date('d/m/Y',strtotime($bill['next_ittration'])); 
								    ?>
								</td>
								<td class="<?php
                  					if($bill['date_of_bill'] != ''){
                  					    if($bill['status'] == 'Date passed'){
                  					         echo 'bg-danger';
                  					    } else if($bill['status'] == 'Today'){
                  					        echo 'bg-success';
                  					    } else {
                  					        echo 'bg-warning';
                  					    }
                  					} else{
                  					    echo 'bg-secondary';
                  					}
                  					?>"><?php
								    if($bill['date_of_bill'] != ''){
								        echo $bill['status'];
								    } else{
								        echo '-';
								    }
								    ?></td>
          					</tr>
          					
          				<?php }} else { ?>
          					<tr><td colspan="18" class="text-center">No Record Found.</td></tr>
          				<?php } ?>
          			</tbody>
          		</table>
          		</div>
          	</div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    

    <script>
    const baseUrl = $('#base_url').val();
    
    $(document).on('change','#com_filter',function(){
    	const comId = $(this).val();
    	if(comId){
        	$.ajax({
                url: `${baseUrl}Costcenter_ctrl/getCostcenterByCompnayId/${comId}`,
                method: "GET",
                dataType: "json",
                beforeSend(){},
                success(response){
                	var x = '<option value="">Select Cost-center</option>';
                    if(response.status == 200){
                    	$.each(response.data,function(key,value){
                    		x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
                    	});
                    	$('#costc_filter').html(x);
                    } else {
                    	$('#costc_filter').html('<option value="">Select Cost-center</option>');
                    }
                    $('#location_filter').html('<option value="">Select Location</option>');
                }
            });
        } else {
        	$('#costc_filter').html('<option value="">Select Cost-center</option>');
        	$('#location_filter').html('<option value="">Select Location</option>');
        }
    });
    
    $(document).on('change','#costc_filter',function(){
    	const costId = $(this).val();
    	$.ajax({
            url: `${baseUrl}Location_ctrl/getLocationByCostcenterId/${costId}`,
            method: "GET",
            dataType: "json",
            beforeSend(){},
            success(response){
            	var x = '<option value="">Select Location</option>';
                if(response.status == 200){
                	$.each(response.data,function(key,value){
                		x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
                	});
                	$('#location_filter').html(x);
                } else {
                	$('#location_filter').html('<option value="">Select Location</option>');
                }
            }
        });
    });
    
    
    $(document).on('click','#filter',function(){
    	const company = $('#com_filter').val();
    	const costcenter = $('#costc_filter').val();
    	const location = $('#location_filter').val();
    	const status = $('#status_filter').val();
    	
    	window.location.href = `${baseUrl}bill-list/${company}/${costcenter}/${location}/?status=${status}`;
    	
//     	if(company){
//     		if(costcenter){
//     			if(location){
//     				window.location.href = `${baseUrl}bill-list/${company}/${costcenter}/${location}`;
//     			}else{
//     				window.location.href = `${baseUrl}bill-list/${company}/${costcenter}`;
//     			}
//     		} else {
//     			window.location.href = `${baseUrl}bill-list/${company}`;
//     		}
    		
//     	} else {
//     		window.location.href = `${baseUrl}bill-list`;
//     	}
    });
    
    
    $('#bill_test').DataTable({
       	"searching": false,
//         "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false 
    });
    </script>
