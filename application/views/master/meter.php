<main class="workspace">
    <section class="breadcrumb">
        <h1>Company</h1>
        <ul>
            <li><a href="#">Master</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Company</li>
        </ul>

        <div class="lg:flex lg:-mx-4 mt-4">
            <div class="lg:w-1/2 xl:w-1/4 lg:px-4">
                <div class="card p-5">
                    <form method="POST" action="<?php echo base_url();?>Company_ctrl">
                        <div class="mb-5 xl:w-2/2">
                            <label class="label block mb-2" for="title">Company Name<label class="text-red-500">*</label></label>
                            <input id="cid" name="cid" type="hidden" class="form-control" value="<?php echo set_value('cid'); ?>">
                            <input id="cname" name="cname" type="text" class="form-control" value="<?php echo set_value('cname'); ?>">
                            <?php echo form_error('cname'); ?>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="address">Address<label class="text-red-500">*</label></label>
                            <textarea id="address" class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea>
                            <?php echo form_error('address'); ?>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email'); ?>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="contact">Contact<label class="text-red-500">*</label></label>
                            <input id="contact" name="contact" type="number" class="form-control" value="<?php echo set_value('number'); ?>">
                            <?php echo form_error('contact'); ?>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="alternet_no">Alternet No.</label>
                            <input id="alternet_no" name="alternet_no" type="number" class="form-control" value="<?php echo set_value('alternet_no'); ?>">
                            <?php echo form_error('alternet_no'); ?>
                        </div>

                        <div class="mt-12 text-center">
                          <input type="submit" class="btn btn_success mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="company-create" value="Create">
                          <button class="btn btn_secondary mt-5 ltr:mr-2 rtl:ml-2 uppercase" id="company-update" style="display:none;">Update</button>

                          <input type="reset" class="btn btn_outlined btn_secondary mt-5 uppercase" id="cancel-btn" style="display:none;" value="Cancel">
                          <input type="reset" class="btn btn_outlined btn_secondary mt-5 uppercase" id="reset-btn" value="Reset">
                        </div>

                    </form>
                </div>
            </div>

            <!-- Recent -->
            <div class="lg:w-1/2">
                <div class="relative card p-0">
                    <div class="">
                      <div class="card p-5">
                          <h3>Company List</h3>
                          <table class="table w-full mt-3">
                              <thead>
                                  <tr>
                                    <th class="text-center uppercase">S.No.</th>
                                    <th class="text-center uppercase">Name</th>
                                    <th class="text-center uppercase">Contact No</th>
                                    <th class="text-center uppercase">Alternet No</th>
                                    <th class="text-center uppercase">Email</th>
                                    <th class="text-center uppercase">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="companyList">
                                <?php $c=1; foreach($companies as $company){ ?>
                                    <tr>
                                        <td class="text-center"><?= $c++; ?></td>
                                        <td class="text-center"><?= $company['name']; ?></td>
                                        <td class="text-center"><?= $company['contact_no']; ?></td>
                                        <td class="text-center"><?= $company['alternet_no']; ?></td>
                                        <td class="text-center"><?= $company['email']; ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="company_edit" data-id="<?= $company['cid']; ?>"><i class="la la-pencil"></i></a>
                                            <a href="javascript:void(0);" class="company_delete" data-id="<?= $company['cid']; ?>"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
