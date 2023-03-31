$(document).ready(function () {
    
    showAllRecord();
    function showAllRecord () {
        $.ajax({
            type: "post",
            url: "action.php",
            data: {action: "view"},
            success: function (response) {
                $('#showUser').html(response);
                $('table').DataTable({
                    order: [0,'asc']
                });
            }
        });
    }

    // Insert Ajax Request
    $('#insert').click(function (event) {
        if($('#form-data')[0].checkValidity()){
            event.preventDefault();
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
            });
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

    // Update Ajax Request
    $('#update').click(function (event) {
        if($('#edit-form-data')[0].checkValidity()){
            event.preventDefault();
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

    // Edit Ajax Request
    $('body').on('click','.infoBtn', function(){
        var info = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "action.php",
            data: {info: info},
            success: function (response) {
                var data = JSON.parse(response);
                Swal.fire({
                    title: '<strong>User Info : ID ('+data.id+')</strong>',
                    icon: 'info',
                    html: '<b>First Name :</b> ' +data.first_name+ '<br><b>First Name :</b> ' +data.last_name+ '<br><b>Email :</b> '+ data.email+ '<br><b>Phone :</b> ' +data.phone,
                    // showCancelButton: true
                })
            }
        });
    })

});