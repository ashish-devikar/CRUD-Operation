<?php

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password ="";
$databsee = "notes";

$conn = mysqli_connect($servername, $username, $password, $databsee);

if(!$conn){
    die("Sorry connection we are fail : ". mysqli_connect_error());
}

// Delete Query Part

if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `note` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
        $delete=true;
    }
}

//Update Query Part and Insert

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['snoEdit'])){
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $desc = $_POST["descEdit"];
    
        $sql = "UPDATE `note` SET `title` = '$title', `description` = '$desc' WHERE `note`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result){
            $update = true;
        }
    }else{
    $title = $_POST["title"];
    $desc = $_POST["desc"];

    $sql = "INSERT INTO `note`(`title`,`description`) VALUES ('$title','$desc')";
    $result = mysqli_query($conn, $sql);

    if($result){
        $insert = true;
    }else{
        echo "The record was not submited!";
    }
}
}
?>

<!-- Html Part -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/project/crud_opration.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" class="form-control" id="titleEdit" name="titleEdit">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Discreption</label>
  <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Navbar Part -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php

if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your are Record has been Submited.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your are Record has been Update Successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($delete){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your are Record has been Deleted.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}

?>

<!-- From Part -->

<div class="container mt-4" >
   
<form action="/project/crud_opration.php?update=true" method="post">
    <h2>Add Notes</h2>
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" class="form-control" id="title" name="title">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Discreption</label>
  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Add Notes</button>
</form>
</div>

<!-- Table View Part -->

<div class="container my-4">

<table class="table" id="myTable">
<thead>
  <tr>
    <th scope="col">S-No</th>
    <th scope="col">Title</th>
    <th scope="col">Description</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>


<?php

$sql = "SELECT * FROM `note`";
$result = mysqli_query($conn, $sql);
$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno = $sno + 1;
    echo "<tr>
    <th scope='row'>".$sno."</th>
    <td>".$row['title']."</td>
    <td>".$row['description']."</td>
    <td><button type='button' id=".$row['sno']." class='edit btn btn-success' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button> 
    <button type='button' id=d".$row['sno']." class='delete btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button></td>
  </tr>";
}

?>
 
 
</tbody>
</table>
</div>
<!-- Script Part -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            console.log("edit",);
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title,description);
            titleEdit.value = title;
            descEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#editModal').modal('toggle');
;        })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            console.log("edit",);
            sno =e.target.id.substr(1,);
           if(confirm("Are you Sure want to Delete this note")){
            console.log("yes");
            window.location = `/project/crud_opration.php?delete=${sno}`;
           }else{
            console.log("no");
           }
;        })
    })
</script>
</body>
</html>