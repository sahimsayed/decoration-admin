<?php
include('includes/checklogin.php');
check_login();
// Code for deleting product from cart
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="delete from tbleventtype where ID=:rid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage_event.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php @include("includes/header.php");?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php @include("includes/sidebar.php");?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Service register</h5>    
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addsector" ><i class="fas fa-plus" ></i> Add Event
                    </button>
                  </div>    
                </div>
                <!-- /.card-header -->
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-sm ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Register Event</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- <p>One fine body&hellip;</p> -->
                        <?php @include("newevent.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><!-- 
                        <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>Event Name</th>
                      <th>Creation Date</th>
                      <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql="SELECT * from tbleventtype";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                        {               ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td class="font-w600"><?php  echo htmlentities($row->EventType);?></td>
                            <td class="d-none d-sm-table-cell"><?php  echo htmlentities($row->CreationDate);?></td>
                            <td class="text-center">
                              <a href="manage_event.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');"><i class="mdi mdi-delete" aria-hidden="true"></i></a>
                            </td>

                          </tr>
                          <?php 
                          $cnt=$cnt+1;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php @include("includes/footer.php");?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php @include("includes/foot.php");?>
  <!-- End custom js for this page -->
</body>
</html>
