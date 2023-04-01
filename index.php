<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.3/datatables.min.css" rel="stylesheet" />
    <title>PHP OOP CRUD</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">Practice</a>

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">More</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">
                    Application Using Bootstrap 4 PHP-OOP, PDO-MYSQL, AJAX DataTables AND Sweetalert2
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">All users in Databases</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm m-1 float-right"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New User</button>
                <a href="action.php?export=excel" class="btn btn-success btn-sm m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Export Excel</a>
            </div>
        </div>
        <hr class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser"></div>
            </div>
        </div>
    </div>

    <!-- The Insert Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form method="post" id="form-data">
                        <div class="form-group">
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                            <div class="invalid-feedback" id="err_fname" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                            <div class="invalid-feedback" id="err_lname" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            <div class="invalid-feedback" id="err_email" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                            <div class="invalid-feedback" id="err_phone" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-success btn-sm btn-block" value="Save" id="insert">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal fade" id="myEditModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form method="post" id="edit-form-data">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <div class="form-group">
                            <input type="text" name="fname" id="edit_fname" class="form-control" placeholder="First Name">
                            <div class="invalid-feedback" id="err_edit_fname" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" id="edit_lname" class="form-control" placeholder="Last Name">
                            <div class="invalid-feedback" id="err_edit_lname" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" id="edit_email" class="form-control" placeholder="Email">
                            <div class="invalid-feedback" id="err_edit_email" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="edit_phone" class="form-control" placeholder="Phone">
                            <div class="invalid-feedback" id="err_edit_phone" style="display: block;"></div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-sm btn-block" value="Update" id="update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.3/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="script.js"></script>
    
</body>
</html>