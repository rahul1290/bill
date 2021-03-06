    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          		<span class="text-primary" id="page-heading">Bill Payment Details</span>
              <!-- <span class="pull-right" style="float: right;">
                <a class="btn btn-sm btn-primary" href="<?php //echo base_url('Show-Meter-Reading'); ?>">Your Pending Readings</a>
              </span> -->
          		<hr/>
              <div class="row">
                <div class="col-12">
                <?php echo $this->session->flashdata('msg'); ?>
                <form name="f1" method="POST" enctype='multipart/form-data' action="<?php echo base_url();?>payment">
                    <div class="row">
                    	<div class="col-md-3">
                            <label for="inputEmail3" class="col-form-label text-xs">Company</label>
                            <div class="col-sm-12">
                              <select id="company" name="company" class="form-control">
                                    <option value="">Select Company</option>
                                    <?php foreach($companies as $company){ ?>
                                      <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                <?php echo form_error('company'); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="inputEmail3" class="col-form-label text-xs">Cost-Center</label>
                            <div class="col-sm-12">
                                <select id="costcenter" name="costcenter" class="form-control">
                                  <option value="">Select Cost-Center</option>
                                </select>
                              <?php echo form_error('costcenter'); ?>
                          	</div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="inputEmail3" class="col-form-label text-xs">Location</label>
                            <div class="col-sm-12">
                            	<select id="location" name="location" class="form-control">
                              		<option value="">Select Location</option>
                            	</select>
                          		<?php echo form_error('location'); ?>
                          	</div>
                        </div>
                    	
                    	<div class="col-md-3">
                    		
                    		<div class="row mt-4">
                    			<div class="col-sm-6">
                    				<input type="text" name="search" id="search" placeholder="search by Bill No" />
                    			</div>
                    			<div class="col-sm-6">
                    				<input type="button" name="" value="Search" id="search_btn" />
                    			</div>
                    		</div>
                    	</div>
                    </div>
                  	
                  	<div class="table-responsive mt-3">
                  		<table class="table table-bordered table-striped text-sm" id="billTable">
                  			<thead class="bg-light">
                  				<tr>
                  					<th>S.No.</th>
                  					<th>Bill No.</th>
                  					<th>Service No.</th>
                  					<th>Company</th>
                  					<th>Cost-Center</th>
                  					<th>Location</th>
                  					<th>Total Bill</th>
                  					<th>Gross Payment</th>
                  					<th>Bill Date</th>
                  					<th>Due Date</th>
                  					<th>Payment Date</th>
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
    
    
    <div class="modal" id="meterEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body text-center meterEditbody">
          </div>
        </div>
      </div>
    </div>
    

    <script>
    const baseUrl = $('#base_url').val();
    
    pyment_detail();
    
    $(document).on('click','#search_btn',function(){
    	pyment_detail();	
    });
    
   	function pyment_detail(){
   		$.ajax({
            url: `${baseUrl}Payment_ctrl/paymentDetails`,
            method: "POST",
            dataType: "json",
            data : {
            	'company' : $('#company').val(),
           		'costcenter' : $('#costcenter').val(),
           		'location' : $('#location').val(),
           		'search' : $('#search').val()
            },
            success(response){
                if(response.status == 200){
                	var x = '';
                	$.each(response.data,function(key,value){
                		x = x + '<tr>'+
                					'<td>'+ parseInt(key + 1) +'</td>'+
                  					'<td><a href="javascript:void(0);" data-id="'+ value.bill_id +'" class="bill_edit">'+ value.bill_no +'</a></td>'+
                  					'<td>'+ value.bpno +'</td>'+
                  					'<td>'+ value.company_name +'</td>'+
                  					'<td>'+ value.cost_center +'</td>'+
                  					'<td>'+ value.location_name +'</td>'+
                  					'<td>'+ value.gross_amount +'</td>'+
                  					'<td>'+ value.total_bill +'</td>'+
                  					'<td>'+ value.date_of_bill +'</td>'+
                  					'<td>'+ value.due_date +'</td>'+
                  					'<td>'+ value.payment_date +'</td>'+
                				'</tr>'; 
                	});
                	
                	$('#billTable').dataTable().fnClearTable();
    				$('#billTable').dataTable().fnDestroy();
                	$('#meter-paymets').html(x);
                	
                	$('#billTable').DataTable({
                       	"searching": false,
                //         "bPaginate": false,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "bAutoWidth": false 
                    });
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
    
    
    $(document).on('click','.bill_edit',function(){
    	var bill_id = $(this).data('id');
    	
    	$.ajax({
            url: `${baseUrl}Meter_ctrl/getbill_detail/${bill_id}`,
            method: "GET",
            dataType: "json",
            success(response){
                console.log(response);
                if(response.status == 200){
                 var x = '<div class="container-fluid">'+
            		'<div class="row">'+
            			'<div class="col">Service No :<label class="text-info">'+ response.data.bpno +'</label></div>'+
            			'<div class="col">Company :<label class="text-info">'+ response.data.company_name +'</label></div>'+
            			'<div class="col">Costcenter :<label class="text-info">'+ response.data.cost_center +'</label></div>'+
            			'<div class="col">Location :<label class="text-info">'+ response.data.location_name +'</label></div>'+
            		'</div>'+
            		'<div class="row">'+
            			'<div class="col">Bill No :<label class="text-info" id="bill_no">'+ response.data.bill_no +'</label></div>'+
            			'<div class="col">Date of bill :<label class="text-info">'+ response.data.date_of_bill +'</label></div>'+
            		'</div>'+
            		'<div class="row">'+
            			'<div class="col">Bill Amount :<label class="text-info">'+ response.data.gross_amount +'</label></div>'+
            			'<div class="col">Due Date :<label class="text-info">'+ response.data.due_date +'</label></div>'+
            		'</div>'+
            		'<div class="row">'+
                      '<div class="col-md-6">'+
                      	'<div class="form-group row">'+
                          	'<label for="inputEmail3" class="col-sm-3 col-form-label">Payment Amount</label>'+
                          	'<div class="col-sm-9">'+
                            	'<input type="text" name="payment_amount" id="payment_amount" value="'+ response.data.payment_amount +'" class="form-control">'+
							'</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                      '<div class="form-group row">'+
                          '<label for="inputEmail3" class="col-sm-3 col-form-label">Payment Date</label>'+
                          '<div class="col-sm-9">'+
                            '<input type="date" name="payment_date" id="payment_date" class="form-control" value="'+ response.data.payment_date +'">'+
                           '</div>'+
                      '</div>'+
                     '</div>'+
                     '<div class="col-md-6">'+
                      	'<div class="form-group row">'+
                          '<label for="inputEmail3" class="col-sm-3 col-form-label">Payment Type</label>'+
                          	'<div class="col-sm-9">'+
                            	'<select id="p_type" name="p_type" class="form-control">';
                            		
                            		var ptype = '';
                            		if(response.data.payment_type == 'cheque'){
                            			ptype = 'block';
                            			x = x + '<option value="cheque" selected>Cheque</option>'+
                            				'<option value="cash">Cash</option>';
                            		} else {
                            			ptype = 'none';
                            			x = x + '<option value="cheque">Cheque</option>'+
                            				'<option value="cash" selected>Cash</option>';
                            		}
                            	x = x + '</select>'+
                          	'</div>'+
                      	'</div>'+
                       '</div>'+
                      
                       '<div class="col-md-6" id="checknobox" style="display:'+ ptype +';">'+
                      		'<div class="form-group row">'+
                          		'<label for="inputEmail3" class="col-sm-3 col-form-label">Cheque No.</label>'+
                          		'<div class="col-sm-9">'+
                            		'<input type="text" id="checkno" name="checkno" value="'+ response.data.check_no +'" class="form-control" placeholder="Cheque no.">'+
                          		'</div>'+
                      		'</div>'+
                           '</div>'+
                       '</div>'+
                       '<div><input type="button" id="meter_payment_submit" value="Submit" class="btn btn-success"></div>'+
            		'</div>';	
            		
            		$('.meterEditbody').html(x);
                }
            }
        });
    	
    	$('#meterEdit').modal({
    		'show':true
    	});
   
    });
    
    $(document).on('change','#p_type',function(){
    	var x = $(this).val();
    	if(x == 'cheque'){
    		$('#checknobox').show();
    	} else {
    		$('#checknobox').hide();
    	}
    });
    
    
    $(document).on('click','#meter_payment_submit',function(){
    
    	$.ajax({
            url: `${baseUrl}Payment_ctrl/payment_submit`,
            method: "POST",
            dataType: "json",
            data : {
            	'bill_no' : $('#bill_no').text(),
            	'payment_amount' : $('#payment_amount').val(),
            	'payment_date' : $('#payment_date').val(),
            	'payment_type' : $('#p_type').val(),
            	'cheque_no' : $('#checkno').val()
            },
            success(response){
            }
        });
    });
	
    </script>

    