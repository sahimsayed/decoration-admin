<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit2']))
{

  $bid= $_SESSION['edid3'];
  $status=$_POST['status'];
  $remark=$_POST['remark'];
  $sql= "update tblbooking set Status=:status,Remark=:remark where ID=:bid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':status',$status,PDO::PARAM_STR);
  $query->bindParam(':remark',$remark,PDO::PARAM_STR);
  $query->bindParam(':bid',$bid,PDO::PARAM_STR);
  $query->execute();
  if($query->execute()){
    echo '<script>alert("updated successfuly")</script>';
    echo "<script>window.location.href ='new_bookings.php'</script>";
  }else{
    echo '<script>alert("failed updated try again later")</script>';
  }
}
?>
<form class="forms-sample" method="post">
  <?php
  $eid2=$_POST['edit_id2'];
  $sql="SELECT * from  tblbooking where ID=:eid2";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid2', $eid2, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
    { 
      $_SESSION['edid3']=$row->ID;
    }} 
    ?>
    <div class="form-group">
      <label for="exampleInputName1">Company remarks :</label>
      <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
    </div>
    <div class="form-group">
      <label for="exampleTextarea1">Status :</label>
      <select name="status"  class="form-control wd-450" required="true" >
        <option value="">Select status</option>
        <option value="Approved" selected="true">Approved</option>
        <option value="Cancelled">Cancelled</option>
      </select>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" name="submit2" class="btn btn-primary">Update</button>
    </div>
  </form>