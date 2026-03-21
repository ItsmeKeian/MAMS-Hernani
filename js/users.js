$(document).ready(function(){

    loadUsers();

});

 $.ajax({

        url: "../php/retrieve/retrieve_users.php",
        type: "POST",
        dataType: "json",

        success: function(res){

           let tbody = $("#userTable tbody");

           tbody.empty();

           if(res.length == 0){

            tbody.append(
                "<tr><td colspan='5'>No users</td></tr>"
            );

            return;

           }

           $.each(res, function(i, u){

                        tbody.append(`<tr>

                                        <td>${u.name ?? ""}</td>
                                        <td>${u.username ?? ""}</td>
                                        <td>${u.email ?? ""}</td>
                                        <td>${u.created_at ?? ""}</td>

                           
                                    <td>

                                        <button class="btn btn-sm btn-warning">
                                                Edit
                                        </button>

                                        <button class="btn btn-sm btn-danger">
                                                Delete
                                        </button>
                            
                                    </td>

                                </tr>
                            `);
           });

        }
 });
 