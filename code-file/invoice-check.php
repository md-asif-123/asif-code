<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "header.php";
include "config/config.php";
include "lib/function.php";

$getInvoice = getInvoice($conn);

//print_r($getInvoice);

?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Invoice</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      <a href="invoice-view.php">Invoice List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Invoice
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Invoice Check</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Invoice Name</th>
                          <th>View</th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($getInvoice['data'] as $row): ?>
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['invoice_name']; ?></td>
                          <td><a href="https://inventorydemo.amposible.com/inventory/invoice.php">View<a></td>
                          <td>
                            <label class="switch">
                            <input id="bclick<?php echo $row['id']; ?>" data-value="<?php echo $row['id']; ?>" class="switch slider round" type="checkbox" <?php if($row['status'] == 0): echo 'checked'; else: echo ''; endif;?>>
                            <span class="slider"></span>
                            </label>
                          </td>
                        </tr>
                        <script>
                        $(function() {
                        $("#bclick<?php echo $row['id']; ?>").click(function(e) {
                        var is_check; 
                        var input_id = $(this).data('value');
                        console.log(input_id);
                        if($(this).is(':checked')){
                          is_check = 0;
                        console.log('Checked')
                        } else {
                          is_check = 1;
                        console.log('Unchecked')
                        }
                        //prevent Default functionality
                        //e.preventDefault();

                            $.ajax({
                            url: 'caseinvoice.php',
                            type: 'post',
                            dataType: 'json',
                            data:{id:input_id,is_check:is_check},
                            success: function(data) {
                            //$("#total1").html(data['total']);
                            },
                            error: function(xhr, textStatus, errorThrown) {
                            alert(errorThrown);
                            }
                            });



                        });

                        });
                        </script>
                      <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Invoice Name</th>
                          <th>View</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
 

<?php
include "footer.php";
?>
