$(function () {

    loadDashboard();

});


function loadDashboard() {

    $.ajax({

        url: "../php/dashboard_data.php",
        type: "GET",
        dataType: "json",

        success: function (res) {

            $("#totalBen").text(res.totalBen);
            $("#totalAid").text(res.totalAid);
            $("#totalQty").text(res.totalQty);
            $("#totalCost").text(res.totalCost);

            loadChart(res);

        }

    });

}



function loadChart(res) {

    // =========================
    // BRGY CHART
    // =========================

    new Chart(
        document.getElementById("brgyChart"),
        {
            type: "bar",

            data: {

                labels: res.brgyLabels,

                datasets: [{

                    label: "Beneficiaries",

                    data: res.brgyData,

                    backgroundColor: "#2563eb",
                    borderRadius: 8,
                    barThickness: 40

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: { display: false }
                },

                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }

            }

        }
    );


    // =========================
    // MONTH CHART
    // =========================

    new Chart(
        document.getElementById("monthChart"),
        {
            type: "line",

            data: {

                labels: res.monthLabels,

                datasets: [{

                    label: "Aid per Month",

                    data: res.monthData,

                    borderColor: "#16a34a",
                    backgroundColor: "rgba(22,163,74,0.2)",
                    tension: 0.4,
                    fill: true

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false

            }

        }
    );



    // =========================
    // ITEMS CHART
    // =========================

    new Chart(
        document.getElementById("itemsChart"),
        {
            type: "pie",

            data: {

                labels: res.itemLabels,

                datasets: [{

                    data: res.itemData,

                    backgroundColor: [
                        "#2563eb",
                        "#16a34a",
                        "#f59e0b",
                        "#ef4444",
                        "#9333ea"
                    ]

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false

            }

        }
    );



    // =========================
// DISASTER CHART
// =========================

new Chart(
    document.getElementById("disasterChart"),
    {
        type: "bar",

        data: {

            labels: res.disasterLabels,

            datasets: [{

                label: "Disaster",

                data: res.disasterData,

                backgroundColor: "#ef4444",
                borderRadius: 8,
                barThickness: 40

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: { display: false }
            }

        }

    }
);


}