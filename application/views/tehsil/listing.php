<div class="layout-content">
  <div class="layout-content-body">
    <div class="title-bar">
      <h1 class="title-bar-title"> <span class="d-ib">Tehsil</span>
        <button class="btn btn-outline-info align-right" style="float:right;" type="button" data-toggle="modal" data-target="#addnewdatamodal">Add New</button>
      </h1>
    </div>
    <form data-toggle="validator" method="POST" action="<?php echo base_url();?>Tehsil/index" novalidate="novalidate"> 
          <div class="row gutter-xs">
              <div class="col-xs-12">
                <div class="card">
                   
                   <div class="card-body">
                   <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="tehsil_name" class="control-label">Name</label>
                        <input maxlength="100" onkeydown="return alphaOnly(event);" class="form-control" type="text" value="" name="tehsil_name" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                      </div>
                    </div> 
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="" class="control-label">District</label>
                        <select class="form-control" name="dist_id">
                          <option value="">Select District</option>
                          <?php foreach($districts as $dist){?>
                            <option value="<?php echo $dist->dist_id;?>"><?php echo $dist->dist_name;?></option>
                          <?php }?>
                        </select>
                           
                       </div>
                    </div>

                    <div class="pull-right col-md-4 col-sm-4 col-xs-12">
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
        <h4 class="modal-title">tehsil Listing</h4>
       </div>
        <div class="card">
          <div class="card-body">
            <table style="background:white" id="district-table" class="table table-hover table-striped dataTable dt-rowReorder" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Seq.</th>
                  <th>Tehsil</th>
                  <th>District</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($tehsil){ $count = 1;?>
                <?php foreach($tehsil as $rows):?>
                <tr>
                  <td><?php echo $count++;?></td>
                  <td><?php echo $rows->tehsil_name;?></td>
                  <td><?php echo $rows->dist_name;?></td>
                  <td>
                      <span class="icon icon-edit" onclick="selectData(this,<?php echo $rows->tehsil_id;?>)"   data-toggle="modal" data-target="#editdatamodal"></span>
                      <span class="icon icon-trash" onclick="Mydelfunction(this,<?php echo $rows->tehsil_id;?>,'tehsil','tehsil_id')" data-toggle="modal" data-target="#dangerModalAlert"></span>
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
      url  :'<?php echo base_url();?>Tehsil/teh_edit/'+id,
      contentType: "application/json",
      dataType: "json",
        success: function(data){
          document.getElementById('tehsil_id').value  = data.tehsil_id;
          document.getElementById('tehsil_name').value  = data.tehsil_name;
          document.getElementById('select').innerHTML  = data.select;
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
        <h4 class="modal-title">Add New Tehsil</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="post" novalidate="novalidate" action="<?php echo base_url();?>Tehsil/teh_insert">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="tehsil_name" class="control-label">Name</label>
                        <input maxlength="100"  onkeydown="return alphaOnly(event);" class="form-control" type="text" name="tehsil_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="" class="control-label">District</label>
                        <select class="form-control" name="dist_id">
                          <option value="">Select District</option>
                          <?php foreach($districts as $dist){?>
                            <option value="<?php echo $dist->dist_id;?>"><?php echo $dist->dist_name;?></option>
                          <?php }?>
                        </select>
                           
                       </div>
                    </div>
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
        <h4 class="modal-title">Edit Tehsil</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" method="POST" novalidate="novalidate" action="<?php echo base_url();?>Tehsil/teh_edit">
          <input type="hidden" id="tehsil_id" name="tehsil_id" value="">
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="tehsil_name" class="control-label">Name</label>
                        <input maxlength="100"  onkeydown="return alphaOnly(event);" id="tehsil_name" class="form-control" type="text" name="tehsil_name" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span> </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="" class="control-label">District</label>
                        <select class="form-control" id="select" name="dist_id">
                           
                        </select>
                       </div>
                    </div>
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button  class="btn btn-info btn-block"  type="submit">&nbsp;Update&nbsp;</button>
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