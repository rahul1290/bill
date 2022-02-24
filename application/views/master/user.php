<main class="workspace">
    <section class="breadcrumb">
        <h1>Users</h1>
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Users</li>
        </ul>

        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>User_ctrl">
                    
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="fname">First Name<label class="text-red-500">*</label></label>
                        <input id="uid" name="uid" type="hidden" class="form-control" value="<?php echo set_value('uid'); ?>">
                        <input id="fname" name="fname" type="text" class="form-control" value="<?php echo set_value('fname'); ?>">
                        <?php echo form_error('fname'); ?>
                    </div>
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="lname">Last Name<label class="text-red-500">*</label></label>
                        <input id="lname" name="lname" type="text" class="form-control" value="<?php echo set_value('lname'); ?>">
                        <?php echo form_error('lname'); ?>
                    </div>
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="email">Email<label class="text-red-500">*</label></label>
                        <input id="email" name="email" type="email" class="form-control" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email'); ?>
                    </div>
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="contact">Contact<label class="text-red-500">*</label></label>
                        <input id="contact" name="contact" type="number" class="form-control" value="<?php echo set_value('contact'); ?>">
                        <?php echo form_error('contact'); ?>
                    </div>
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="contact">Sex<label class="text-red-500">*</label></label>
                        <select name="sex" id="sex" class="form-control">
                            <option value="">Select sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <?php echo form_error('sex'); ?>
                    </div>
                    <div class="mb-5 xl:w-2/2">
                        <label class="label block mb-2" for="utype">Role<label class="text-red-500">*</label></label>
                        <select name="utype" id="utype" class="form-control">
                            <option value="">Select user role</option>
                            <?php foreach($user_types as $user_type){ ?>
                            <option value="<?php echo $user_type['utype_id']; ?>"><?php echo $user_type['type_name']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('utype'); ?>
                    </div>

                    <div class="mt-12 text-center">
                        <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="user-create" value="Create">
                        <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="user-update" style="display:none;">Update</button>

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
                          <h3>User List</h3>
                          <table class="table w-full mt-3">
                              <thead>
                                  <tr>
                                    <th class="text-center uppercase">S.No.</th>
                                    <th class="text-center uppercase">Name</th>
                                    <th class="text-center uppercase">Email</th>
                                    <th class="text-center uppercase">Contact No.</th>
                                    <th class="text-center uppercase">Sex</th>
                                    <th class="text-center uppercase">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="userList">
                                <?php if(isset($users)){ $c=1; foreach($users as $user){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $user['fname'] .' '.$user['lname'] ?></td>
                                        <td class="text-center"><?= $user['email'] ?></td>
                                        <td class="text-center"><?= $user['contact_no']; ?></td>
                                        <td class="text-center"><?= $user['sex']; ?></td>
                                        <td class="text-center"><?= $user['role']; ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="user_edit" data-id="<?= $user['uid']; ?>"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="user_delete" data-id="<?= $user['uid']; ?>"><i class="la la-trash"></i></a>
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
    
      $(document).on('click','.user_edit',function(){
        var request = $.ajax({
                url: `${baseUrl}User_ctrl/getUserById`,
                method: "POST",
                data: { uid : $(this).data('id') },
                dataType: "json"
                });    
            request.done(function( response ) {
                console.log(response);
                if(response.status == 200){
                    $('#user-update').show();
                    $('#cancel-btn').show();
                    $('#user-create').hide();
                    $('#reset-btn').hide();

                    $('#uid').val(response.data['uid']);
                    $('#fname').val(response.data['fname']);
                    $('#lname').val(response.data['lname']);
                    $('#email').val(response.data['email']);
                    $('#contact').val(response.data['contact_no']);
                    $('#sex').val(response.data['sex']);
                    $('#utype').val(response.data['utype']);
                }
            });
            request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            });
      });

      $('#cancel-btn').on('click',function(){
            $('#user-update').hide();
            $('#cancel-btn').hide();
            $('#user-create').show();
            $('#reset-btn').show();
      });


      $(document).on('click','.user_delete',function(){
        $.ajax({
            url: `${baseUrl}User_ctrl/delete_user`,
            method: "POST",
            dataType: "json",
            data : {
                uid : $(this).data('id')
            },
            beforeSend(){
                $('#userList').html('<tr><td colspan="6"><p class="text-center">Loading..</p></td></tr>');
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
            url: `${baseUrl}User_ctrl/getUsers`,
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
                                    '<td class="text-center">'+ value.fname +' '+ value.lname +'</td>'+
                                    '<td class="text-center">'+ value.email +'</td>'+
                                    '<td class="text-center">'+ value.contact_no +'</td>'+
                                    '<td class="text-center">'+ value.sex +'</td>'+
                                    '<td class="text-center">'+ value.role +'</td>'+
                                    '<td class="text-center">'+
                                        '<a href="javascript:void(0);" class="user_edit" data-id="'+ value.uid + '"><i class="la la-pencil"></i></a>'+
                                        '<a href="javascript:void(0);" class="user_delete" data-id="'+ value.uid +'"><i class="la la-trash"></i></a>'+
                                    '</td>'+
                                '</tr>';
                        $('#userList').html(x);
                    })
                }
            }
        });
      }
    </script>
