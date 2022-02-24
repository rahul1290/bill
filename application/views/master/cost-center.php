<main class="workspace">
    <section class="breadcrumb">
        <h1>Cost-Center</h1>
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Cost-center</li>
        </ul>

        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>Costcenter_ctrl">
                    
                    <div class="mb-5">
                        <label class="label block mb-2" for="alternet_no">Company<label class="text-red-500">*</label></label>
                        <select id="company" name="company" class="form-control">
                        <option value="" selected>Select company</option>
                            <?php foreach($companies as $company){ ?>
                                <option value="<?php echo $company['cid']; ?>"><?php echo $company['name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('company'); ?>
                    </div>

                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="title">Costcenter Name<label class="text-red-500">*</label></label>
                        <input id="cid" name="cid" type="hidden" class="form-control" value="<?php echo set_value('cid'); ?>">
                        <input id="cname" name="cname" type="text" class="form-control" value="<?php echo set_value('cname'); ?>">
                        <?php echo form_error('cname'); ?>
                    </div>
                        
                        <div class="mt-12 text-center">
                          <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="costcenter-create" value="Create">
                          <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="costcenter-update" style="display:none;">Update</button>

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
                                    <th class="text-center uppercase">Cost-center Name</th>
                                    <th class="text-center uppercase">Company Name</th>
                                    <th class="text-center uppercase">Created At</th>
                                    <th class="text-center uppercase">Created By</th>
                                    <th class="text-center uppercase">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="costcenterList">
                                <?php if(isset($costceners)){ $c=1; foreach($costceners as $costcener){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $costcener['name']; ?></td>
                                        <td class="text-center"><?= $costcener['company_name']; ?></td>
                                        <td class="text-center"><?= $costcener['created_at']; ?></td>
                                        <td class="text-center"><?= $costcener['fname'].' '.$costcener['lname']; ?></td>
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
