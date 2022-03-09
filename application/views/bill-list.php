   <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-12">
          		<h5 class="text-primary" id="page-heading">My Bill Entries</h5>
          		<hr/>
          		<?php echo $this->session->flashdata('msg'); ?>
          		<div class="table-responsive">
          		<table class="table table-striped table-sm text-sm border" >
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
          						<td><?php echo $bill['bpno']; ?></td>
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
    </script>
