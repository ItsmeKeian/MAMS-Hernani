$(function () {

    loadLogs();

});


function loadLogs() {

    $.get("../php/get_logs.php", function (res) {

        let data = JSON.parse(res);

        let html = "";

        data.forEach((r, i) => {

            html += `
                <tr>

                    <td>${i + 1}</td>
                    <td>${r.log_date}</td>
                    <td>${r.user}</td>
                    <td>${r.action}</td>
                    <td>${r.module}</td>
                    <td>${r.details}</td>

                </tr>
            `;

        });

        $("#logsTable tbody").html(html);

    });

}