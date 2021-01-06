<div class="layout-content">
  <div class="layout-content-body">
    <div class="title-bar">
      <h1 class="title-bar-title"> <span class="d-ib">Distrcits Hospitals</span>
        <button class="btn btn-outline-info align-right" style="float:right;" type="button" data-toggle="modal" data-target="#addnewdatamodal">Add New</button>
      </h1>
    </div>
    <form data-toggle="validator" method="POST" action="<?php echo base_url();?>DistrictHospital/index" novalidate="novalidate"> 
          <div class="row gutter-xs">
              <div class="col-xs-12">
                <div class="card">
                   
                   <div class="card-body">
                   <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_name" class="control-label">Name</label>
                        <input maxlength="2500" class="form-control" type="text" value="" name="dh_name" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_phone" class="control-label">Phone</label>
                        <input maxlength="2500" class="form-control" type="text" value="" name="dh_phone" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_focal_person" class="control-label">Officer</label>
                        <input maxlength="2500" class="form-control" type="text" value="" name="dh_focal_person" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> 
                    <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="" class="control-label">Province</label>
                        <select class="form-control" name="province_id">
                          <option value="">Select Province</option>
                          <option value="1">Balochistan</option>
                          <option value="2">KPK</option>
                          <option value="3">Punjab</option>
                          <option value="4">Sind</option>
                        </select>
                       </div>
                    </div> -->

                    <div class="pull-right col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button type="submit" name="search" class="btn btn-primary btn-block" value="search">Search</button>
                      </div>
                    </div>
                 </div> 
              </div>
            </div>
          </div>
        </div></form>
    <div class="row gutter-xs">
      <div class="col-xs-12">
        <div class=" bg-info" style="<?php echo $divHeeadStyle;?>">
        <button type="button" class="close" data-dismiss="modal"> </button>
        <h4 class="modal-title">District tHospitals </h4>
       </div>
        <div class="card">
          <div class="card-body">
            <table style="background:white" id="district-table" class="table table-hover table-striped dataTable dt-rowReorder" cellspacing="0" width="2500%">
              <thead>
                <tr>
                  <th>Seq.</th>
                  <th>Name</th> 
                  <th>Focal Person</th> 
                  <th>Phone</th> 
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($district_hospitals){ $count = 1;?>
                <?php foreach($district_hospitals as $rows):?>
                <tr>
                  <td><?php echo $count++;?></td>
                  <td><?php echo $rows->dh_name;?></td> 
                  <td><?php echo $rows->dh_focal_person;?></td> 
                  <td><?php echo $rows->dh_phone;?></td> 
                  <td>
                      <span class="icon icon-edit" onclick="selectData(this,<?php echo $rows->dh_id;?>)"   data-toggle="modal" data-target="#editdatamodal"></span>
                      <span class="icon icon-trash" onclick="Mydelfunction(this,<?php echo $rows->dh_id;?>,'district_hospitals','dh_id')" data-toggle="modal" data-target="#dangerModalAlert"></span>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php }?>
              </tbody>
            </table>
            <?php if (isset($links)) { ?>
            <?php echo $links ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
 var el='';
 var x='';
  function selectData(element,id){
     el = element;
     x = el.parentElement.parentElement;
     $.ajax({
      type :'GET',
      url  :'<?php echo base_url();?>DistrictHospital/dist_edit/'+id,
      contentType: "application/json",
      dataType: "json",
        success: function(data){
          document.getElementById('dh_id').value  = data.dh_id;
          document.getElementById('dh_name').value  = data.dh_name; 
          document.getElementById('dh_phone').value  = data.dh_phone; 
          document.getElementById('dh_focal_person').value  = data.dh_focal_person; 
          document.getElementById('dh_name').value  = data.dh_name; 
          document.getElementById('dh_latitude').value  = data.dh_latitude; 
          document.getElementById('dh_longitude').value  = data.dh_longitude; 
        }
     });
  }
 
</script>
<!-- Modal add category -->

<div id="addnewdatamodal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Add New District Hospital</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="post" novalidate="novalidate" action="<?php echo base_url();?>DistrictHospital/dist_insert">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">   
                    
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_name" class="control-label">Hospital Name</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_focal_person" class="control-label">Focal Person</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_focal_person" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div><div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_phone" class="control-label">Phone</label>
                        <input maxlength="250" class="form-control" type="number" name="dh_phone" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_latitude" class="control-label">Latitude</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_latitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_longitude" class="control-label">Logitude</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_longitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="lzc_chairman" class="control-label">Select District</label>
                        <select class="form-control" name="dist_id">
                          <option value="">--select--</option>
                          <?php foreach($districts as $rows):?>
                            <option value="<?php echo $rows->dist_id;?>"><?php echo $rows->dist_name;?></option>
                          <?php endforeach;?>
                        </select>
                        
                      </div>
                    </div> 
                     
                    <div class="pull-right col-md-12 col-sm-6 col-xs-12">
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
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close<span> </button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="POST" novalidate="novalidate" action="<?php echo base_url();?>DistrictHospital/dist_edit">
          <input type="hidden" id="dh_id" name="dh_id" value="">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">   
                    
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_name" class="control-label">Hospital Name</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_name" id="dh_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_focal_person" class="control-label">Focal Person</label>
                        <input maxlength="250" class="form-control" type="text" id="dh_focal_person" name="dh_focal_person" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div><div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_phone" class="control-label">Phone</label>
                        <input maxlength="250" class="form-control" type="number" name="dh_phone" id="dh_phone" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_latitude" class="control-label">Latitude</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_latitude" id="dh_latitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dh_longitude" class="control-label">Logitude</label>
                        <input maxlength="250" class="form-control" type="text" name="dh_longitude" id="dh_longitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="lzc_chairman" class="control-label">Select District</label>
                        <select class="form-control" name="dist_id">
                          <option value="">--select--</option>
                          <?php foreach($districts as $rows):?>
                            <option value="<?php echo $rows->dist_id;?>"><?php echo $rows->dist_name;?></option>
                          <?php endforeach;?>
                        </select>
                        
                      </div>
                    </div> 
                     
                    <div class="pull-right col-md-12 col-sm-6 col-xs-12">
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

<!-- Modal edit category-->
<!-- Toster notification-->
<?php  
  if ($this->session->flashdata("success")) {?>
  <script type="text/javascript">
    $(function(){ toastr.success('Data Upload successfully!', 'success'); });
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
    $(function(){ toastr.danger('Error!', 'danger'); });
  </script>
<?php }?>