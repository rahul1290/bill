<main class="workspace">
    <section class="breadcrumb">
        <h1>Meter</h1>
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Meter</li>
        </ul>

        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>Meter_ctrl">
                    
                    <div class="mb-5">
                        <label class="label block mb-2" for="alternet_no">Company<label class="text-red-500">*</label></label>
                        <select id="cid" name="cid" class="form-control">
                        <option value="" selected>Select company</option>
                            <?php foreach($companies as $company){ ?>
                                <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('cid'); ?>
                    </div>

                    <div class="mb-5">
                        <label class="label block mb-2" for="alternet_no">Cost-center<label class="text-red-500">*</label></label>
                        <select id="costc_id" name="costc_id" class="form-control">
                            <option value="" selected>Select cost-center</option>
                        </select>
                        <?php echo form_error('costc_id'); ?>
                    </div>

                    <div class="mb-5">
                        <label class="label block mb-2" for="alternet_no">Location<label class="text-red-500">*</label></label>
                        <select id="loc_id" name="loc_id" class="form-control">
                            <option value="" selected>Select location</option>
                        </select>
                        <?php echo form_error('loc_id'); ?>
                    </div>
                    
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="title">Meter Type<label class="text-red-500">*</label></label>
                        <select id="mtype" name="mtype" class="form-control">
                            <option value="">Select Meter type</option>
                            <option value="main-meter">Main</option>
                            <option value="sub-meter">Sub meter</option>
                        </select>
                        <?php echo form_error('mtype'); ?>
                    </div>

                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="title">BP No.<label class="text-red-500">*</label></label>
                        <input id="mid" name="mid" type="hidden" class="form-control" value="<?php echo set_value('mid'); ?>">
                        <input id="bpno" name="bpno" type="text" class="form-control" value="<?php echo set_value('bpno'); ?>">
                        <?php echo form_error('bpno'); ?>
                    </div>
                        
                    <div class="mt-12 text-center">
                        <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="meter-create" value="Create">
                        <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="meter-update" style="display:none;">Update</button>

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
                          <h3>Meter List</h3>
                          <table class="table w-full mt-3">
                              <thead>
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
                                            <a href="javascript:void(0);" class="meter_edit" data-id="<?= $meter['mid']; ?>"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="meter_delete" data-id="<?= $meter['mid']; ?>"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } } else {  echo "<tr><td class='text-center' colspan='8'>No record found.</td></tr>"; } ?>
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
                    $('#bpno').val(response.data['bpno']);
                }
            });
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
      });

      $('#cancel-btn').on('click',function(){
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
                $('#meterList').html('<tr><td colspan="8"><p class="text-center">Loading..</p></td></tr>');
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
            url: `${baseUrl}Meter_ctrl/getMeters`,
            method: "GET",
            dataType: "json",
            beforeSend(){
                $('#meterList').html('<tr><td colspan="8"><p class="text-center">Loading..</p></td></tr>');
            },
            success(response){
                if(response.status == 200){
                    var x = '';
                    $.each(response.data,function(key,value){
                        x = x + '<tr>'+
                                        '<td class="text-center"><?= $c++; ?></td>'+
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
