let currentPage = 1;
let limit = 5;
let maxVisible = 3;

function loadLogs(
    page = 1,
    search = ""
) {

    currentPage = page;

    $.ajax({

        type: "POST",

        url: "../php/retrieve/retrieve_logs.php",

        data: {
            page: page,
            limit: limit,
            search: search
        },

        dataType: "json",

        success: function (res) {

            let tbody = $("#logsTable tbody");

            tbody.empty();


            if (!res.data || res.data.length == 0) {

                tbody.append(
                    "<tr><td colspan='6'>No records</td></tr>"
                );

                return;
            }


            // rows

            $.each(res.data, function (i, log) {

                tbody.append(`

                    <tr>

                       
                        <td>${log.log_date}</td>
                        <td>${log.user}</td>
                        <td>${log.action}</td>
                        <td>${log.module}</td>
                        <td>${log.details}</td>

                    </tr>

                `);

            });


            // count

            let start = (page - 1) * limit + 1;
            let end = start + res.data.length - 1;

            $("#recordCount").text(
                `Showing ${start} - ${end} of ${res.total}`
            );


            // pagination

            let totalPages = Math.ceil(res.total / limit);

            let pagination = $(".pagination");

            pagination.empty();


            // prev

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


            // next

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


// click page

$(document).on(
    "click",
    ".page-link",
    function (e) {

        e.preventDefault();

        let page = $(this).data("page");

        loadLogs(page);

    }
);


// first load

loadLogs();