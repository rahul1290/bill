    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          		<span class="text-primary" id="page-heading">Bill Payment</span>
              <!-- <span class="pull-right" style="float: right;">
                <a class="btn btn-sm btn-primary" href="<?php //echo base_url('Show-Meter-Reading'); ?>">Your Pending Readings</a>
              </span> -->
          		<hr/>
              <div class="row">
                <div class="col-12">
                <?php echo $this->session->flashdata('msg'); ?>
                <form name="f1" method="POST" enctype='multipart/form-data' action="<?php echo base_url();?>payment">
                    <div class="row">
                    	<div class="col">
                    		<div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Company</label>
                                <div class="col-sm-9">
                                  <select id="company" name="company" class="form-control">
                                    <option value="">Select Company</option>
                                    <?php foreach($companies as $company){ ?>
                                      <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                <?php echo form_error('company'); ?>
                                </div>
                            </div>
                    	</div>
                    	<div class="col">
                    		<div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label">Cost-Center</label>
                                  <div class="col-sm-9">
                                    <select id="costcenter" name="costcenter" class="form-control">
                                      <option value="">Select Cost-Center</option>
                                    </select>
                                  <?php echo form_error('costcenter'); ?>
                                  </div>
                              </div>
                    	</div>
                    	<div class="col">
                    		<div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label">Location</label>
                                  <div class="col-sm-9">
                                    <select id="location" name="location" class="form-control">
                                      <option value="">Select Location</option>
                                    </select>
                                  <?php echo form_error('location'); ?>
                                  </div>
                              </div>
                    	</div>
                    </div>
                  	
                  	<div class="table-responsive">
                  		<table class="table table-bordered">
                  			<thead>
                  				<tr>
                  					<th>Sno.</th>
                  					<th>Bill Date</th>
                  					<th>Bill No.</th>
                  					<th>Service No.</th>
                  					<th>Location</th>
                  					<th>Cost-center</th>
                  					<th>Company</th>
                  					<th>Gross Payment</th>
                  					<th>Due Date</th>
                  				</tr>
                  			</thead>
                  			<tbody id="meter-paymets">
                  			</tbody>
                  		</table>
                  	</div>
                  
                  </form>
                </div>
              </div>
          	

          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    

    <script>
    const baseUrl = $('#base_url').val();
    
    pyment_detail();
   	function pyment_detail(){
   		$.ajax({
            url: `${baseUrl}Payment_ctrl/paymentDetails`,
            method: "GET",
            dataType: "json",
            success(response){
                if(response.status == 200){
                	var x = '';
                	$.each(response.data,function(key,value){
                		x = x + '<tr>'+
                					'<td>'+ parseInt(key + 1) +'</td>'+
                					'<td>'+ value.date_of_bill +'</td>'+
                  					'<td>'+ value.bill_no +'</td>'+
                  					'<td>'+ value.bpno +'</td>'+
                  					'<td>'+ value.location_name +'</td>'+	
                  					'<td>'+ value.cost_center +'</td>'+
                  					'<td>'+ value.company_name +'</td>'+
                  					'<td>'+ value.total_bill +'</td>'+
                  					'<td>'+ value.due_date +'</td>'+
                				'</tr>'; 
                	});
                	
                	$('#meter-paymets').html(x);
                }
            }
        });
   }
    
    $('#pending-readingsk').DataTable();
    
    $(document).on('change','#serviceno',function(){
    	var serviceNo = $(this).val();
		$.ajax({
            url: `${baseUrl}Meter_ctrl/getMeters/${serviceNo}`,
            method: "GET",
            dataType: "json",
            success(response){
                if(response.status == 200){
                	console.log(response);
                    $('#costcenter').html('<option value="'+ response.data[0]['costc_id'] +'">'+ response.data[0]['cost_center'] +'</option>');
                    $('#location').html('<option value="'+ response.data[0]['loc_id'] +'">'+ response.data[0]['location_name'] +'</option>');
                    $('#company').html('<option value="'+ response.data[0]['cid'] +'">'+ response.data[0]['company_name'] +'</option>');
                    
                    $('#bill_no').val(response.payment_detail[0]['bill_no']);
                    $('#bill_date').val(response.payment_detail[0]['date_of_bill']);
                    $('#bill_amount').val(response.payment_detail[0]['total_bill']);
                    $('#due_date').val(response.payment_detail[0]['due_date']);	
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
                console.log(response);
                if(response.status == 200){
                    var x = '<option value="">Select Cost-Center</option>';
                    $.each(response.data,function(key,value){
                      x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
                    });
                    $('#costcenter').html(x); 
                }
                else {
                  $('#costcenter').html('<option value="">Select Cost-Center</option>');
                }
            }
        });
    });

    $(document).on('change','#costcenter',function(){
      var costcenter = $(this).val();
      $.ajax({
            url: `${baseUrl}Location_ctrl/getLocationByCostcenterId/${costcenter}`,
            method: "GET",
            dataType: "json",
            success(response){
                console.log(response);
                if(response.status == 200){
                    var x = '<option value="">Select Location</option>';
                    $.each(response.data,function(key,value){
                      x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
                    });
                    $('#location').html(x); 
                }
                else {
                  $('#location').html('<option value="">Select Location</option>');
                }
            }
        });
    });

    $(document).on('change','#location',function(){
      var location = $(this).val();
      if(location > 0){
      $.ajax({
            url: `${baseUrl}Meter_ctrl/getMeterByLocationId/${location}`,
            method: "GET",
            dataType: "json",
            success(response){
                console.log(response);
                if(response.status == 200){
                    var x = '<option value="">Select Service No</option>';
                    $.each(response.data,function(key,value){
                      x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
                    });
                    $('#serviceno').html(x); 
                }
                else {
                  $('#serviceno').html('<option value="">Select Service No</option>');
                }
            }
        });
      } else {
        $('#serviceno').html('<option value="">Select Service No</option>');
      }
    });

	
    </script>
