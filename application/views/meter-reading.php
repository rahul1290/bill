    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          		<span class="text-warning" id="page-heading">Meter Reading</span>
              <span class="pull-right" style="float: right;">
                <a class="btn btn-sm btn-primary" href="<?php echo base_url('Show-Meter-Reading'); ?>">Pending Readings</a>
              </span>
          		<hr/>
              <div class="row">
                <div class="col-5">
                <?php echo $this->session->flashdata('msg'); ?>
                <form name="f1" method="POST" enctype='multipart/form-data' action="<?php echo base_url();?>Meter-Reading">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Company</label>
                        <div class="col-sm-10">
                          <select id="company" name="company" class="form-control">
                            <option value="">Select Company</option>
                            <?php foreach($companies as $company){ ?>
                              <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                            <?php } ?>
                          </select>
                        <?php echo form_error('company'); ?>
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Service No.</label>
                        <div class="col-sm-10">
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
                          <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Cost-Center</label>
                          <div class="col-sm-10">
                            <select id="costcenter" name="costcenter" class="form-control">
                              <option value="">Select Cost-Center</option>
                            </select>
                          <?php echo form_error('costcenter'); ?>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Location</label>
                          <div class="col-sm-10">
                            <select id="location" name="location" class="form-control">
                              <option value="">Select Location</option>
                            </select>
                          <?php echo form_error('location'); ?>
                          </div>
                      </div>
                      
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Date Of Reading</label>
                          <div class="col-sm-10">
                            <input type="text" name="reading_date" id="reading_date" class="form-control" placeholder="dd/mm/yyyy"/>
                          <?php echo form_error('reading_date'); ?>
                          </div>
                      </div>
                      
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Reading Value</label>
                          <div class="col-sm-10">
                            <input type="text" name="reading_value" id="reading_value" class="form-control" />
                          <?php echo form_error('reading_value'); ?>
                          </div>
                      </div>
                      
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label text-xs">Upload Photo</label>
                          <div class="col-sm-10">
                            <input type="file" name="userfile" id="photo" class="form-control" />
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

                <div class="col-7">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Cost Center</th>
                        <th>Location</th>
                        <th>Service No.</th>
                        <th>Submeter No.</th>
                        <th>Last Reading Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $c=1; foreach($readings as $reading){ ?>
                          <tr>
                            <td><?php echo $c++; ?></td>
                            <td><?php echo $reading['cost_center']; ?></td>
                            <td><?php echo $reading['location_name']; ?></td>
                            <td><?php echo $reading['bpno']; ?></td>
                            <td><?php echo $reading['bpno']; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
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

    $( function() {
      $("#reading_date").datepicker({ 
        dateFormat: 'dd/mm/yy' 
      });
    });
    
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
