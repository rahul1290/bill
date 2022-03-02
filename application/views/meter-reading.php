    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          	<div class="offset-sm-1 col-10">
          		<span class="text-warning" id="page-heading">Meter Reading</span>
              <span class="pull-right" style="float: right;">
                <a class="btn btn-sm btn-primary" href="<?php echo base_url('Show-Meter-Reading'); ?>">Show-previous-Readings</a>
              </span>
          		<hr/>
          		<form name="f1" method="POST" action="<?php echo base_url();?>Meter-Reading">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Service No.</label>
                        <div class="col-sm-4">
                          <select id="serviceno" name="serviceno" class="form-control">
                          	<option value="">Select Service No</option>
                          	<?php foreach($service_no as $sno){ ?>
                          		<option value="<?php echo $sno['mid']; ?>"><?php echo $sno['bpno']; ?></option>
                          	<?php }?>
                          </select>
                        <?php echo form_error('serviceno'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Company</label>
                        <div class="col-sm-4">
                          <select id="company" name="company" class="form-control">
                          	<option value="">Select Company</option>
                          </select>
                        <?php echo form_error('company'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Cost-Center</label>
                        <div class="col-sm-4">
                          <select id="costcenter" name="costcenter" class="form-control">
                          	<option value="">Select Cost-Center</option>
                          </select>
                        <?php echo form_error('costcenter'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Location</label>
                        <div class="col-sm-4">
                          <select id="location" name="location" class="form-control">
                          	<option value="">Select Location</option>
                          </select>
                        <?php echo form_error('location'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Date Of Reading</label>
                        <div class="col-sm-4">
                          <input type="date" name="reading_date" id="reading_date" class="form-control" />
                        <?php echo form_error('reading_date'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Reading Value</label>
                        <div class="col-sm-4">
                          <input type="text" name="reading_value" id="reading_value" class="form-control" />
                        <?php echo form_error('reading_value'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Upload Photo</label>
                        <div class="col-sm-4">
                          <input type="file" name="photo" id="photo" class="form-control" />
                        <?php echo form_error('photo'); ?>
                        </div>
                    </div>
                    
                   	<div class="offset-1 mt-3">
                      <input type="submit" class="btn btn-outline-success uppercase" id="assign-create" value="Submit">
                      <button class="btn btn-outline-warning uppercase" id="assign-update" style="display:none;">Update</button>
    	
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                      <input type="reset" class="btn btn-outline-secondary uppercase" id="reset-btn" value="Reset">
                    </div>
                </form>
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
