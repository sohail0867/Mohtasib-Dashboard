<div>
<div class="layout-content">
  <div class="layout-content-body">
     <div class="row gutter-xs">
         <div class="container">		
		<div class="card">		
		<div class=" bg-info" style="<?php echo $divHeeadStyle;?>">
	        <button type="button" class="close" data-dismiss="modal"> </button>
	        <h4 class="modal-title">Admin User</h4>
        </div>
		<div class="card-body">
			<?php foreach($profile as $row){?>
			<div class="row">
			<div class="col-md-4 " id="leftPanel" >
					<div class="row">
					
						<div class="col-md-12">
					
						<h2 style="text-align: center;">
						<img src="<?php echo base_url()?>assets/profile.png" alt="Texto Alternativo" class="img-circle img-thumbnail"><br/>
						<?php echo $row->ad_uname;?></h2>
						<br>
						
						</div>

					</div>
			</div>
			<div class="col-md-8 " id="rightPanel" style="padding-bottom: 10px;">
			<div class="row">

			<div class="col-md-12">
			<form data-toggle="validator" novalidate="novalidate" method="post" action="<?php echo base_url();?>Main/profile">
			<h2>Edit your profile.<small></small></h2>
			<hr class="colorgraph">					
			<div class="form-group">					
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<input type="email" name="ad_email" id="ad_email" class="form-control input-lg" placeholder="Email Address" tabindex="1" value="<?php echo $row->ad_email;?>">
					</div>
				 
					<div class="col-xs-12 col-sm-6 col-md-6">
						<input type="text" name="ad_uname" id="ad_uname" value="<?php echo $row->ad_uname;?>" class="form-control input-lg" placeholder="Username Name" tabindex="2">
					</div>					
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="ad_password" id="ad_password" class="form-control input-lg" placeholder="Password" tabindex="3">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="cf_ad_password" id="cf_ad_password" class="form-control input-lg" placeholder="Confirm Password" tabindex="3">
						</div>
				    </div>
				</div>
			</div>
			<div class="row">				 
				<div class="col-xs-12 col-md-6  pull-right">
					<button type="submit" name="save" class="btn btn-success btn-block btn-lg">Save</button>
				</div>
			</div>
			<hr class="colorgraph"> <br><br><br>
			</form>
			</div>
			</div>			 
			</div>
			</div><?php } ?>
		</div>
		</div>



	   </div>       
	  </div>
	</div>
  </div>
</div>


<?php  
  if ($this->session->flashdata("success")) {?>
  <script type="text/javascript">
    $(function(){ toastr.success('Data Update successfully!', 'success'); });
  </script>
<?php }?>

<?php  
  if ($this->session->flashdata("error")) {?>
  <script type="text/javascript">
    $(function(){ toastr.error('Confirm password not matched', 'Error!'); });
  </script>
<?php }?>