 <!-- Delete Modal -->
 <script type="text/javascript">
  var ajaxReq = '';
  var id1 = '';
  var table1 = '';
  var col1 = '';
  var el = '';
  var file_name = '';
  function Mydelfunction(element,primary_key,table_name,cond_col,filename){
    id1 = primary_key;
    table1 = table_name;
    col1 = cond_col;
    el = element;
    file_name = filename;
  }
  function deleteRecord(){
    ajaxReq = $.ajax({
    type: "GET",
    beforeSend : function() {
      if(ajaxReq != '') {
       ajaxReq.abort();
      }
    },
    url: "<?php echo base_url()?>Admin/delete",
    data:{'id':id1,'table':table1,'col':col1},
    contentType: "application/json",
    dataType: "json",
    success: function(msg){
      if (file_name !=null) {
       var file_path = "kp_anticorruption/assets/anti_corrup_laws_attachment/"+file_name;
       $.ajax({
        type: "GET",
        url: "<?php echo base_url()?>Main/delete_file",
        data:{'file_path':file_path},
        contentType: "application/json",
        dataType: "json",
        success: function(msg){
         alert('file delete from folder');
        }
       });
      }
      if (msg.success == 1) {
        var x = el.parentElement.parentElement;
        x.remove(); 
        $(function(){ toastr.success('Data Delete successfully!', 'success'); });
        }
      },
    complete: function() {
    return false;
    }
  });
}

 </script>
    <div id="dangerModalAlert" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <span class="text-danger icon icon-trash-o icon-5x"></span>
              <h3 class="text-danger">Delete!</h3>
              <p>Are you sure.</p>
              <div class="m-t-lg">
                <button class="btn btn-danger" onclick="deleteRecord()" data-dismiss="modal" type="button" style="padding-left: 30px;padding-right: 30px;">Yes</button>

                <button class="btn btn-default" data-dismiss="modal" type="button" style="padding-right: 30px;padding-left: 30px;">No</button>
              </div>
            </div>
           </div>
          <div class="modal-footer"></div>
        </div>
      </div>
     </div>
     <div class="layout-footer">
        <div class="layout-footer-body">
          <small class="version">Version 1.4.0</small>
          <small class="copyright">2018 &copy; Elephant <a href="http://madebytilde.com/">Made by Tilde</a></small>
        </div>
     </div>
    </div>   
    <script src="<?php echo base_url()?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/elephant.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/application.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/demo.min.js"></script>
  </body>
</html>

