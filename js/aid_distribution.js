


function loadSummary(search, barangay, from, to) {

    $.ajax({

        type: "POST",
        url: "../php/retrieve/retrieve_aid_summary.php",

        data: {
            search: search,
            barangay: barangay,
            from: from,
            to: to
        },

        dataType: "json",

        success: function (res) {

            $("#totalCount").text(res.total);
            $("#qtyCount").text(res.qty);
            $("#costCount").text(res.cost);
            $("#beneficiaryCount").text(res.beneficiaries);

        }

    });

}

// =============================
// TABLE + PAGINATION
// =============================

let currentPage = 1;
let limit = 5;
let maxVisible = 3;


$(function () {

    let search = "";
    let barangay = "";
    let from = "";
    let to = "";
    

    loadBeneficiary(1, search, barangay, from, to);

});



function loadBeneficiary(page = 1, search = "", barangay = "", from = "", to = "") {

    currentPage = page;

    loadSummary(search, barangay, from, to);

    $.ajax({

        type: "POST",

        url: "../php/retrieve/retrieve_aid_distribution.php",

        data: {
            page: page,
            limit: limit,
            search: search,
            barangay: barangay,
            from: from,
            to: to,
            
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

                let name = b.receiving_name || "";

                let parts = name.split(" ");

                let initials = (
                    (parts[0]?.charAt(0) || "") +
                    (parts[1]?.charAt(0) || "")
                ).toUpperCase();

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

                                        ${b.receiving_name}

                                     </div>

                                 </div>

                            </div>

                        </td>

                        <td>
                            ${b.disaster_type} 
                        </td>

                        <td>${b.assistance_type}</td>

                        <td>${b.unit}</td>

                        <td>${b.quantity}</td>

                        <td>${b.cost}</td>

                         <td>${b.provider}</td>

                         <td>${b.date_received}</td>

                     

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



// date range
$("#dateFrom, #dateTo").on("change", function () {

    let search = $("#searchInput").val();
    let barangay = $("#filterBarangay").val();
    let from = $("#dateFrom").val();
    let to = $("#dateTo").val();
   

    loadBeneficiary(1, search, barangay, from, to);

});


// SEARCH
$("#searchInput").on("input", function () {

    let search = $(this).val();
    let barangay = $("#filterBarangay").val();
    let from = $("#dateFrom").val();
    let to = $("#dateTo").val();
    

    loadBeneficiary(1, search, barangay, from, to);

});


// FILTER TABLE
$("#filterBarangay").on("change", function () {

    let search = $("#searchInput").val();
    let barangay = $(this).val();
    let from = $("#dateFrom").val();
    let to = $("#dateTo").val();
    

    loadBeneficiary(1, search, barangay, from, to);

});




// EXPORT FILTER (search + barangay + date)

$("#filterBarangay, #searchInput, #dateFrom, #dateTo")
.on("change input", function(){

    let brgy = $("#filterBarangay").val();
    let search = $("#searchInput").val();
    let from = $("#dateFrom").val();
    let to = $("#dateTo").val();
   

    let url = "../php/export/export_aid_distribution.php";

    let params = [];

    if(brgy !== ""){
        params.push("barangay=" + brgy);
    }

    if(search !== ""){
        params.push("search=" + search);
    }

    if(from !== ""){
        params.push("from=" + from);
    }

    if(to !== ""){
        params.push("to=" + to);
    }

   

    if(params.length > 0){
        url += "?" + params.join("&");
    }

    $("#exportBtn").attr("href", url);

    $("#printBtn").attr(
        "href",
        url
        .replace("../php/export/export_aid_distribution.php",
                "../php/print/print_aid_distribution.php")
    );

});


$("#exportBtn").click(function(e){

    e.preventDefault();

    let url = $(this).attr("href");

    if(!url) return;

    // loading
    Swal.fire({
        title: "Preparing Excel...",
        allowOutsideClick:false,
        timer:1000,
        didOpen:()=>{
            Swal.showLoading();
        }
    }).then(()=>{

        // success state
        Swal.fire({
            icon: "success",
            title: "Export ready",
            timer:1000,
            showConfirmButton:false
        }).then(()=>{

            // start download after success
            window.location.href = url;

        });

    });

});



$("#printBtn").click(function(e){

    e.preventDefault();

    let url = $(this).attr("href");

    if(!url) return;

    Swal.fire({
        title: "Preparing report...",
        allowOutsideClick:false,
        timer:1200,
        didOpen:()=>{
            Swal.showLoading();
        }
    }).then(()=>{

        window.open(url, "_blank");

    });

});