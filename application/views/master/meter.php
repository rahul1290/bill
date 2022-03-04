    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          		<h5 class="text-warning" id="page-heading">Create Meter</h5>
          		<hr/>
          		<form name="f1" method="POST" action="<?php echo base_url();?>master/Meter">
          		
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Company<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <input id="mid" name="mid" type="hidden" class="form-control" value="<?php echo set_value('mid'); ?>">
                          <select id="cid" name="cid" class="form-control">
                            <option value="" selected>Select Company</option>
                                <?php foreach($companies as $company){ ?>
                                    <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('cid'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Cost-center<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <select id="costc_id" name="costc_id" class="form-control">
                             <option value="" selected>Select Cost-Center</option>
                          </select>
                          <?php echo form_error('costc_id'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Location<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <select id="loc_id" name="loc_id" class="form-control">
                            <option value="" selected>Select Location</option>
                        </select>
                        <?php echo form_error('loc_id'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Meter Type<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <select id="mtype" name="mtype" class="form-control">
                            <option value="">Select Meter Type</option>
                            <option value="main-meter" <?php if(set_value('mtype') == 'main-meter'){ echo "selected"; }?>>Main</option>
                            <option value="sub-meter" <?php if(set_value('mtype') == 'sub-meter'){ echo "selected"; }?>>Sub meter</option>
                          </select>
                          <?php echo form_error('mtype'); ?>
                        </div>
                    </div>
                    <div class="form-group row" id="main-meter-block" style="display:<?php 
                            if(set_value('mtype') == ''){ 
                                echo "none"; 
                            } else { 
                                if(set_value('mtype') == 'sub-meter'){
                                    echo "";
                                } else {
                                    echo "none";
                                }
                            }?>"
                    >
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Main Meter</label>
                        <div class="col-sm-8">
                          <select id="main_meter" name="main_meter" class="form-control">
                          	<option value="">Select Main Meter</option>
                          </select>
                          <?php echo form_error('main_meter'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">BP No.<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <input id="bpno" name="bpno" type="text" class="form-control" value="<?php echo set_value('bpno'); ?>">
                          <?php echo form_error('bpno'); ?>
                        </div>
                    </div>
                    
                    <div class="text-center mb-4">
                      <input type="submit" class="btn btn-outline-success uppercase" id="meter-create" value="Create">
                      <button class="btn btn-outline-warning uppercase" id="meter-update" style="display:none;">Update</button>
    	
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="reset-btn" value="Reset">
                    </div>
                </form>
          	</div>
          	<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
          		<div class="table-responsive">
                    <table class="table table-bordered">
                          <thead class="bg-light">
                              <tr>
                                <th class="text-center uppercase">S.No.</th>
                                <th class="text-center uppercase">BP No.</th>
                                <th class="text-center uppercase">Meter Type</th>
                                <th class="text-center uppercase">Company Name</th>
                                <th class="text-center uppercase">Cost-Center</th>
                                <th class="text-center uppercase">Location</th>
                                <th class="text-center uppercase">Created At</th>
                                <th class="text-center uppercase">Created By</th>
                                <th class="text-center uppercase">Action</th>
                              </tr>
                          </thead>
                          <tbody id="meterList">
                            <?php if(isset($meters)){ $c=1; foreach($meters as $meter){ ?>
                                <tr>
                                    <td class="text-center"><?= $c++; ?></td>
                                    <td class="text-center"><?= $meter['bpno']; ?></td>
                                    <td class="text-center"><?= $meter['mtype']; ?></td>
                                    <td class="text-center"><?= $meter['company_name']; ?></td>
                                    <td class="text-center"><?= $meter['cost_center']; ?></td>
                                    <td class="text-center"><?= $meter['location_name']; ?></td>
                                    <td class="text-center"><?= $meter['created_at']; ?></td>
                                    <td class="text-center"><?= $meter['fname'].' '.$meter['lname']; ?></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="meter_edit" data-id="<?= $meter['mid']; ?>"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="meter_delete" data-id="<?= $meter['mid']; ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } } else {  echo "<tr><td class='text-center' colspan='9'>No record found.</td></tr>"; } ?>
                          </tbody>
                      </table>
                  </div>
          	</div>
          </div>
          
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    

    <script>
    const baseUrl = $('#base_url').val();
    
       $(document).on('change','#cid',function(){
        let cid = $(this).val();
        $.ajax({
            url: `${baseUrl}Costcenter_ctrl/getCostcenterByCompnayId/${cid}`,
            method: "GET",
            dataType: "json",
            beforeSend(){},
            success(response){
                console.log(response);
                if(response.status == 200){
                    var x = '<option value="">Select cost-center</option>';
                    $.each(response.data,function(key,value){
                        x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
                    });
                    $('#costc_id').html(x);
                }
            }
        });
      });

	  $(document).on('change','#mtype',function(){
	  	if($(this).val() == 'sub-meter'){
	  		$('#main-meter-block').show();
	  			
	  		$.ajax({
            url: `${baseUrl}Meter_ctrl/getMeterByLocationId/${$('#loc_id').val()}`,
            method: "POST",
            dataType: "json",
            beforeSend(){},
            success(response){
                if(response.status == 200){
                    var x = '<option value="">Select Main Meter</option>';
                    $.each(response.data,function(key,value){
                        x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
                    });
                    $('#main_meter').html(x);
                }
            }
        });
	  	} else {
	  		$('#main-meter-block').hide();
	  		var x = '<option value="">Select Main Meter</option>';
            $('#main_meter').html(x);
	  	}
	  	
	  });

      $(document).on('change','#costc_id',function(){
        let costc_id = $(this).val();
        $.ajax({
            url: `${baseUrl}Location_ctrl/getLocationByCostcenterId/${costc_id}`,
            method: "GET",
            dataType: "json",
            beforeSend(){},
            success(response){
                if(response.status == 200){
                    var x = '<option value="">Select location</option>';
                    $.each(response.data,function(key,value){
                        x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
                    });
                    $('#loc_id').html(x);
                }
            }
        });
      });

    
      $(document).on('click','.meter_edit',function(){
        var request = $.ajax({
                url: `${baseUrl}Meter_ctrl/getMeterById`,
                method: "POST",
                data: { lid : $(this).data('id') },
                dataType: "json",
                });    
            request.done(function( response ) {
                console.log(response);
                if(response.status == 200){
                	$('#page-heading').html('Update Meter');
                    $('#meter-update').show();
                    $('#cancel-btn').show();
                    $('#meter-create').hide();
                    $('#reset-btn').hide();

                    $('#mid').val(response.data['mid']);
                    $('#cid').val(response.data['cid']);

                    //////////
                    $.ajax({
                        url: `${baseUrl}Costcenter_ctrl/getCostcenterByCompnayId/${response.data['cid']}`,
                        method: "GET",
                        dataType: "json",
                        async : false,
                        beforeSend(){},
                        success(response1){
                            if(response1.status == 200){
                                var x = '<option value="">Select location</option>';
                                $.each(response1.data,function(key,value){
                                    x = x + '<option value="'+ value.costc_id +'">'+ value.name +'</option>';
                                });
                                $('#costc_id').html(x);
                            }
                        }
                    });
                    $('#costc_id').val(response.data['costc_id']);
                    /////////////
                    $.ajax({
                        url: `${baseUrl}Location_ctrl/getLocationByCostcenterId/${response.data['costc_id']}`,
                        method: "GET",
                        dataType: "json",
                        async: false,
                        beforeSend(){},
                        success(response){
                            if(response.status == 200){
                                var x = '<option value="">Select location</option>';
                                $.each(response.data,function(key,value){
                                    x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
                                });
                                $('#loc_id').html(x);
                            }
                        }
                    });
                    $('#loc_id').val(response.data['loc_id']);
                    //////////////////
                    $('#mtype').val(response.data['mtype']);
                    
                    if(response.data['parent_meter'] != null){
                        $.ajax({
                            url: `${baseUrl}Meter_ctrl/getMeterByLocationId/${response.data['loc_id']}`,
                            method: "GET",
                            dataType: "json",
                            async: false,
                            beforeSend(){},
                            success(response){
                                if(response.status == 200){
                                    var x = '<option value="">Select Main Meter</option>';
                                    $.each(response.data,function(key,value){
                                        x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
                                    });
                                    $('#main_meter').html(x);
                                }
                            }
                        });
                        debugger;
                        $('#main-meter-block').show();
                    }
                    $('#main_meter').val(response.data['parent_meter']);
                    $('#bpno').val(response.data['bpno']);
                }
            });
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
      });

      $('#cancel-btn').on('click',function(){
      		$('#page-heading').html('Create Meter');
            $('#meter-update').hide();
            $('#cancel-btn').hide();
            $('#meter-create').show();
            $('#reset-btn').show();
      });


      $(document).on('click','.meter_delete',function(){
        $.ajax({
            url: `${baseUrl}Meter_ctrl/delete_meter`,
            method: "POST",
            dataType: "json",
            data : {
                mid : $(this).data('id')
            },
            beforeSend(){
                $('#meterList').html('<tr><td colspan="9"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                alert(response.msg);
                reload();
            }
        });
      });


      

      function reload(){
        $.ajax({
            url: `${baseUrl}Meter_ctrl/getMeters`,
            method: "GET",
            dataType: "json",
            beforeSend(){
                $('#meterList').html('<tr><td colspan="9"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                if(response.status == 200){
                    var x = '';
                    $.each(response.data,function(key,value){
                        x = x + '<tr>'+
                                    '<td class="text-center">'+ parseInt(key+1) +'</td>'+
                                    '<td class="text-center">'+ value.bpno +'</td>'+
                                    '<td class="text-center">'+ value.mtype +'</td>'+
                                    '<td class="text-center">'+ value.company_name +'</td>'+
                                    '<td class="text-center">'+ value.cost_center +'</td>'+
                                    '<td class="text-center">'+ value.location_name +'</td>'+
                                    '<td class="text-center">'+ value.created_at +'</td>'+
                                    '<td class="text-center">'+ value.fname +' '+ value.lname +'</td>'+
                                    '<td class="text-center">'+
                                        '<a href="javascript:void(0);" class="meter_edit" data-id="'+ value.mid +'"><i class="la la-pencil"></i></a>'+
                                        '<a href="javascript:void(0);" class="meter_delete" data-id="'+ value.mid +'"><i class="la la-trash"></i></a>'+
                                    '</td>'+
                                '</tr>';

                        $('#meterList').html(x);
                    })
                }
            }
        });
      }


    </script>