// =============================
// SAVE
// =============================

$("#saveBeneficiary").click(function () {

    let formData = $("#beneficiaryForm").serialize();

    $.ajax({

        type: "POST",
        url: "../php/create/create_beneficiary.php",
        data: formData,
        dataType: "json",

        success: function (res) {

            if (res.status == 1) {

                // loading state
                Swal.fire({
                    title: "Saving...",
                    allowOutsideClick: false,
                    timer: 1200,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                }).then(() => {

                    // success state
                    Swal.fire({
                        icon: "success",
                        title: "Saved successfully",
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => {

                        location.reload();

                    });

                });

            }

        }

    });

});


// =============================
// Include Family Member
// =============================



$("#addFamilyRow").click(function(){

    $("#familyTable tbody").append(`

<tr>

<td>
<input type="text" name="fm_name[]" class="form-control">
</td>

<td>
<input type="text" name="fm_relation[]" class="form-control">
</td>

<td>
<input type="date" name="fm_birthdate[]" class="form-control">
</td>

<td>
<input type="number" name="fm_age[]" class="form-control">
</td>

<td>
<select name="fm_sex[]" class="form-control">
<option>Male</option>
<option>Female</option>
</select>
</td>

<td>
<input type="text" name="fm_education[]" class="form-control">
</td>

<td>
<input type="text" name="fm_occupation[]" class="form-control">
</td>

<td>
<input type="text" name="fm_vulnerability[]" class="form-control">
</td>

<td>

<button
type="button"
class="btn btn-danger removeRow">

X

</button>

</td>

</tr>

`);

});


$(document).on("click", ".removeRow", function(){

    $(this).closest("tr").remove();

});


// =============================
// Assistance receive
// =============================

$("#addAidRow").click(function () {

    $("#aidTable tbody").append(`
    
    <tr>
    
    <td>
    <input type="date" name="aid_date[]" class="form-control">
    </td>
    
    <td>
    <input type="text" name="aid_receiving[]" class="form-control">
    </td>
    
    <td>
    <input type="text" name="aid_disaster[]" class="form-control">
    </td>
    
    <td>
    <input type="text" name="aid_type[]" class="form-control">
    </td>
    
    <td>
    <input type="text" name="aid_unit[]" class="form-control">
    </td>
    
    <td>
    <input type="number" name="aid_qty[]" class="form-control">
    </td>
    
    <td>
    <input type="number" name="aid_cost[]" class="form-control">
    </td>
    
    <td>
    <input type="text" name="aid_provider[]" class="form-control">
    </td>
    
    
    <td>
    <button type="button" class="btn btn-danger removeRow">X</button>
    </td>
    
    </tr>
    
    `);
    
    });
    
    
    $(document).on("click",".removeRow",function(){
    
    $(this).closest("tr").remove();
    
    });





// =============================
// View
// =============================

$(document).on("click", ".view", function () {

    let id = $(this).data("id");

    window.location.href = "view_beneficiary.php?id=" + id;

});

// =============================
// DELETE
// =============================

$(document).on("click", ".delete", function () {

    let id = $(this).data("id");

    Swal.fire({
        title: "Delete?",
        text: "This record will be removed",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete"
    }).then((r) => {

        if (!r.isConfirmed) return;

        $.ajax({

            url: "../php/delete/delete_beneficiary.php",
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

                        loadBeneficiary(currentPage);

                    });

                }

            }

        });

    });

});


// =============================
// TABLE + PAGINATION
// =============================

let currentPage = 1;
let limit = 5;
let maxVisible = 3;


$(function () {

    loadBeneficiary(1);

});



function loadBeneficiary(page = 1, search = "", barangay = "") {

    currentPage = page;

    $.ajax({

        type: "POST",

        url: "../php/retrieve/retrieve_beneficiary.php",

        data: {
            page: page,
            limit: limit,
            search: search,
            barangay: barangay
        },

        dataType: "json",

        success: function (res) {

            let tbody = $("#beneficiaryTable tbody");

            tbody.empty();

            if (!res.data || res.data.length == 0) {

                tbody.append(
                    "<tr><td colspan='9'>No records</td></tr>"
                );

                return;
            }


            // ====================
            // ROWS
            // ====================

            $.each(res.data, function (i, b) {

                let f = b.last_name?.charAt(0) || "";
                let l = b.first_name?.charAt(0) || "";

                let initials = (f + l).toUpperCase();

                tbody.append(`

                    <tr>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="avatar bg-primary text-white rounded-circle
                                    d-flex align-items-center justify-content-center me-2"
                                    style="width:36px;height:36px;font-size:0.85rem;">

                                    ${initials}

                                </div>

                                <div>

                                    <div class="fw-semibold">

                                        ${b.last_name} ${b.first_name}

                                     </div>

                                 </div>

                            </div>

                        </td>

                        <td>
                            ${b.house_no} ${b.addr_barangay}
                        </td>

                        <td>${b.age}</td>

                        <td>${b.contact_number}</td>

                        <td>${b.occupation}</td>

                        <td>${b.ownership}</td>

                         <td>${b.damage_classification}</td>

                         <td>${b.date_registered}</td>

                        <td>

                            <button class="btn btn-sm btn-info view" data-id="${b.id}">
                                 <i class="fas fa-eye"></i>
                            </button>

                            <button class="btn btn-sm btn-warning edit" data-id="${b.id}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-sm btn-danger delete" data-id="${b.id}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>

                    </tr>

                    `);

            });


            // ====================
            // COUNT
            // ====================

            let start = (page - 1) * limit + 1;
            let end = start + res.data.length - 1;

            $("#recordCount").text(
                `Showing ${start} - ${end} of ${res.total}`
            );


            // ====================
            // PAGINATION SLIDING
            // ====================

            let totalPages = Math.ceil(res.total / limit);

            let pagination = $(".pagination");

            pagination.empty();


            // PREV

            pagination.append(`

            <li class="page-item ${page <= 1 ? "disabled" : ""}">

                <a class="page-link"
                    href="#"
                    data-page="${page - 1}">

                    Prev

                </a>

            </li>

            `);


            let startPage = Math.max(1, page - 1);
            let endPage = startPage + maxVisible - 1;

            if (endPage > totalPages) {

                endPage = totalPages;
                startPage = Math.max(1, endPage - maxVisible + 1);

            }


            for (let i = startPage; i <= endPage; i++) {

                pagination.append(`

                <li class="page-item ${i == page ? "active" : ""}">

                    <a class="page-link"
                        href="#"
                        data-page="${i}">

                        ${i}

                    </a>

                </li>

                `);

            }


            // NEXT

            pagination.append(`

                <li class="page-item ${page >= totalPages ? "disabled" : ""}">

                    <a class="page-link"
                        href="#"
                        data-page="${page + 1}">

                        Next

                    </a>

                </li>

            `);

        }

    });

}


// =============================
// CLICK PAGINATION
// =============================

$(document).on("click", ".page-link", function (e) {

    e.preventDefault();

    let page = $(this).data("page");

    if (!page) return;

    let search = $("#searchInput").val();
    let barangay = $("#filterBarangay").val();

    loadBeneficiary(page, search, barangay);

});


// SEARCH
$("#searchInput").on("input", function () {

    let search = $(this).val();
    let barangay = $("#filterBarangay").val();

    loadBeneficiary(1, search, barangay);

});


// FILTER TABLE
$("#filterBarangay").on("change", function () {

    let search = $("#searchInput").val();
    let barangay = $(this).val();

    loadBeneficiary(1, search, barangay);

});


// EXPORT FILTER (search + barangay + date)

$("#filterBarangay, #searchInputo")
.on("change input", function(){

    let brgy = $("#filterBarangay").val();
    let search = $("#searchInput").val();
   

    let url = "../php/export/export_beneficiaries.php";

    let params = [];

    if(brgy !== ""){
        params.push("barangay=" + brgy);
    }

    if(search !== ""){
        params.push("search=" + search);
    }

   
    if(params.length > 0){
        url += "?" + params.join("&");
    }

   

});