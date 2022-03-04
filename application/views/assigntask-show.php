    <section class="content mt-2">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">

          	<div class="">
          		<span class="text-primary" id="page-heading">Assigned Users</span>
          		
              <table class="table table-bordered">
                <thead class="bg-light">
                  <tr>
                    <th>Id</th>
                    <th>Main Meter</th>
                    <th>Sub Meter</th>
                    <th>Location</th>
                    <th>Task</th>
                    <th>Assign User</th>
                    <th>Frequency of Upload</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $c=1; foreach($records as $record){ ?>
                      <tr>
                        <!-- S.No. -->
                        <td style="vertical-align: middle;"><?php echo $c++; ?></td>
                        <?php $ic=0; foreach($records as $r) { 
                          if($r['parent_meter'] == $record['mid']){
                            $ic++;
                          }
                        } ?> 
                        <!-- Service No. -->
                        <td class="text-center" style="vertical-align: middle;height:<?php echo $ic * 30; ?>px;"><?php echo $record['bpno']; ?></td>
                        <!-- Sub Meter -->
                        <td style="height:<?php echo $ic * 30; ?>px;" class="text-center m-0 p-0">
                          <table width="100%" style="height:100%;">
                            <?php foreach($records as $r) { 
                              if($r['parent_meter'] == $record['mid']){
                                echo "<tr><td style='vertical-align: middle;height:".($ic*30)/$ic."px;'>".$r['bpno']."</td></tr>";
                              }
                            } ?> 
                          </table>
                        </td>
                        <!-- Location -->
                        <td style="height:30px;" class="text-center m-0 p-0">
                          <table width="100%" style="height:100%;">
                            <?php foreach($records as $r) { 
                              if($r['parent_meter'] == $record['mid']){
                                echo "<tr><td style='vertical-align: middle;'>".$r['location']."</td></tr>";
                              }
                            } ?> 
                          </table>
                        </td>
                        <!-- Task -->
                        <td class="text-center m-0 p-0">
                            <?php if($ic > 0) { foreach($records as $r) { 
                              if($r['parent_meter'] == $record['mid']){
                                echo "<table width='100%' style='height:100%'>
                                  <tr>
                                    <td style='height:15px;'>Meter Reading</td>
                                  </tr>
                                  <tr>
                                    <td style='height:15px;'>Bill Upload</td>
                                  </tr>
                                </table>";
                              }
                            } } else { ?>
                                <table width='100%' style='height:100%'>
                                  <tr>
                                    <td style='height:15px;'>Meter Reading</td>
                                  </tr>
                                  <tr>
                                    <td style='height:15px;'>Bill Upload</td>
                                  </tr>
                                </table>
                            <?php } ?> 
                        </td>
                        <!-- Assign user -->
                        <td class="text-center m-0 p-0">
                            <?php foreach($records as $r) { 
                              if($r['parent_meter'] == $record['mid']){
                                echo "<table width='100%' style='height:100%'>
                                  <tr>
                                    <td style='height:15px;' class='m-0 p-0'>
                                      <select style='width:100%;' class='form-control'>
                                        <option value=''>Select User</option>";
                                        foreach($users as $user){
                                          if($user['uid'] == $r['user_id']){
                                            echo "<option value='".$user['uid']."' selected>".$user['fname']."</option>";
                                          } else {
                                            echo "<option value='".$user['uid']."'>".$user['fname']."</option>";
                                          }
                                        }
                                      echo "</select>
                                    </td>
                                  </tr>
                                  <tr>
                                  <td style='height:15px;' class='m-0 p-0'>
                                    <select style='width:100%;' class='form-control'>
                                      <option value=''>Select User</option>";
                                      foreach($users as $user){
                                        if($user['uid'] == $r['user_id']){
                                          echo "<option value='".$user['uid']."' selected>".$user['fname']."</option>";
                                        } else {
                                          echo "<option value='".$user['uid']."'>".$user['fname']."</option>";
                                        }
                                      }
                                    echo "</select>
                                  </td>
                                  </tr>
                                </table>";
                              }
                            } ?> 
                        </td>
                        <!-- Frequency -->
                        <td class="text-center m-0 p-0">
                            <?php foreach($records as $r) { 
                              if($r['parent_meter'] == $record['mid']){
                                echo "<table width='100%' style='height:100%'>
                                  <tr>
                                    <td class='m-0 p-0'>
                                      <input type='number' class='form-control'/>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class='m-0 p-0'>
                                      <input type='number' class='form-control'/>
                                    </td>
                                  </tr>
                                </table>";
                              }
                            } ?> 
                        </td>

                      </tr>
                  <?php } ?>
                </tbody>
              </table>

          	</div>

          
        </div>
        <!-- /.card-body -->
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
