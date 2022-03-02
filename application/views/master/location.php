    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
          	<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          		<h5 class="text-warning" id="page-heading">Create Location</h5>
          		<hr/>
          		<form name="f1" method="POST" action="<?php echo base_url();?>master/Location">
          		
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Cost-center<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <input id="lid" name="lid" type="hidden" class="form-control" value="<?php echo set_value('lid'); ?>">
                          <select id="cost_center" name="cost_center" class="form-control">
                            <option value="" selected>Select cost-center</option>
                                <?php foreach($costceners as $costcener){ ?>
                                    <option value="<?php echo $costcener['costc_id']; ?>"><?php echo $costcener['name']; ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('cost_center'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Location Name<label class="text-danger">*</label></label>
                        <div class="col-sm-8">
                          <input id="lname" name="lname" type="text" class="form-control" value="<?php echo set_value('lname'); ?>">
                          <?php echo form_error('lname'); ?>
                        </div>
                    </div>
                    
                    <div class="text-center">
                      <input type="submit" class="btn btn-outline-success uppercase" id="location-create" value="Create">
                      <button class="btn btn-outline-warning uppercase" id="location-update" style="display:none;">Update</button>
    	
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="reset-btn" value="Reset">
                    </div>
                </form>
          	</div>
          	<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
          		<div class="table-responsive">
                    <table class="table table-bordered">
                              <thead>
                                  <tr>
                                    <th class="text-center uppercase">S.No.</th>
                                    <th class="text-center uppercase">Location Name</th>
                                    <th class="text-center uppercase">Cost-center / Company Name</th>
                                    <th class="text-center uppercase">Created At</th>
                                    <th class="text-center uppercase">Created By</th>
                                    <th class="text-center uppercase">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="locationList">
                                <?php if(isset($locations)){ $c=1; foreach($locations as $location){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $location['name']; ?></td>
                                        <td class="text-center"><?= $location['cost_center']; ?> / <?php echo $location['company_name']; ?></td>
                                        <td class="text-center"><?= $location['created_at']; ?></td>
                                        <td class="text-center"><?= $location['fname'].' '.$location['lname']; ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="location_edit" data-id="<?= $location['loc_id']; ?>"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="location_delete" data-id="<?= $location['loc_id']; ?>"><i class="fas fa-trash"></i></a>
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
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    

    <script>
    const baseUrl = $('#base_url').val();
    
      $(document).on('click','.location_edit',function(){
        var request = $.ajax({
                url: `${baseUrl}Location_ctrl/getLocationById`,
                method: "POST",
                data: { lid : $(this).data('id') },
                dataType: "json"
                });    
            request.done(function( response ) {
                console.log(response);
                if(response.status == 200){
                	$('#page-heading').html('Update Location');
                    $('#location-update').show();
                    $('#cancel-btn').show();
                    $('#location-create').hide();
                    $('#reset-btn').hide();

                    $('#lid').val(response.data['loc_id']);
                    $('#cost_center').val(response.data['cost_center_id']);
                    $('#lname').val(response.data['name']);
                }
            });
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
      });

      $('#cancel-btn').on('click',function(){
      		$('#page-heading').html('Create Location');
            $('#location-update').hide();
            $('#cancel-btn').hide();
            $('#location-create').show();
            $('#reset-btn').show();
      });


      $(document).on('click','.location_delete',function(){
        $.ajax({
            url: `${baseUrl}Location_ctrl/delete_location`,
            method: "POST",
            dataType: "json",
            data : {
                lid : $(this).data('id')
            },
            beforeSend(){
                $('#locationList').html('<tr><td colspan="6"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                alert(response.msg);
                if(response.status == 200){
                    reload();
                }
            }
        });
      });


      

      function reload(){
        $.ajax({
            url: `${baseUrl}Location_ctrl/getLocations`,
            method: "GET",
            dataType: "json",
            beforeSend(){
                $('#locationList').html('<tr><td colspan="6"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                if(response.status == 200){
                    var x = '';
                    $.each(response.data,function(key,value){
                        x = x + '<tr>'+
                                    '<td class="text-center">'+ parseInt(key+1) +'</td>'+
                                    '<td class="text-center">'+ value.name +'</td>'+
                                    '<td class="text-center">'+ value.cost_center+ ' / '+ value.company_name +'</td>'+
                                    '<td class="text-center">'+ value.created_at +'</td>'+
                                    '<td class="text-center">'+ value.fname +' '+ value.lname +'</td>'+
                                    '<td class="text-center">'+
                                        '<a href="javascript:void(0);" class="location_edit" data-id="'+ value.loc_id +'"><i class="la la-pencil"></i></a>'+
                                        '<a href="javascript:void(0);" class="location_delete" data-id="'+ value.loc_id +'"><i class="la la-trash"></i></a>'+
                                    '</td>'+
                                '</tr>';

                        $('#locationList').html(x);
                    })
                }
            }
        });
      }


    </script>