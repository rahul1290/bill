<main class="workspace">
    <section class="breadcrumb">
        <h1>Location</h1>
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Location</li>
        </ul>

        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>Location_ctrl">
                    
                    <div class="mb-5">
                        <label class="label block mb-2" for="alternet_no">Cost-center<label class="text-red-500">*</label></label>
                        <select id="cost_center" name="cost_center" class="form-control">
                        <option value="" selected>Select cost-center</option>
                            <?php foreach($costceners as $costcener){ ?>
                                <option value="<?php echo $costcener['costc_id']; ?>"><?php echo $costcener['name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('cost_center'); ?>
                    </div>

                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="title">Location Name<label class="text-red-500">*</label></label>
                        <input id="lid" name="lid" type="hidden" class="form-control" value="<?php echo set_value('lid'); ?>">
                        <input id="lname" name="lname" type="text" class="form-control" value="<?php echo set_value('lname'); ?>">
                        <?php echo form_error('lname'); ?>
                    </div>
                        
                        <div class="mt-12 text-center">
                          <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="location-create" value="Create">
                          <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="location-update" style="display:none;">Update</button>

                          <input type="reset" class="btn btn_outlined btn_secondary mt-5 uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                          <input type="reset" class="btn btn_outlined btn_secondary mt-5 uppercase" id="reset-btn" value="Reset">
                        </div>

                    </form>
                </div>
            </div>

            <!-- Recent -->
            <div class="lg:w-1/2 xl:w-3/4 lg:px-4 pt-0 lg:pt-0">
                <div class="relative card p-0">
                    <div class="lg:w-2/2">
                      <div class="card p-5">
                          <h3>Cost-Center List</h3>
                          <table class="table w-full mt-3">
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
                                            <a href="javascript:void(0);" class="location_edit" data-id="<?= $location['loc_id']; ?>"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="location_delete" data-id="<?= $location['loc_id']; ?>"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } } else {  echo "<tr><td class='text-center' colspan='6'>No record found.</td></tr>"; } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
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
