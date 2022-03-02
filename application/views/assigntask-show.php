    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          	<div class="offset-sm-1 col-10">
          		<span class="text-warning" id="page-heading">Assigned Users</span>
          		
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Main Meter</th>
                    <th>Sub Meter</th>
                    <th>Location</th>
                    <th>Task</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $c=1; foreach($records as $record){ 
                    if($record['mtype'] == 'main-meter'){ ?>
                    <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $record['bpno']; ?></td>
                      
                      <td>
                        <table class="table table-bordered">
                          <?php foreach($records as $rec){ 
                            if($rec['parent_meter'] == $record['mid']){ ?>
                              <tr>
                                <td><?php echo $rec['bpno']; ?></td>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </table>
                      </td>

                    </tr>
                  <?php } $c++; } ?>
                </tbody>
              </table>

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
