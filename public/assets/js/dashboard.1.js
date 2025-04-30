$(function() {
    "use strict";

    // Ensure the canvas element exists
    var ctx = document.getElementById("sales-graph-top");
    if (ctx) {
        // Set height of the canvas element directly
        ctx.height = 100;

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                datasets: [{
                    label: "Income",
                    data: [28, 35, 36, 48, 46, 42, 60],
                    backgroundColor: "rgba(110, 211, 207, 0.12)",
                    borderColor: "#6ed3cf",
                    borderWidth: 3,
                    strokeColor: "#6ed3cf",
                    capBezierPoints: true,
                    pointColor: "#fff",
                    pointBorderColor: "#6ed3cf",
                    pointBackgroundColor: "#FFF",
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverBackgroundColor: "#FFF",
                    pointHoverBorderColor: "#6ed3cf",
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    titleFontSize: 16,
                    titleFontColor: '#000',
                    bodyFontColor: '#000',
                    backgroundColor: '#fff',
                    cornerRadius: 3,
                    intersect: false,
                },
                legend: {
                    display: false,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                    },
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },
                title: {
                    display: false,
                }
            }
        });
    } else {
        console.error("Element #sales-graph-top not found!");
    }
});
