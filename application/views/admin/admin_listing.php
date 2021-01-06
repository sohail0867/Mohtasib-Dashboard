 
<div class="layout-content">
  <div class="layout-content-body">
    <div class="title-bar">
      <h1 class="title-bar-title"> <span class="d-ib"></span>
        Admins Users List
        <button class="btn btn-outline-info align-right" style="float:right;" type="button" data-toggle="modal" data-target="#addnewdatamodal">Add New</button>
      </h1>
    </div>
    <div class="row gutter-xs">
      <div class="col-xs-12">
        <div class=" bg-info" style="<?php echo $divHeeadStyle;?>">
          <button type="button" class="close" data-dismiss="modal"> </button>
          <h4 class="modal-title">Admins</h4>
        </div>
        <div class="card">
          <div class="card-body">
            <table style="background:white;" id="demo-datatables-rowreorder-1" class="table table-hover table-striped dataTable dt-rowReorder" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Seq.</th> 
                  <th>Username</th> 
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($admins){ $count = 1;?>
                <?php foreach($admins as $rows):?>
                <tr>
                  <td><?php echo $count++;?></td>
                  <td><?php echo $rows->ad_uname;?></td> 
                  <td><?php echo $rows->ad_email;?></td> 
                  <td><?php echo $rows->ad_contact;?></td> 
                  <td>
                      <span class="icon icon-edit"  data-toggle="modal" onclick="selectData(<?php echo $rows->ad_id;?>)"  data-target="#editdatamodal"></span>
                      <span onclick="Mydelfunction(this,<?php echo $rows->ad_id;?>,'admin_user','ad_id')" class="icon icon-trash" data-toggle="modal" data-target="#dangerModalAlert"></span>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  // document.getElementById('e_ad_uname').value  = '';
  function selectData(id){
     $.ajax({
      type :'GET',
      url  :'<?php echo base_url();?>Admin/admin_edit/'+id,
      contentType: "application/json",
      dataType: "json",
        success: function(data){ 
          document.getElementById('e_ad_id').value  = data.ad_id;
          document.getElementById('e_ad_uname').value  = data.ad_uname;
          document.getElementById('e_ad_email').value  = data.ad_email;
          document.getElementById('e_ad_contact').value  = data.ad_contact;
        }
     });
  }
</script>
 
<div id="addnewdatamodal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Add New Admin Account</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="post"   action="<?php echo base_url();?>Admin/admin_insert">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">                  
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="ad_uname" class="control-label">Username</label>
                        <input maxlength="50"  autocomplete="nope" id="ad_uname" class="form-control" type="text" name="ad_uname" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="ad_password" class="control-label">Password</label>
                        <input maxlength="50" autocomplete="new-password" id="ad_password" class="form-control" type="password" name="ad_password" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="ad_email" class="control-label">Email</label>
                        <input maxlength="50" autocomplete="new-password" id="ad_email" class="form-control" type="email" name="ad_email" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="ad_contact" class="control-label">Contact</label>
                        <input maxlength="50" autocomplete="new-password" id="ad_contact" class="form-control" type="text" name="ad_contact" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="pull-right col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button type="submit" name="savedata" class="btn btn-primary btn-block" value="savedata">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal add category-->

<!-- Modal edit category -->

<div id="editdatamodal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Edit Admin</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="get" novalidate="novalidate" action="<?php echo base_url();?>Admin/admin_edit">
          <input type="hidden" id="e_ad_id" name="e_ad_id" value=""> 
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="e_ad_uname" class="control-label">Username</label>
                        <input autocomplete="off" maxlength="50" id="e_ad_uname" class="form-control" type="text" name="e_ad_uname" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="e_adm_password" class="control-label">Password</label>
                        <input autocomplete="new-password" maxlength="50" id="e_adm_password" class="form-control" type="password" name="e_adm_password">
                        
                       </div>
                    </div>


                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="e_ad_email" class="control-label">Email</label>
                        <input id="e_ad_email" class="form-control" type="email" name="e_ad_email"> 
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="e_ad_contact" class="control-label">Contact</label>
                        <input id="e_ad_contact" class="form-control" type="text" name="e_ad_contact"> 
                       </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button   class="btn btn-info btn-block" name="edit_admin" type="submit">&nbsp;Update&nbsp;</button>
                      </div>
                    </div> 
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button class="btn btn-warning btn-block" data-dismiss="modal" type="button">Cancel</button>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
<!-- Modal edit category-->

<!-- Toster notification-->
<?php  
  if ($this->session->flashdata("success")) {?>
  <script type="text/javascript">
    $(function(){ toastr.success('Data Updated successfully!', 'success'); });
  </script>
<?php }?>

<?php  
  if ($this->session->flashdata("duplicate")) {?>
  <script type="text/javascript">
    $(function(){ toastr.warning('<?php echo $this->session->flashdata("duplicate");?>', 'warning'); });
  </script>
<?php }?>

<?php  
  if ($this->session->flashdata("error")) {?>
  <script type="text/javascript">
    $(function(){ toastr.success('Error!', 'danger'); });
  </script>
<?php }?>