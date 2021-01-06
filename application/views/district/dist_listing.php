<div class="layout-content">
  <div class="layout-content-body">
    <div class="title-bar">
      <h1 class="title-bar-title"> <span class="d-ib">Distrcits Offices</span>
        <button class="btn btn-outline-info align-right" style="float:right;" type="button" data-toggle="modal" data-target="#addnewdatamodal">Add New</button>
      </h1>
    </div>
    <form data-toggle="validator" method="POST" action="<?php echo base_url();?>District/index" novalidate="novalidate"> 
          <div class="row gutter-xs">
              <div class="col-xs-12">
                <div class="card">
                   
                   <div class="card-body">
                   <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_name" class="control-label">Name</label>
                        <input maxlength="1050" class="form-control" type="text" value="" name="dist_name" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_phone" class="control-label">Phone</label>
                        <input maxlength="1050" class="form-control" type="text" value="" name="dist_phone" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_officer_name" class="control-label">Officer</label>
                        <input maxlength="1050" class="form-control" type="text" value="" name="dist_officer_name" aria-required="true">
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
        <h4 class="modal-title">Districts Offices Listing</h4>
       </div>
        <div class="card">
          <div class="card-body">
            <table style="background:white" id="district-table" class="table table-hover table-striped dataTable dt-rowReorder" cellspacing="0" width="1050%">
              <thead>
                <tr>
                  <th>Seq.</th>
                  <th>Name</th> 
                  <th>Officer</th> 
                  <th>Phone</th> 
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($districts){ $count = 1;?>
                <?php foreach($districts as $rows):?>
                <tr>
                  <td><?php echo $count++;?></td>
                  <td><?php echo $rows->dist_name;?></td> 
                  <td><?php echo $rows->dist_officer_name;?></td> 
                  <td><?php echo $rows->dist_phone;?></td> 
                  <td>
                      <span class="icon icon-edit" onclick="selectData(this,<?php echo $rows->dist_id;?>)"   data-toggle="modal" data-target="#editdatamodal"></span>
                      <span class="icon icon-trash" onclick="Mydelfunction(this,<?php echo $rows->dist_id;?>,'district_office','dist_id')" data-toggle="modal" data-target="#dangerModalAlert"></span>
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
      url  :'<?php echo base_url();?>District/dist_edit/'+id,
      contentType: "application/json",
      dataType: "json",
        success: function(data){
          document.getElementById('dist_id').value  = data.dist_id;
          document.getElementById('dist_name').value  = data.dist_name; 
          document.getElementById('dist_phone').value  = data.dist_phone; 
          document.getElementById('dist_officer_name').value  = data.dist_officer_name; 
          document.getElementById('dist_no_lzc').value  = data.dist_no_lzc; 
          document.getElementById('dist_latitude').value  = data.dist_latitude; 
          document.getElementById('dist_longitude').value  = data.dist_longitude; 
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
        <h4 class="modal-title">Add New District Office</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="post" novalidate="novalidate" action="<?php echo base_url();?>District/dist_insert">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">     
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_name" class="control-label">Name</label>
                        <input maxlength="150"  class="form-control" type="text" name="dist_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div><div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_officer_name" class="control-label">District Officer</label>
                        <input maxlength="150"  class="form-control" type="text" name="dist_officer_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div> 
                   <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_no_lzc" class="control-label">No Local Zakat Committe (figure)</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_no_lzc" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_phone" class="control-label">Disctrict Office Phone</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_phone" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_latitude" class="control-label">Latitude</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_latitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_longitude" class="control-label">Logitude</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_longitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
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

<!-- Modal add category-->

<!-- Modal edit category -->

<div id="editdatamodal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="POST" novalidate="novalidate" action="<?php echo base_url();?>District/dist_edit">
          <input type="hidden" id="dist_id" name="dist_id" value="">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_name" class="control-label">Name</label>
                        <input maxlength="1050"  class="form-control" type="text" name="dist_name" id="dist_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div><div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_officer_name" class="control-label">District Officer</label>
                        <input maxlength="1050"  class="form-control" type="text" name="dist_officer_name" id="dist_officer_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_no_lzc" class="control-label">No Local Zakat Committe (figure)</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_no_lzc" id="dist_no_lzc" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_phone" class="control-label">Disctrict Office Phone</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_phone" id="dist_phone" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_latitude" class="control-label">Latitude</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_latitude" id="dist_latitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="dist_longitude" class="control-label">Logitude</label>
                        <input maxlength="105" class="form-control" type="number" name="dist_longitude" id="dist_longitude" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> 
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