jQuery(function ($) {
    var ctx = document.getElementById('earning_chart').getContext('2d');
    window.myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: earning_chart_data,
        options: {
            responsive: true,
            title: {
                display: false,
            },
            scales: {
                xAxes: [{
                    stacked: true,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: dashboard.x_label
                    }
                }],
                yAxes: [{
                    stacked: true,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: dashboard.y_label
                    },
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += tooltipItem.yLabel + dashboard.currency_main;
                        return label;
                    }
                }
            }
        }
    });
    var start = moment(dashboard.from);
    var end = moment(dashboard.to);

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#reportrange input[name=from]').val(start.format('YYYY-MM-DD'));
        $('#reportrange input[name=to]').val(end.format('YYYY-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        "alwaysShowCalendars": true,
        "opens": "center",
        "showDropdowns": true,
        ranges: dashboard.ranges
}, cb).on('apply.daterangepicker', function (ev, picker) {
        $('#reportrange input[name=from]').val(picker.startDate.format('YYYY-MM-DD'));
        $('#reportrange input[name=to]').val(picker.endDate.format('YYYY-MM-DD'));
        $('#reportrange').closest('form').submit();
    });
    cb(start, end);
})
