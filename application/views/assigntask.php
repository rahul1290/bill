<main class="workspace">
    <section class="breadcrumb">
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>User Assign</li>
        </ul>

        
        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>Assigntask_ctrl">
                    <input type="hidden" name="utid" id="utid"/>

                    <div class="mb-5">
                        <label class="label block mb-2" for="company">Company</label>
                        <div class="custom-select">
                            <select id="company" name="company" class="form-control">
                            <option value="" selected>Select company</option>
                                <?php foreach($companies as $company){ ?>
                                    <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                        <?php echo form_error('company'); ?>
                    </div>


                    

                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row">
                            <div class="mb-5 xl:w-2/2">
                                <label class="label block mb-2" for="title">Costcenter</label>
                                <select id="costc_id" name="costc_id" class="form-control">
                                    <option value="">Select cost-center</option>
                                </select>
                                <?php echo form_error('costc_id'); ?>
                            </div>

                            <div class="mb-5 xl:w-2/2">
                                <label class="label block mb-2" for="title">Location</label>
                                <select id="loc_id" name="loc_id" class="form-control">
                                    <option value="">Select Location</option>
                                </select>
                                <?php echo form_error('loc_id'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row">
                            <div class="mb-5">
                                <label class="label block mb-2" for="alternet_no">Service No.</label>
                                <select id="meter" name="meter" class="form-control">
                                    <option value="" selected>Select meter</option>
                                </select>
                                <?php echo form_error('meter'); ?>
                            </div>

                            <div class="mb-5">
                                <label class="label block mb-2" for="alternet_no">Submeter No.</label>
                                <select id="sub-meter" name="sub-meter" class="form-control">
                                    <option value="" selected>Select sub-meter</option>
                                </select>
                                <?php echo form_error('sub-meter'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="label block mb-2" for="company">Employee</label>
                        <select id="user" name="user" class="form-control">
                        <option value="" selected>Select Employee</option>
                            <?php foreach($users as $user){ ?>
                                <option value="<?php echo $user['uid']; ?>"><?php echo $user['fname'].' '.$user['lname'].' {['. $user["role"] .']}'; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('user'); ?>
                    </div>

                    <div class="mb-5 p-2" style="border:solid 0.5px black;border-radius:6px;padding:4px;">
                        <label class="label block mb-2" for="company">Task</label>
                        <div class="mb-2">
                            <input type="checkbox" name="meter_reading"> Meter Reading
                            <input name="reading_frq" type="number" value="1" class="w-1/3" style="border:solid 0.5px black;border-radius:6px;"> in Days
                        </div>
                        <hr/>
                        <div>
                            <input type="checkbox" name="bill_upload"> Bill Upload
                            <input name="upload_frq" type="number" value="1" class="w-1/3" style="border:solid 0.5px black;border-radius:6px;"> in Month
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="assign-create" value="Assign">
                        <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="assign-update" style="display:none;">Update</button>

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
                          <h3>User Assign</h3>
                          <table class="table w-full mt-3">
                              <thead>
                                  <tr>
                                    <th class="text-center uppercase">S.No.</th>
                                    <th class="text-center uppercase">Service No.</th>
                                    <th class="text-center uppercase">Sub-Meter No.</th>
                                    <th class="text-center uppercase">Location</th>
                                    <th class="text-center uppercase">Company</th>
                                    <th class="text-center uppercase">Task</th>
                                    <th class="text-center uppercase">Assign Employee</th>
                                    <th class="text-center uppercase">Frequency</th>
                                  </tr>
                              </thead>
                              <tbody id="costcenterList">
                                <?php if(isset($tasks)){ $c=1; foreach($tasks as $task){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $task['bpno']; ?></td>
                                        <td class="text-center"><?= $task['company_name']; ?></td>
                                        <td class="text-center"><?= $task['created_at']; ?></td>
                                        <td class="text-center"><?= $task['fname'].' '.$costcener['lname']; ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="costcenter_edit" data-id="<?= $costcener['costc_id']; ?>"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="costcenter_delete" data-id="<?= $costcener['costc_id']; ?>"><i class="la la-trash"></i></a>
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
/////////

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

function getLocations(cid){
    $.ajax({
        url: `${baseUrl}Location_ctrl/getLocationByCostcenterId/${cid}`,
        method: "POST",
        dataType: "json",
        data : {
            cid : $(this).data('id')
        },
        success(response){
            var x = '<option value="">Select Location</option>';
            if(response.status == 200){
                $.each(response.data,function(key,value){
                    x = x + '<option value="'+ value.loc_id +'">'+ value.name +'</option>';
                });
                $('#loc_id').html(x);
            }
            $('#loc_id').html(x);
        }
    });
}

function getMeters(lid){
    $.ajax({
        url: `${baseUrl}Meter_ctrl/getMeterByLocationId/${lid}`,
        method: "POST",
        dataType: "json",
        success(response){
            var x = '<option value="">Select Location</option>';
            if(response.status == 200){
                $.each(response.data,function(key,value){
                    x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
                });
                $('#meter').html(x);
            }
            $('#meter').html(x);
        }
    });
}

function getSubMeters(mid){
    $.ajax({
        url: `${baseUrl}Meter_ctrl/getSubMeters/${mid}`,
        method: "POST",
        dataType: "json",
        success(response){
            var x = '<option value="">Select sub meter</option>';
            if(response.status == 200){
                $.each(response.data,function(key,value){
                    x = x + '<option value="'+ value.mid +'">'+ value.bpno +'</option>';
                });
                $('#sub-meter').html(x);
            }
            $('#sub-meter').html(x);
        }
    });
}


      $(document).on('change','#company',function(){
          var cid = $(this).val();
        getCostCenter(cid);
      });

      $(document).on('change','#costc_id',function(){
          var cid = $(this).val();
          getLocations(cid);
      });

      $(document).on('change','#loc_id',function(){
          var lid = $(this).val();
          getMeters(lid);
      });

      $(document).on('change','#meter',function(){
          var mid = $(this).val();
          getSubMeters(mid);
      });

    
      $(document).on('click','.costcenter_edit',function(){
        var request = $.ajax({
                url: `${baseUrl}Costcenter_ctrl/getCostCenterById`,
                method: "POST",
                data: { cid : $(this).data('id') },
                dataType: "json"
                });    
            request.done(function( response ) {
                console.log(response);
                if(response.status == 200){
                    $('#costcenter-update').show();
                    $('#cancel-btn').show();
                    $('#costcenter-create').hide();
                    $('#reset-btn').hide();

                    $('#cid').val(response.data['costc_id']);
                    $('#company').val(response.data['company_id']);
                    $('#cname').val(response.data['name']);
                }
            });
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
      });

      $('#cancel-btn').on('click',function(){
            $('#costcenter-update').hide();
            $('#cancel-btn').hide();
            $('#costcenter-create').show();
            $('#reset-btn').show();
      });


      $(document).on('click','.costcenter_delete',function(){
        $.ajax({
            url: `${baseUrl}Costcenter_ctrl/delete_costcenter`,
            method: "POST",
            dataType: "json",
            data : {
                cid : $(this).data('id')
            },
            beforeSend(){
                $('#costcenterList').html('<tr><td colspan="6"><p class="text-center">Loading..</p></td></tr>');
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
            url: `${baseUrl}Costcenter_ctrl/getCostcenters`,
            method: "GET",
            dataType: "json",
            beforeSend(){
                $('#costcenterList').html('<tr><td colspan="6"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                if(response.status == 200){
                    var x = '';
                    $.each(response.data,function(key,value){
                        x = x + '<tr>'+
                                        '<td class="text-center">'+ parseInt(key+1) +'</td>'+
                                        '<td class="text-center">'+ value.name +'</td>'+
                                        '<td class="text-center">'+ value.company_name + '</td>'+
                                        '<td class="text-center">'+ value.created_at +'</td>'+
                                        '<td class="text-center">'+ value.fname + ' '+ value.lname +'</td>'+
                                        '<td class="text-center">'+
                                            '<a href="javascript:void(0);" class="costcenter_edit" data-id="'+ value.costc_id +'"><i class="la la-pencil"></i></a>'+
                                            '<a href="javascript:void(0);" class="costcenter_delete" data-id="'+ value.costc_id +'"><i class="la la-trash"></i></a>'+
                                        '</td>'+
                                    '</tr>';

                        $('#costcenterList').html(x);
                    })
                }
            }
        });
      }


    </script>
