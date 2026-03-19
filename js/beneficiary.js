$("#saveBeneficiary").click(function(){

    let formData = $("#beneficiaryForm").serialize();

    $.ajax({

        type: "POST",
        url: "php/create/create_beneficiary.php",
        data: formData,
        dataType: "json",

        success: function(res){

            console.log(res);

            if(res.status == 1){

                Swal.fire({
                    icon: "success",
                    title: "Saved!",
                    timer: 1200,
                    showConfirmButton: false
                }).then(() => {

                    window.location.href = "beneficiary.php";

                });

            }

        }

    });

});



$(function () {

    let currentPage = 1;
    let limit = 5;
    let maxVisible = 3;

    loadBeneficiary(currentPage);



    function loadBeneficiary(page = 1, search = "") {

        currentPage = page;

        $.ajax({

            type: "POST",
            url: "php/retrieve/retrieve_beneficiary.php",

            data: {
                page: page,
                limit: limit,
                search: search
            },

            dataType: "json",

            success: function (res) {

                let tbody = $("#beneficiaryTable tbody");

                tbody.empty();

                if (!res.data || res.data.length === 0) {

                    tbody.append(
                        "<tr><td colspan='9'>No records</td></tr>"
                    );

                    return;
                }


                // =========================
                // TABLE ROWS
                // =========================

                $.each(res.data, function (i, b) {

                    let f = b.last_name ? b.last_name.charAt(0) : "";
                    let l = b.first_name ? b.first_name.charAt(0) : "";

                    let initials = f + l;


                    tbody.append(`

                        <tr>

                        <td>

                            <div class="d-flex align-items-center">

                                <div
                                class="avatar bg-primary text-white rounded-circle
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
                        ${b.house_no} ${b.street} ${b.addr_barangay}
                        </td>

                        <td>${b.age}</td>

                        <td>${b.contact_number}</td>

                        <td>${b.occupation}</td>

                        <td>${b.ownership ?? ""}</td>

                        <td>${b.damage_classification ?? ""}</td>

                        <td>${b.date_registered}</td>

                        <td>

                            <button
                            class="btn btn-sm btn-info view"
                            data-id="${b.id}">
                            View
                            </button>

                        </td>

                        </tr>

                    `);

                });



                // =========================
                // RECORD COUNT
                // =========================

                let start = (page - 1) * limit + 1;
                let end = start + res.data.length - 1;

                $("#recordCount").text(
                    `Showing ${start} - ${end} of ${res.total}`
                );



                // =========================
                // PAGINATION SLIDING
                // =========================

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


                // window pages

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



    // =========================
    // CLICK PAGINATION
    // =========================

    $(document).on("click", ".page-link", function (e) {

        e.preventDefault();

        let page = $(this).data("page");

        if (!page) return;

        loadBeneficiary(page);

    });


});