$(document).ready(function () {
    
    showAllRecord();
    function showAllRecord () {
        $.ajax({
            type: "post",
            url: "action.php",
            data: {action: "view"},
            success: function (response) {
                $('#showUser').html(response);
                $('table').DataTable();
            }
        });
    }
        // Insert Validation
    function InsertValidateForm(){
        let valid = true;
        $('.form-control').css({'background-color': '', 'border': ''});
        $('.invalid-feedback').html(''); 
        if(!$('#fname').val()){
            $('#err_fname').css('display','block');
            $('#err_fname').html("First Name is Required!");
            $('#fname').css({'background-color': '#FFFFDF', 'border': '1px solid red'});
            valid = false;
        }
        if(!$('#fname').val().match(/[a-zA-Z]$/)){
            $('#err_fname').css('display','block');
            $('#err_fname').html("Please Enter Valid Name!");
            $('#fname').css({'background-color': '#FFFFDF', 'border': '1px solid red'});
            valid = false;
        }
        if(!$('#lname').val()){
            $('#err_lname').css('diisplay','block');
            $('#err_lname').html("Last Name is Required!");
            $('#lname').css({'background-color': '#ffffdf','border':'1px solid red'});
            valid = false;
        }
        if(!$('#email').val()){
            $('#err_email').css('display','block');
            $('#err_email').html('Email is Required!');
            $('#email').css({'background-color':'#ffffdf','border':'1px solid red'});
            valid = false;
        }
        if(!$('#email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
            $('#err_email').css('display','block');
            $('#err_email').html("Please Enter a Valid Email Address!");
            $('#email').css({'background-color':'#ffffdf','border':'1px solid red'});
            valid = false;
        }
        if(!$('#phone').val()){
            $('#err_phone').css('display','block');
            $('#err_phone').html("Please Enter Mobile Number!");
            $('#phone').css({'background-color':'#ffffdf','border': '1px solid red'});
            valid = false;
        }
        return valid;
    }
    // Insert Ajax Request
    $('#insert').click(function (event){
        event.preventDefault();
        let valid = InsertValidateForm();
        if(valid){
            $.ajax({
                method: "post",
                url: "action.php",
                data: $('#form-data').serialize()+"&action=insert",
                success: function (response) {
                    Swal.fire({
                        title: "User Added Successfully.",
                        icon: 'success'
                    })
                    $('#myModal').modal('hide');
                    $('#form-data')[0].reset();
                    showAllRecord();
                }
            })
        }
    })

    // Edit Ajax Request
    $('body').on('click','.editBtn', function(){
        var edit_id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "action.php",
            data: {edit_id: edit_id},
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $('#hidden_id').val(response.id);
                $('#edit_fname').val(response.first_name);
                $('#edit_lname').val(response.last_name);
                $('#edit_email').val(response.email);
                $('#edit_phone').val(response.phone);
            }
        });
    })

        // Update Validation
        function editValidateForm(){
            let valid = true;
            $('.form-control').css({'background-color': '', 'border': ''});
            $('.invalid-feedback').html('');
            if(!$('#edit_fname').val()){
                $('#err_edit_fname').css('display','block');
                $('#err_edit_fname').html("First Name is Required!");
                $('#edit_fname').css({'background-color': '#FFFFDF', 'border': '1px solid red'});
                valid = false;
            }
            if(!$('#edit_lname').val()){
                $('#err_edit_lname').css('diisplay','block');
                $('#err_edit_lname').html("Last Name is Required!");
                $('#edit_lname').css({'background-color': '#ffffdf','border':'1px solid red'});
                valid = false;
            }
            if(!$('#edit_email').val()){
                $('#err_edit_email').css('display','block');
                $('#err_edit_email').html('Email is Required!');
                $('#edit_email').css({'background-color':'#ffffdf','border':'1px solid red'});
                valid = false;
            }
            if(!$('#edit_email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
                $('#err_edit_email').css('display','block');
                $('#err_edit_email').html("Please Enter a Valid Email Address!");
                $('#edit_email').css({'background-color':'#ffffdf','border':'1px solid red'});
                valid = false;
            }
            if(!$('#edit_phone').val()){
                $('#err_edit_phone').css('display','block');
                $('#err_edit_phone').html("Please Enter Mobile Number!");
                $('#edit_phone').css({'background-color':'#ffffdf','border': '1px solid red'});
                valid = false;
            }
            return valid;
        }
    // Update Ajax Request
    $('#update').click(function (event) {
        if($('#edit-form-data')[0].checkValidity()){
            event.preventDefault();
            var valid = editValidateForm();
            if(valid){
                $.ajax({
                    method: "post",
                    url: "action.php",
                    data: $('#edit-form-data').serialize()+"&action=update",
                    success: function (response) {
                        Swal.fire({
                            title: "User Updated Successfully.",
                            icon: 'success'
                        })
                        $('#myEditModal').modal('hide');
                        $('#edit-form-data')[0].reset();
                        showAllRecord();
                    }
                });
            }
        }
    })

    // Delete Ajax Request
    $('body').on('click','.deleteBtn', function(){
       
        var tr = $(this).closest('tr');
        var del_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "post",
                    url: "action.php",
                    data: {del_id: del_id},
                    success: function (response) {
                        tr.css('background-color','#ff6666');
                        Swal.fire({
                            title: "User Deleted Successfully.",
                            icon: 'success' 
                        });
                        showAllRecord();
                    }
                });
            }
        })
    })

    // Info Ajax Request
    $('body').on('click','.infoBtn', function(){
        var info_id = $(this).attr('id');
        
        $.ajax({
            type: "post",
            url: "action.php",
            data: {info_id: info_id},
            dataType: "json",
            success: function (response) {
                console.log(response);
                
                Swal.fire({
                    icon: 'info',
                    title: "User Info : ID (" +response.id+ ")",
                    html: "<b> First Name : "+response.first_name+"</b></br><b> Last Name :"+response.last_name+"</b></br><b> Email : "+response.email+"</b></br><b> Phone : "+response.phone+"</b></br>",
                    
                    // showCancelButton: true,
                });
            }
        });
    })
});