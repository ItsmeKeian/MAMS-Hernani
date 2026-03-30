
// SAVE

$("#saveBeneficiary").click(function () {

    let formData = $("#beneficiaryForm").serialize();

    let editId = $("#beneficiaryForm").data("edit-id");

    let url = "../php/create/create_beneficiary.php";


    // EDIT 

    if (editId) {

        formData += "&id=" + editId;

        url = "../php/update/update_beneficiary.php";

    }



    $.ajax({

        type: "POST",
        url: url,
        data: formData,
        dataType: "json",

        success: function (res) {

            if (res.status == 1) {

                Swal.fire({
                    title: editId ? "Updating..." : "Saving...",
                    allowOutsideClick: false,
                    timer: 1000,
                    didOpen: () => {
                        Swal.showLoading();
                    }

                }).then(() => {

                    Swal.fire({
                        icon: "success",
                        title: editId
                            ? "Updated successfully"
                            : "Saved successfully",
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



// Include Family Member




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



// Assistance receive

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



// UPDATE


$(document).on("click", ".edit", function () {

    let id = $(this).data("id");

    Swal.fire({
        title: "Loading...",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    $.post(
        "../php/retrieve/retrieve_one_beneficiary.php",
        { id: id },
        function (res) {

            let data = JSON.parse(res);

            let b = data.beneficiary;
            let family = data.family;
            let aid = data.assistance;

            Swal.close();

            $("#addModal").modal("show");

            $("#addModal h5").text("Edit Beneficiary");
            $("#saveBeneficiary").text("Update Beneficiary");

            $("#beneficiaryForm").data("edit-id", b.id);


            //  BENEFICIARY 

            $("input[name=region]").val(b.region);
            $("input[name=province]").val(b.province);
            $("input[name=municipality]").val(b.municipality);
            $("input[name=barangay]").val(b.barangay);
            $("input[name=district]").val(b.district);
            $("input[name=evacuation]").val(b.evacuation_site);

            $("input[name=last_name]").val(b.last_name);
            $("input[name=first_name]").val(b.first_name);
            $("input[name=middle_name]").val(b.middle_name);
            $("input[name=name_ext]").val(b.name_ext);

            $("input[name=birthdate]").val(b.birthdate);
            $("input[name=age]").val(b.age);
            $("input[name=place_of_birth]").val(b.place_of_birth);

            $("input[name=civil_status]").val(b.civil_status);
            $("input[name=mothers_maiden_name]").val(b.mothers_maiden_name);
            $("input[name=religion]").val(b.religion);
            $("input[name=occupation]").val(b.occupation);

            $("input[name=monthly_income]").val(b.monthly_income);
            $("input[name=id_card_presented]").val(b.id_card_presented);
            $("input[name=id_number]").val(b.id_number);

            $("input[name=contact_number]").val(b.contact_number);

            $("input[name=house_no]").val(b.house_no);
            $("input[name=street]").val(b.street);
            $("input[name=sitio]").val(b.sitio);
            $("input[name=addr_barangay]").val(b.addr_barangay);
            $("input[name=addr_city]").val(b.addr_city);
            $("input[name=addr_province]").val(b.addr_province);
            $("input[name=zip_code]").val(b.zip_code);

            $("input[name=ip_type]").val(b.ip_type);

            $("input[name=bank]").val(b.bank_wallet);
            $("input[name=account_name]").val(b.account_name);
            $("input[name=account_type]").val(b.account_type);
            $("input[name=account_number]").val(b.account_number);

            $("input[name=ownership][value='" + b.ownership + "']")
            .prop("checked", true);

            $("input[name=damage][value='" + b.damage_classification + "']")
            .prop("checked", true);

            if (b.is_4ps == 1) {
                $("input[name=is_4ps]").prop("checked", true);
            }

            $("input[name=date_registered]").val(b.date_registered);


            //  CLEAR TABLES 

            $("#familyTable tbody").html("");
            $("#aidTable tbody").html("");


            // FAMILY 

            family.forEach(f => {

                let row = `
<tr>

<td><input name="fm_name[]" value="${f.name}" class="form-control"></td>
<td><input name="fm_relation[]" value="${f.relation}" class="form-control"></td>
<td><input name="fm_birthdate[]" value="${f.birthdate}" type="date" class="form-control"></td>
<td><input name="fm_age[]" value="${f.age}" class="form-control"></td>
<td><input name="fm_sex[]" value="${f.sex}" class="form-control"></td>
<td><input name="fm_education[]" value="${f.education}" class="form-control"></td>
<td><input name="fm_occupation[]" value="${f.occupation}" class="form-control"></td>
<td><input name="fm_vulnerability[]" value="${f.vulnerability}" class="form-control"></td>

<td>
<button type="button" class="btn btn-danger removeRow">X</button>
</td>

</tr>
`;

                $("#familyTable tbody").append(row);

            });


            // ASSISTANCE 

            aid.forEach(a => {

                let row = `
<tr>

<td><input name="aid_date[]" type="date" value="${a.date_received}" class="form-control"></td>
<td><input name="aid_receiving[]" value="${a.receiving_name}" class="form-control"></td>
<td><input name="aid_disaster[]" value="${a.disaster_type}" class="form-control"></td>
<td><input name="aid_type[]" value="${a.assistance_type}" class="form-control"></td>
<td><input name="aid_unit[]" value="${a.unit}" class="form-control"></td>
<td><input name="aid_qty[]" value="${a.quantity}" class="form-control"></td>
<td><input name="aid_cost[]" value="${a.cost}" class="form-control"></td>
<td><input name="aid_provider[]" value="${a.provider}" class="form-control"></td>

<td>
<button type="button" class="btn btn-danger removeRow">X</button>
</td>

</tr>
`;

                $("#aidTable tbody").append(row);

            });

        }
    );

});


$(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
});


// DELETE

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


            // COUNT
           

            let start = (page - 1) * limit + 1;
            let end = start + res.data.length - 1;

            $("#recordCount").text(
                `Showing ${start} - ${end} of ${res.total}`
            );



            // PAGINATION SLIDING
    

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



// CLICK PAGINATION

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