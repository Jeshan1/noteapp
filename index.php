<?php
include 'includes/dbconnect.php';
    $qry = "select * from tbnote";
    $data = $con->query($qry);
include 'includes/dbclose.php';
?>




<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  


  <title>iNotes - Notes taking made easy</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/php.png" alt="PHP" style="width: 60px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About</a>
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
            <!-- <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
            </li> -->
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

    <div class="container-md">
        <h2 class="mt-3">Add a note</h2>

        <form action="action.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" placeholder="" id="desc" name="description" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_add">Submit</button>
        </form>
    </div>

    <!-- edit modal starts  -->
        <div class="modal" tabindex="-1" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="updateaction.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="edit_id" value="<?php echo $id;?>">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control bg-success-subtle" id="edit_title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_desc" class="form-label">Description</label>
                        <textarea class="form-control bg-success-subtle" placeholder="" id="edit_desc" name="description" rows="4"></textarea>
                    </div>
                    <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_update">Save changes</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
        <!-- edit modal ends  -->

        <!-- delete modal starts  -->
        <div class="modal" tabindex="-1" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Delete Note</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="action.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="deleteModalid">
                        <h2 class="my-3 text-center text-success fw-bold">Are You Sure to delete?</h2>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="submit_delete">Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>



        <!-- delete modal ends  -->

        <!-- display table starts  -->
    <div class="container">
       <div class="mt-3">
        <h2>Notes are here!</h2>
        <div class="mt-3">
        <table id="mytable" class="display">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sn=1;
                    while ($row = $data->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $sn;?></td>
                            <td><?php echo $row['title'] ;?></td>
                            <td><?php echo $row['description'] ;?></td>
                            <td>
                                <button onclick="showEditModal(<?php echo $row['id'] ;?>)" class="btn btn-primary edit" id=".$row['id']." name="submit_update" type="submit">Edit</button>
                                <button class="btn btn-danger delete" id=".$row['id']." name="submit_delete" type="submit" onclick="showDeleteModal(<?php echo $row['id'] ;?>)">Delete</button>
                            </td>   
                        </tr>
                <?php
                    $sn++;
                    }
                ?>              
            </tbody>
        </table>
        </div>
       </div>
    </div>
    <!-- display table ends  -->






<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
  


    <script>
        // edits = document.getElementsByClassName('edit');
        // Array.from(edits).forEach((element)=>{
        //     element.addEventListener("click",(e)=>{
        //         // console.log(edits);   
        //         // tr = e.target.parentNode.parentNode;
        //         // title = tr.getElementsByTagName("td")[1].innerText;
        //         // description = tr.getElementsByTagName("td")[2].innerText;
        //         // console.log(title, description);
        //         // titleEdit.value = title;
        //         // descriptionEdit.value = description;
        //         // id.value = e.target.id;
        //         // console.log(e.target.id);
        //         $('#editModal').modal('show');
        //     })
        // }); 
    </script>

    <script>
        function showEditModal($id)
        {
            $.ajax({
                type:'GET',
                url:"updateaction.php",
                dataType:"JSON",
                data:{
                    "id":$id
                },
                success:function(data)
                {
                    
                    $('#edit_title').val(data[0].title);
                    $('#edit_desc').val(data[0].description);
                    $('#edit_id').val(data[0].id);
                }
            });
            $('#editModal').modal('show');
        }

        function showDeleteModal($iddata){    
            $('#deleteModalid').val($iddata);
            $('#deleteModal').modal('show');
        }

    </script>
  <script>
    $(document).ready( function () {
        $('#mytable').DataTable();
    });
  </script>

</body>
</html>
