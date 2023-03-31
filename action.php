<?php
require 'db.php';
$db = new Database();
    // Fetch Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $output = '';
    $data = $db->getRecord();
    if($db->totalRowCount() > 0){
        $output .= '<table class="table table-striped table-lg table-bordered">
                    <thead align="center">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $i = 1;
        foreach($data as $value){
            $output .= '<tr class="text-center text-secondary">
                    <td>'.$i++.'</td>
                    <td>'.$value['first_name'].'</td>
                    <td>'.$value['last_name'].'</td>
                    <td>'.$value['email'].'</td>
                    <td>'.$value['phone'].'</td>
                    <td>
                        <a href="javascript:void(0)" title="View Detail" id="'.$value['id'].'" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myEditModal" title="Edit" id="'.$value['id'].'" class="text-primary editBtn"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0)" title="Delete" id="'.$value['id'].'" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                    </td></tr>';
        }
    }else{
        echo '<tr class="text-center text-primary mt-5"><td colspan="6">(No Data Found)</td></tr>';
    }
    $output .= '</tbody></table>';
    echo $output;
}

    // Insert Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $db->insertRecord($fname,$lname,$email,$phone);
}
    // Edit Ajax Request
if(isset($_POST['edit_id'])){
    $id = $_POST['edit_id'];
    $row = $db->getRecordById($id);
    echo json_encode($row);
}

    // Insert Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['hidden_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $db->updateRecord($id,$fname,$lname,$email,$phone);
}
    // Edit Ajax Request
if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $db->deleteRecord($id);
}

    // Delete Ajax Request
if(isset($_POST['info'])){
    $id = $_POST['info'];
    $row = $db->getRecordById($id);
    echo json_encode($row);
}

    // Export Excel
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $db->getRecord();

    $output= '<table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>';
    $i = 1;
    foreach($data as $value){
        $output .= '<tr>
                    <td>'.$i++.'</td>
                    <td>'.$value['first_name'].'</td>
                    <td>'.$value['last_name'].'</td>
                    <td>'.$value['email'].'</td>
                    <td>'.$value['phone'].'</td>
                </tr>';
    }
    $output .= '</table>';
    echo $output;
}

?>
