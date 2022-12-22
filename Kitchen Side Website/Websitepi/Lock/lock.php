<!DOCTYPE html>
<?php
// INSERT INTO `lock_unlock_door` (`lock_id`, `lock_status`) VALUES ('1', '0');
// UPDATE `lock_unlock_door` SET `lock_location` = 'customers' WHERE `lock_unlock_door`.`lock_id` = 1; 
// "DELETE FROM `lock_unlock_door` WHERE `lock_unlock_door`.`lock_id` = 4"
// UPDATE `lock_unlock_door` SET `lock_status` = '0' WHERE `lock_unlock_door`.`lock_id` = 1; 

use LDAP\Result;

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}

require '../Database_Files/_dbconnect.php';

$insert = false;
$update = false; 
$delete = false;
$status = false;

if (isset($_GET['delete'])) {
  $lockid = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `lock_unlock_door` WHERE `lock_unlock_door`.`lock_id` = $lockid";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['lockidEdit'])) {
    // Update the record;
    $lock_location = $_POST["lock_locationEdit"];
    $lockid = $_POST['lockidEdit'];

    $sql = "UPDATE `lock_unlock_door` SET `lock_location` = '$lock_location' WHERE `lock_unlock_door`.`lock_id` = $lockid;";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $update = true;
    } else {
      echo "The record has not been sucessfully updated" . mysqli_error($conn);
    }
  } elseif (isset($_POST['statusEdit'])) {
    $lockid = $_POST['statusEdit'];

    $sql = "SELECT `lock_status` FROM `lock_unlock_door` WHERE `lock_unlock_door`.`lock_id` = $lockid;";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['lockEdit'])) {
      $sql = "UPDATE `lock_unlock_door` SET `lock_status` = 1 WHERE `lock_unlock_door`.`lock_id` = $lockid;";
      mysqli_query($conn, $sql);
      $status = true;
    } else if (isset($_POST['unlockEdit'])) {
      $sql = "UPDATE `lock_unlock_door` SET `lock_status` = 0 WHERE `lock_unlock_door`.`lock_id` = $lockid;";
      mysqli_query($conn, $sql);
      $status = true;
    }
  } else {
    $lockid = $_POST["lockid"];
    $lock_location = $_POST["lock_location"];

    $sql = "INSERT INTO `lock_unlock_door` (`lock_id`, `lock_location`, `lock_status`) VALUES ('$lockid', '$lock_location', '0'); ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;
    } else {
      echo "The record has not been sucessfully inserted" . mysqli_error($conn);
    }
  }
}

?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SEES</title>
  <link href="../Lock/guistylesheet.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Lock/datatable.css">
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <title>SEES</title>

</head>
</body>
<?php
  require '../Partials/_nav.php'
?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLable">Edit Lock</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../Website/Lock/lock.php" method="POST">
          <input type="hidden" name="lockidEdit" id="lockidEdit">
          <div class="mb-3">
            <label for="lock_location" class="form-label">Lock Location</label>
            <textarea class="form-control" id="lock_locationEdit" name="lock_locationEdit" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Lock</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="statusChange" tabindex="-1" aria-labelledby="statusChangeLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="statusChangeLable">Change Lock Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../Lock/lock.php" method="POST">
          <input type="hidden" name="statusEdit" id="statusEdit">
          <div class="mb-3">
            <button type="submit" class="btn ms-6 btn-primary" id="lockEdit" name="lockEdit" rows="3">Lock</button>
            <button type="submit" class="btn ms-2 btn-primary" id="unlockEdit" name="unlockEdit" rows="3">Unlock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if ($insert) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucess!</strong> Lock Data Saved Sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>
<?php
if ($update) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucess!</strong> Lock Data Updated Sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>
<?php
if ($delete) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucess!</strong> Lock Data Deleted Sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>
<?php
if ($status) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucess!</strong> Lock Data changed Sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>
<div class="container my-4">
  <h1>Add Lock</h1>
  <form action="../Lock/lock.php" method="POST">
    <div class="mb-3">
      <label for="lockid" class="form-label">Lock ID</label>
      <input type="number" class="form-control" id="lockid" name="lockid" aria-describedby="emailHelp" />
    </div>
    <div class="mb-3">
      <label for="lock_location" class="form-label">Lock Location</label>
      <textarea class="form-control" id="lock_location" name="lock_location" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Lock</button>
  </form>
</div>

<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Lock ID</th>
        <th scope="col">Lock Location</th>
        <th scope="col">Lock Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `lock_unlock_door`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <th scope='row'>" . $row['lock_id'] . "</th>
              <td>" . $row['lock_location'] . "</td>
              <td>"; 
              if ($row['lock_status'] == 1)
              {
                echo "LOCK";
              } else if ($row['lock_status'] == 0){
                echo "UNLOCK";
              }
              echo "</td>
              <td>
              <button class='status btn btn-sm btn-primary' id=s" . $row['lock_id'] . ">Change Status</button>
              <button class='edit btn btn-sm btn-primary' id=" . $row['lock_id'] . ">Edit</button> 
              <button class='delete btn btn-sm btn-primary' id=d" . $row['lock_id'] . ">Delete</button>
              </tr>";
      }
      ?>
    </tbody>

  </table>
</div>
<hr>
<script>
  stat = document.getElementsByClassName('status');
  Array.from(stat).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("status ");
      tr = e.target.parentNode.parentNode;
      statusEdit.value = e.target.id.substr(1, );
      console.log(e.target.id.substr(1, ));
      $('#statusChange').modal('toggle');
    })
  })

  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit");
      tr = e.target.parentNode.parentNode;
      lock_location = tr.getElementsByTagName("td")[0].innerText;
      console.log(lock_location);
      lock_locationEdit.value = lock_location;
      lockidEdit.value = e.target.id;
      console.log(e.target.id)
      $('#editModal').modal('toggle');
    })
  })

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("delete");
      lockid = e.target.id.substr(1, );

      if (confirm("Are you sure you want to delete this note!")) {
        console.log("yes");
        window.location = `../Lock/lock.php?delete=${lockid}`;
        // TODO: Create a form and use post request to submit a form
      } else {
        console.log("no");
      }
    })
  })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>