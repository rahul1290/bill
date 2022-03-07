    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="offset-sm-1 col-md-10 col-sm-12">
          		<h5 class="text-primary" id="page-heading">Meter Data Entry</h5>
          		<hr/>
          		<form name="f1" method="POST" enctype='multipart/form-data' action="<?php echo base_url();?>bill-upload">
          		
                    <div class="form-group row">
                    	<div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Service No.<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <input id="bid" name="bid" type="hidden" class="form-control" value="<?php echo set_value('bid'); ?>">
                              <select id="serviceno" name="serviceno" class="form-control">
                                <option value="" selected>Select Service No.</option>
                                    <?php foreach($service_no as $serviceno){ ?>
                                        <option value="<?php echo $serviceno['mid']; ?>"><?php echo $serviceno['bpno']; ?></option>
                                    <?php } ?>
                                </select>
                              <?php echo form_error('serviceno'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Cost-Center<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="costcenter" name="costcenter" class="form-control" disabled>
                                <option value="" selected>Select Company</option>
                              </select>
                              <?php echo form_error('costcenter'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Location<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="location" name="location" class="form-control" disabled>
                                <option value="" selected>Select Company</option>
                                </select>
                              <?php echo form_error('location'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail3" class="col-form-label text-xs">Company<label class="text-danger">*</label></label>
                            <div class="col-sm-12">
                              <select id="company" name="company" class="form-control" disabled>
                                <option value="" selected>Select Company</option>
                                    <?php foreach($companies as $company){ ?>
                                        <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                    <?php } ?>
                                </select>
                              <?php echo form_error('company'); ?>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    
                    <div class="form-group row">
                    	<div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Billing Period from<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="date" name="billing_period_from" id="billing_period_from" value="<?php echo set_value('billing_period_from'); ?>" class="form-control"/>
                            <?php echo form_error('billing_period_from'); ?>
                            </div>
                        </div>
                        <div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">to<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="date" name="billing_period_to" id="billing_period_to" value="<?php echo set_value('billing_period_to'); ?>" class="form-control"/>
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
                              <input type="date" name="bill_date" id="bill_date" class="form-control" value="<?php echo set_value('bill_date'); ?>"/>
                            <?php echo form_error('bill_date'); ?>
                            </div>
                        </div>
                        <div class="col row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-xs">Due Date<label class="text-danger">*</label></label>
                            <div class="col-sm-8">
                              <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo set_value('due_date'); ?>"/>
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
                              <input type="date" name="current_reading_date" id="current_reading_date" class="form-control" value="<?php echo set_value('current_reading_date'); ?>"/>
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
                              <input type="date" name="previous_reading_date" id="previous_reading_date" class="form-control"/>
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
                    <div class="form-group row mt-3">
                    	<div class="row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label text-xs">Image<label class="text-danger">*</label></label>
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
    
    function getCostCenter(cid){
        $.ajax({
            url: `${baseUrl}Costcenter_ctrl/getCostcenterByCompnayId/${cid}`,
            method: "POST",
            dataType: "json",
            data : {
                cid : $(this).data('id')
            },
            success(response){
                var x = '<option value="">Select Cost-center</option>';
                if(response.status == 200){
                    $.each(response.data,function(key,value){
                        x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
                    });
                    $('#costc_id').html(x);
                }
                $('#costc_id').html(x);
            }
        });
	}
	
	
	$(document).on('change','#serviceno',function(){
		var serviceNo = $(this).val();
		$.ajax({
            url: `${baseUrl}Meter_ctrl/getMeters/${serviceNo}`,
            method: "GET",
            dataType: "json",
            success(response){
                if(response.status == 200){
                    $('#costcenter').html('<option value="'+ response.data[0]['costc_id'] +'">'+ response.data[0]['cost_center'] +'</option>');
                    $('#location').html('<option value="'+ response.data[0]['loc_id'] +'">'+ response.data[0]['location_name'] +'</option>');
                    $('#company').html('<option value="'+ response.data[0]['cid'] +'">'+ response.data[0]['company_name'] +'</option>');
                }
            }
        });
	});
	
	
    </script>
