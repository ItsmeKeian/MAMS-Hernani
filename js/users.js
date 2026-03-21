// ==============================
// LOAD USERS
// ==============================

$(document).ready(function () {

    loadUsers();

});


function loadUsers() {

    $.ajax({

        url: "../php/retrieve/retrieve_users.php",
        type: "POST",
        dataType: "json",

        success: function (res) {

            let tbody = $("#userTable tbody");

            tbody.empty();

            if (res.length == 0) {

                tbody.append(
                    "<tr><td colspan='5'>No users</td></tr>"
                );

                return;

            }

            $.each(res, function (i, u) {

                tbody.append(`

                    <tr>

                        <td>${u.name ?? ""}</td>
                         <td>${u.role ?? ""}</td>
                        <td>${u.username ?? ""}</td>
                       
                        <td>${u.email ?? ""}</td>
                        <td>${u.created_at ?? ""}</td>

                        <td>

                            <button class="btn btn-sm btn-warning editUser" data-id="${u.id}">
                            Edit
                            </button>

                            <button class="btn btn-sm btn-danger deleteUser" data-id="${u.id}">
                            Delete
                            </button>

                        </td>

                    </tr>

                `);

            });

        }

    });

}


// ==============================
// CREATE USER
// ==============================

$("#saveUser").click(function () {

    let formData = $("#userForm").serialize();

    $.ajax({

        url: "../php/create/create_user.php",
        type: "POST",
        data: formData,
        dataType: "json",

        success: function (res) {

            if (res.status == 1) {

                // loading state
                Swal.fire({
                    title: "Creating user...",
                    allowOutsideClick: false,
                    timer: 1200,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                }).then(() => {

                    // success state
                    Swal.fire({
                        icon: "success",
                        title: "User created successfully",
                        timer: 1200,
                        showConfirmButton: false
                    });

                    $("#createUser").modal("hide");

                    $("#userForm")[0].reset();

                    loadUsers();

                });

            }

        }

    });

});


//edit user
$(document).on("click", ".editUser", function(){

    let id = $(this).data("id");

    $.post(

        "../php/retrieve/retrieve_edit_user.php",
        { id: id },

        function(res){

            let u = JSON.parse(res);

            $("#edit_id").val(u.id);
            $("#edit_name").val(u.name);
            $("#edit_username").val(u.username);
            $("#edit_email").val(u.email);

            $("#editUser").modal("show");

        }

    );

});

// save edit user
$("#updateUser").click(function(){

    let pass = $("#edit_password").val();
    let confirm = $("#edit_confirm").val();

    if(pass !== ""){

        if(pass !== confirm){

            Swal.fire({
                icon:"error",
                title:"Password not match"
            });

            return;
        }

    }

    let formData = $("#editForm").serialize();

    $.ajax({

        url:"../php/update/update_user.php",
        type:"POST",
        data:formData,
        dataType:"json",

        success:function(res){

            if(res.status==1){

                // loading state
                Swal.fire({
                    title:"Updating...",
                    allowOutsideClick:false,
                    timer:1200,
                    didOpen:()=>{
                        Swal.showLoading();
                    }
                }).then(()=>{

                    // success state
                    Swal.fire({
                        icon:"success",
                        title:"Updated successfully",
                        timer:1200,
                        showConfirmButton:false
                    });

                    $("#editUser").modal("hide");

                    loadUsers();

                });

            }

        }

    });

});



//delete user
$(document).on("click", ".deleteUser", function () {

    let id = $(this).data("id");

    Swal.fire({
        title: "Delete user?",
        text: "This cannot be undone",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete"
    }).then((r) => {

        if (!r.isConfirmed) return;

        $.ajax({

            url: "../php/delete/delete_user.php",
            type: "POST",
            data: { id: id },
            dataType: "json",

            success: function (res) {

                if (res.status == 1) {

                    // loading
                    Swal.fire({
                        title: "Deleting...",
                        allowOutsideClick: false,
                        timer: 1200,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {

                        // success
                        Swal.fire({
                            icon: "success",
                            title: "Deleted successfully",
                            timer: 1200,
                            showConfirmButton: false
                        });

                        loadUsers();

                    });

                }

            }

        });

    });

});