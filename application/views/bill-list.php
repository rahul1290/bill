    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="col-sm-12">
          		<h5 class="text-primary" id="page-heading">My Bills</h5>
          		<hr/>
          		<table border="1">
          			<thead>
          				<tr>
          					<th>Sno.</th>
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
          				</tr>
          			</thead>
          			<tbody>
          			
          				<?php if(count($bills)>0){ $c=1; foreach($bills as $bill){ ?>
          					<tr>
          						<td><?php echo $c ?></td>
          						<td><?php echo $bill['companyName']; ?></td>
          						<td><?php echo $bill['costcenterName']; ?></td>
          						<td><?php echo $bill['locationName']; ?></td>
          						<td><?php echo $bill['bpno']; ?></td>
								<td><?php echo $bill['from_date']; ?></td>
								<td><?php echo $bill['to_date']; ?></td>
								<td><?php echo $bill['bill_no']; ?></td>
          						<td><?php echo $bill['date_of_bill']; ?></td>
								<td><?php echo $bill['due_date']; ?></td>
								<td><?php echo $bill['reading']; ?></td>
								<td><?php echo $bill['reading_date']; ?></td>
								<td><?php echo $bill['previous_reading']; ?></td>
								<td><?php echo $bill['previous_reading_date']; ?></td>
								<td><?php echo $bill['total_bill']; ?></td>
								<td><?php echo $bill['past_dues']; ?></td>
								<td><?php echo $bill['payable_amount']; ?></td>
								<td><?php echo $bill['gross_amount']; ?></td>
          					</tr>
          				<?php }} ?>
          			</tbody>
          		</table>
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
