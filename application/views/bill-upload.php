    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="offset-sm-1 col-md-10 col-sm-12">
          		<h5 class="text-primary" id="page-heading">Meter Data Entry</h5>
          		<hr/>
          		<form name="f1" method="POST" enctype='multipart/form-data' action="<?php echo base_url();?>bill-upload">
          			<input type="hidden" name="selected_service_no" id="selected_service_no" value="<?php if(isset($selected_service_no)){ echo $selected_service_no; } ?>">
                    <div class="form-group row">
                    	<div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Company<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="company" name="company" class="form-control">
                                <option value="" selected>Select Company</option>
                                    <?php foreach($companies as $company){ ?>
                                        <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                    <?php } ?>
                                </select>
                              <?php echo form_error('company'); ?>
                            </div>
                        </div>
                    	
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Cost-Center<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="costcenter" name="costcenter" class="form-control">
                                <option value="" selected>Select Costcenter</option>
                              </select>
                              <?php echo form_error('costcenter'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Location<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="location" name="location" class="form-control">
                                <option value="" selected>Select Location</option>
                                </select>
                              <?php echo form_error('location'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Service No.<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <input id="bid" name="bid" type="hidden" class="form-control" value="<?php echo set_value('bid'); ?>">
                              <select id="serviceno" name="serviceno" class="form-control">
                                <option value="" selected>Select Service No.</option>
                                    <?php foreach($service_no as $serviceno){ ?>
                                        <option 
                                        	value="<?php echo $serviceno['mid']; ?>" 
                                        	<?php
                                        	if(isset($selected_service_no)){
                                        	    if($selected_service_no == $serviceno['mid']){
                                        	        echo "selected"; 
                                        	    }
                                        	} else {
                                        	   if(set_value('serviceno') == $serviceno['mid']){ echo "selected"; }
                                        	}
                                        	?>
                                        >
                                        	<?php echo $serviceno['bpno']; ?> <?php /*echo substr($serviceno['company_name'],0,3); ?>-<?php echo substr($serviceno['location_name'],0,3); ?>-<?php echo substr($serviceno['costcenter_name'],0,3); */ ?> 
                                        </option>
                                    <?php } ?>
                                </select>
                              <?php echo form_error('serviceno'); ?>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    
                    <div class="form-group row">
                    	<div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Billing Period from<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" placeholder="dd/mm/YYYY" name="billing_period_from" id="billing_period_from" value="<?php echo set_value('billing_period_from'); ?>" class="form-control"/>
                                <?php echo form_error('billing_period_from'); ?>
                            </div>
                        </div>
                        <div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">to<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" placeholder="dd/mm/YYYY" name="billing_period_to" id="billing_period_to" value="<?php echo set_value('billing_period_to'); ?>" class="form-control"/>
                            <?php echo form_error('billing_period_to'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Bill No.<label class="text-danger">*</label></label>
                        <div class="col-sm-4">
                          <input type="text" name="bill_no" id="bill_no" class="form-control" value="<?php echo set_value('bill_no'); ?>" />
                          <?php echo form_error('bill_no'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    	<div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Date of Bill<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" placeholder="dd/mm/YYYY" name="bill_date" id="bill_date" class="form-control" value="<?php echo set_value('bill_date'); ?>"/>
                            <?php echo form_error('bill_date'); ?>
                            </div>
                        </div>
                        <div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Due Date<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" placeholder="dd/mm/YYYY" name="due_date" id="due_date" class="form-control" value="<?php echo set_value('due_date'); ?>"/>
                            <?php echo form_error('due_date'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <hr/>
                    
                    <div class="form-group row">
                    	<div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-12 col-md-4 col-form-label text-xs">Current Reading<label class="text-danger">*</label></label>
                            <div class="col-sm-12 col-md-8">
                              <input type="text" name="current_reading" id="current_reading" class="form-control" value="<?php echo set_value('current_reading'); ?>" />
                            <?php echo form_error('current_reading'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-12 col-md-4 col-form-label text-xs">Current Reading Date<label class="text-danger">*</label></label>
                            <div class="col-sm-12 col-md-8">
                              <input type="text" placeholder="dd/mm/yyyy" name="current_reading_date" id="current_reading_date" class="form-control" value="<?php echo set_value('current_reading_date'); ?>"/>
                            <?php echo form_error('current_reading_date'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Previous Reading<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="previous_reading" id="previous_reading" value="<?php echo set_value('previous_reading'); ?>" class="form-control"/>
                            <?php echo form_error('previous_reading'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Reading Date<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" placeholder="dd/mm/yyyy" name="previous_reading_date" id="previous_reading_date" class="form-control" value="<?php echo set_value('previous_reading_date'); ?>"/>
                            <?php echo form_error('previous_reading_date'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                   
                   
                    <div class="form-group row offset-6">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Coefficient</label>
                        <div class="col-sm-8">
                          <input class="form-control" type="text" id="coefficient" name="coefficient" value="<?php echo set_value('coefficient');?>" />
                          <?php echo form_error('coefficient'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Power Consumption</label>
                            <div class="col-sm-8">
                              <input type="text" name="power_consumption" id="power_consumption" value="<?php echo set_value('power_consumption'); ?>" class="form-control"/>
                            <?php echo form_error('power_consumption'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Power Factor</label>
                            <div class="col-sm-8">
                              <input type="text" name="power_factor" id="power_factor" class="form-control"/>
                            <?php echo form_error('power_factor'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Total Consumption<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="total_consumption" id="total_consumption" value="<?php echo set_value('total_consumption'); ?>" class="form-control"/>
                            <?php echo form_error('total_consumption'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Highest Demand Reading</label>
                            <div class="col-sm-8">
                              <input type="text" name="highest_demand_rating" id="highest_demand_rating" class="form-control"/>
                            <?php echo form_error('highest_demand_rating'); ?>
                            </div>
                          </div>
                        </div>
                        
                    </div>
                    <hr/>
                    
                    <span class="text-bold text-info">For Any Issue Contact:</span>
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">JE/AE Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="je_ae_name" id="je_ae_name" value="<?php echo set_value('je_ae_name'); ?>" class="form-control"/>
                            <?php echo form_error('je_ae_name'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Contact No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="je_ae_contact" id="je_ae_contact" value="<?php set_Value('je_ae_contact'); ?>" class="form-control"/>
                            <?php echo form_error('je_ae_contact'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <span class="text-bold text-info">If Not Resolved In 7 Days Contact:</span>
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">AE/EE Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="ae_ee_name" id="ae_ee_name" value="<?php echo set_value('ae_ee_name'); ?>" class="form-control"/>
                            <?php echo form_error('ae_ee_name'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Contact No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="ae_ee_contact" id="ae_ee_contact" value="<?php set_Value('ae_ee_contact'); ?>" class="form-control"/>
                            <?php echo form_error('ae_ee_contact'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr/>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Fix/Demand Charges</label>
                            <div class="col-sm-8">
                              <input type="text" name="fix_demand" id="fix_demand" value="<?php echo set_value('fix_demand'); ?>" class="form-control"/>
                            <?php echo form_error('fix_demand'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Minimun Charges</label>
                            <div class="col-sm-8">
                              <input type="text" name="minimum_charge" id="minimum_charge" value="<?php set_Value('minimum_charge'); ?>" class="form-control"/>
                            <?php echo form_error('minimum_charge'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Energy Charges</label>
                        <div class="col-sm-4">
                          <input type="text" name="energy_charges" id="energy_charges" value="<?php echo set_Value('energy_charges');?>" class="form-control"/>
                        <?php echo form_error('energy_charges'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Sum<label class="text-danger">*</label></label>
                        <div class="col-sm-4">
                          <input type="text" name="sum" id="sum" value="<?php echo set_Value('sum');?>" class="form-control"/>
                        <?php echo form_error('sum'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Electricity Duty</label>
                            <div class="col-sm-8">
                              <input type="text" name="electricity_duty" id="electricity_duty" value="<?php echo set_value('electricity_duty'); ?>" class="form-control"/>
                            <?php echo form_error('electricity_duty'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Cess</label>
                            <div class="col-sm-8">
                              <input type="text" name="cess" id="cess" value="<?php set_Value('cess'); ?>" class="form-control"/>
                            <?php echo form_error('cess'); ?>
                            </div>
                          </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Welding/Capacitor Overload</label>
                            <div class="col-sm-8">
                              <input type="text" name="capacitor_overload" id="capacitor_overload" value="<?php echo set_value('capacitor_overload'); ?>" class="form-control"/>
                            <?php echo form_error('capacitor_overload'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Meter Fare</label>
                            <div class="col-sm-8">
                              <input type="text" name="meter_fare" id="meter_fare" value="<?php set_Value('meter_fare'); ?>" class="form-control"/>
                            <?php echo form_error('meter_fare'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">VCA Charge</label>
                            <div class="col-sm-8">
                              <input type="text" name="vca" id="vca" value="<?php echo set_value('vca'); ?>" class="form-control"/>
                            <?php echo form_error('vca'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Additional Security Deposit</label>
                            <div class="col-sm-8">
                              <input type="text" name="security_deposit" id="security_deposit" value="<?php set_Value('security_deposit'); ?>" class="form-control"/>
                            <?php echo form_error('security_deposit'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                        
                    <div class="form-group row offset-6">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Special Concession Amount</label>
                        <div class="col-sm-8">
                          <input class="form-control" type="text" id="concession_amount" name="concession_amount" value="<?php echo set_value('concession_amount');?>" />
                          <?php echo form_error('concession_amount'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Total Bill<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="total_bill" id="total_bill" value="<?php echo set_value('total_bill'); ?>" class="form-control"/>
                            <?php echo form_error('total_bill'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Deviation/Adjustment</label>
                            <div class="col-sm-8">
                              <input type="text" name="deviation" id="deviation" value="<?php set_Value('deviation'); ?>" class="form-control"/>
                            <?php echo form_error('deviation'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Past Dues<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="past_due" id="past_due" value="<?php echo set_value('past_due'); ?>" class="form-control"/>
                              <?php echo form_error('past_due'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Security Fund Outstanding</label>
                            <div class="col-sm-8">
                              <input type="text" name="security_fund_outstanding" id="security_fund_outstanding" value="<?php set_Value('security_fund_outstanding'); ?>" class="form-control"/>
                            <?php echo form_error('security_fund_outstanding'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Net Payable Amount<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="payable_amount" id="payable_amount" value="<?php echo set_value('payable_amount'); ?>" class="form-control"/>
                              <?php echo form_error('payable_amount'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Extra</label>
                            <div class="col-sm-8">
                              <input type="text" name="extra" id="extra" value="<?php set_Value('extra'); ?>" class="form-control"/>
                            <?php echo form_error('extra'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                    	<div class="col-md-6">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Gross Payable Amount including Surcharge<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="text" name="surcharge" id="surcharge" value="<?php echo set_value('surcharge'); ?>" class="form-control"/>
                              <?php echo form_error('surcharge'); ?>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Overload</label>
                            <div class="col-sm-8">
                              <input type="text" name="overload" id="overload" value="<?php set_Value('overload'); ?>" class="form-control"/>
                            <?php echo form_error('overload'); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <img id="show_img" src="" width="200" height="190" style="display:none;" />
                    <object id="show_pdf" width="200" height="190" style="display:none;"></object>
                    <input type="button" id="remove_img" value="Remove" style="display:none;">
                    
                    <div class="form-group row mt-3">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label text-xs">Image</label>
                            <div class="col-sm-7">
                              <input type="file" name="userfile" id="userfile"  class="form-control"/>
                              <?php echo form_error('userfile'); ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="text-center">
                      <input type="submit" class="btn btn-success uppercase" id="assign-create" value="Submit">
                      <button class="btn btn-warning uppercase" id="assign-update" style="display:none;">Update</button>
    	
                      <input type="reset" class="btn btn-secondary uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                      <input type="reset" class="btn btn-secondary uppercase" id="reset-btn" value="Reset">
                    </div>
                </form>
          	</div>
          	<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-8" style="display:none;">
          		<div class="table-responsive">
                    <table class="table table-bordered">
                          <thead class="bg-light">
                                  <tr>
                                    <th class="text-center uppercase">S.No.</th>
                                    <th class="text-center uppercase">Name</th>
                                    <th class="text-center uppercase">Email</th>
                                    <th class="text-center uppercase">Contact No.</th>
                                    <th class="text-center uppercase">Gender</th>
                                    <th class="text-center uppercase">Role</th>
                                    <th class="text-center uppercase">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="userList">
                                <?php if(isset($users)){ $c=1; foreach($users as $user){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $user['fname'] .' '.$user['lname'] ?></td>
                                        <td class="text-center"><?= $user['email'] ?></td>
                                        <td class="text-center"><?= $user['contact_no']; ?></td>
                                        <td class="text-center"><?= $user['sex']; ?></td>
                                        <td class="text-center"><?= $user['role']; ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="user_edit" data-id="<?= $user['uid']; ?>"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="user_delete" data-id="<?= $user['uid']; ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } } else {  echo "<tr><td class='text-center' colspan='6'>No record found.</td></tr>"; } ?>
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
    
    $('#serviceno').select2();
	
  	$("#billing_period_from,#billing_period_to,#bill_date,#due_date").datepicker({ 
       dateFormat: 'dd/mm/yy',
    });
                              
	
	
	getServiceNo();
	function getServiceNo(){
		var billNo = $('#selected_service_no').val();
		$('#loaderModal').modal({
   			'show':true,
   			'backdrop' :'static',
   			'keyboard' : false
   		});
		
		$.ajax({
            url: `${baseUrl}Meter_ctrl/getbill_detail/${billNo}`,
            method: "GET",
            dataType: "json",
            success(response){
            	console.log(response);
            	$('#costcenter').html('<option value="'+ response.data.costc_id +'">'+ response.data.cost_center +'</option>');
                        $('#location').html('<option value="'+ response.data.loc_id +'">'+ response.data.location_name +'</option>');
                        $('#company').html('<option value="'+ response.data.cid +'">'+ response.data.company_name +'</option>');
                        
                        $('#serviceno').val(response.data.mid).select2();
                        $('#billing_period_from').val(response.data.from_date);
                    	$('#billing_period_to').val(response.data.to_date);
                    	$('#bill_no').val(response.data.bill_no);
                    	$('#bill_date').val(response.data.date_of_bill);
                    	$('#due_date').val(response.data.due_date);
                    	$('#current_reading').val(response.data.reading);
                    	$('#current_reading_date').val(response.data.reading_date);
                    	$('#previous_reading').val(response.data.previous_reading);
                    	$('#previous_reading_date').val(response.data.previous_reading_date);
                    	//$('#coefficient').val(response.payment_detail[0].);
                    	$('#power_consumption').val(response.data.power_consumption);
                    	$('#power_factor').val(response.data.power_factor);
                    	$('#total_consumption').val(response.data.total_consumption);
                    	$('#highest_demand_rating').val(response.data.highest_demand_reading);
                    	$('#je_ae_name').val(response.data.je_ae_name);
                    	$('#je_ae_contact').val(response.data.je_ae_contact_no);
                    	$('#ae_ee_name').val(response.data.ae_ee_name);
                    	$('#ae_ee_contact').val(response.data.ae_ee_contact_no);
                    	$('#fix_demand').val(response.data.fixed_demand_charges);
                    	$('#minimum_charge').val(response.data.minimum_charges);
                    	$('#energy_charges').val(response.data.energy_charges);
                    	$('#sum').val(response.data.total_charges);
                    	$('#electricity_duty').val(response.data.electricity_duty);
                    	$('#cess').val(response.data.cess);
                    	$('#capacitor_overload').val(response.data.welding_capacitor_overload);
                    	$('#meter_fare').val(response.data.meter_fare);
                    	$('#vca').val(response.data.vca_charge);
                    	$('#security_deposit').val(response.data.security_deposit);
                    	$('#concession_amount').val(response.data.concession_amount);
                    	$('#total_bill').val(response.data.total_bill);
                    	$('#deviation').val(response.data.deviation_adjustment);
                    	$('#past_due').val(response.data.past_dues);
                    	$('#security_fund_outstanding').val(response.data.security_fund_outstanding);
                    	$('#payable_amount').val(response.data.payable_amount);
                    	$('#extra').val(response.data.extra);
                    	$('#surcharge').val(response.data.gross_amount);
                    	$('#overload').val(response.data.overload);
                    	
                    	var x = response.data.image.split('.');
                    	console.log(`length ${x.length}`)
                    	if(x.length > 1){
                        	if(x[length+1] == 'pdf' || x[length+1] == 'PDF'){
                        		$('#show_pdf').show().attr('data',`${baseUrl}upload/bills/${response.data.image}`);
                        	} else {
                        		$('#show_img').show().attr('src',`${baseUrl}upload/bills/${response.data.image}`);
                        	}
                        	
                        	$('#remove_img').show();
                    	}
                    	
                    	$('#assign-update').show();
                    	$('#assign-create').hide();
                    
            }
        });
        $('#loaderModal').modal('toggle');
	}
	
	
	$(document).on('click','#remove_img',function(){
		var billNo = $('#selected_service_no').val();
		$.ajax({
                url: `${baseUrl}Meter_ctrl/remove_Meter_bill/${billNo}`,
                method: "GET",
                dataType: "json",
                success(response){
                	if(response.status == 200){
                		$('#show_img').hide();
                		$('#show_pdf').hide();
                		$('#remove_img').hide();
                		alert('Image removed.');
                	}
                }
       	});
	});

		
	$(document).on('change','#serviceno',function(){
		var serviceNo = $(this).val();
		$.ajax({
            url: `${baseUrl}Meter_ctrl/getMeters/${serviceNo}`,
            method: "GET",
            dataType: "json",
            success(response){
            	console.log(response);
                if(response.status == 200){
                    $('#costcenter').html('<option value="'+ response.data[0]['costc_id'] +'">'+ response.data[0]['cost_center'] +'</option>');
                    $('#location').html('<option value="'+ response.data[0]['loc_id'] +'">'+ response.data[0]['location_name'] +'</option>');
                    $('#company').html('<option value="'+ response.data[0]['cid'] +'">'+ response.data[0]['company_name'] +'</option>');
                    
                    
                    $('#previous_reading').val(response.payment_detail[0].reading);
                    $('#previous_reading_date').val(response.payment_detail[0].reading_date);
                    
                        $('#billing_period_from').val(response.payment_detail[0].from_date);
                    	$('#billing_period_to').val(response.payment_detail[0].to_date);
                    	$('#bill_no').val('');
                    	$('#bill_date').val('');
                    	$('#due_date').val('');
                    	$('#current_reading').val('');
                    	$('#current_reading_date').val('');
                    	$('#previous_reading').val(response.payment_detail[0].previous_reading);
                    	$('#previous_reading_date').val(response.payment_detail[0].previous_reading_date);

                    	$('#power_consumption').val(response.payment_detail[0].power_consumption);
                    	$('#power_factor').val(response.payment_detail[0].power_factor);
                    	$('#total_consumption').val(response.payment_detail[0].total_consumption);
                    	$('#highest_demand_rating').val(response.payment_detail[0].highest_demand_reading);
                    	$('#je_ae_name').val(response.payment_detail[0].je_ae_name);
                    	$('#je_ae_contact').val(response.payment_detail[0].je_ae_contact_no);
                    	$('#ae_ee_name').val(response.payment_detail[0].ae_ee_name);
                    	$('#ae_ee_contact').val(response.payment_detail[0].ae_ee_contact_no);
                    	$('#fix_demand').val(response.payment_detail[0].fixed_demand_charges);
                    	$('#minimum_charge').val(response.payment_detail[0].minimum_charges);
                    	$('#energy_charges').val(response.payment_detail[0].energy_charges);
                    	$('#sum').val(response.payment_detail[0].total_charges);
                    	$('#electricity_duty').val(response.payment_detail[0].electricity_duty);
                    	$('#cess').val(response.payment_detail[0].cess);
                    	$('#capacitor_overload').val(response.payment_detail[0].welding_capacitor_overload);
                    	$('#meter_fare').val(response.payment_detail[0].meter_fare);
                    	$('#vca').val(response.payment_detail[0].vca_charge);
                    	$('#security_deposit').val(response.payment_detail[0].security_deposit);
                    	$('#concession_amount').val(response.payment_detail[0].concession_amount);
                    	$('#total_bill').val('');
                    	$('#deviation').val(response.payment_detail[0].deviation_adjustment);
                    	$('#past_due').val('');
                    	$('#security_fund_outstanding').val(response.payment_detail[0].security_fund_outstanding);
                    	$('#payable_amount').val('');
                    	$('#extra').val(response.payment_detail[0].extra);
                    	$('#surcharge').val('');
                    	$('#overload').val(response.payment_detail[0].overload);
                }
            }
        });
	});
	
	
	$(document).on('change','#company',function(){
		var company = $(this).val();
		$.ajax({
            url: `${baseUrl}Costcenter_ctrl/getCostcenterByCompnayId/${company}`,
            method: "GET",
            dataType: "json",
            success(response){
            	if(response.status == 200){
            		var x = '<option value="">Select Cost-center</option>';
            		$.each(response.data,function(key,value){
            			x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
            		});
            		$('#costcenter').html(x);
            	} else {
            		$('#costcenter').html('<option value="">Select Cost-center</option>');
            	}
            	$('#location').html('<option value="">Select Location</option>');
            }
       });		
	});
	
	$(document).on('change','#costcenter',function(){
		var company = $('#company').val();
		var costcenter = $(this).val();
		$.ajax({
            url: `${baseUrl}Location_ctrl/get_my_location/${company}/${costcenter}`,
            method: "GET",
            dataType: "json",
            success(response){
            	if(response.status == 200){
            		var x = '<option value="">Select Location</option>';
            		$.each(response.data,function(key,value){
            			x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
            		});
            		$('#location').html(x);
            	} else {
            		$('#location').html('<option value="">Select Location</option>');
            	}
            }
       });		
	});
	
	
	$(document).on('change','#location',function(){
		var company = $('#company').val();
		var costcenter = $('#costcenter').val();
		var location = $(this).val();
		$.ajax({
            url: `${baseUrl}Meter_ctrl/get_my_meters/${company}/${costcenter}/${location}`,
            method: "GET",
            dataType: "json",
            success(response){
            	if(response.status == 200){
            		var x = '<option value="">Select Service No.</option>';
            		$.each(response.data,function(key,value){
            			x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
            		});
            		$('#serviceno').html(x);
            	} else {
            		$('#serviceno').html('<option value="">Select Service No</option>');
            	}
            }
       });		
	});
	
    </script>
