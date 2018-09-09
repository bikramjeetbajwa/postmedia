$(document).ready(function() {
    getRecentCalls();
    getTotalCalls();
    function getRecentCalls(){
        $("#chartLast10Days").kendoChart({
            dataSource: {
                transport: {
                    read: {
                        url: "<?= base_url('services/service_calls/get_recent_calls'); ?>",
                        dataType: "json"
                    }
                },
                schema      : {
                    data : function(response){
                        return response.data;
                    }
                },
            },
            title: {
                position: "top",
                text: "Calls in last 10 days",
                color: '#780141'
            },
            legend: {
                position: "bottom"
            },
            chartArea: {
                background: ""
            },
            seriesDefaults: {
                type: "column"
            },
            seriesColors: ['#780141','#52be80','#e74c3c','#f4d03f','#bb8fce','#2e86c1'],
            series: [{
                field: 'CALL_COUNT',
                categoryField: 'CALL_DATE_LABEL',
                name: '# Calls '
            }],
            valueAxis: {
                labels: {
                    format: "{0}"
                },
                line: {
                    visible: true
                },
                axisCrossingValue: 0
            },
            tooltip: {
                visible: true,
                //format: "{0}%",
                template: "#= series.name #: #= value #"
            }
        });

    }
    function getTotalCalls() {
        $("#chartTotalCalls").kendoChart({
            dataSource: {
                transport: {
                    read: {
                        url: "<?= base_url('services/service_calls/get_total_calls'); ?>",
                        dataType: "json"
                    }
                },
                schema      : {
                    data : function(response){
                        return response.data;
                    }
                },
            },
            title: {
                position: "top",
                text: "Open / Completed calls in last 10 days",
                color: '#780141'
            },
            legend: {
                visible: false
            },
            chartArea: {
                background: ""
            },
            seriesDefaults: {
                labels: {
                    visible: true,
                    background: "transparent",
                    template: "#= category #: \n #= value#"
                }
            },
            seriesColors: ['#102a61', '#808b96','#e74c3c','#f4d03f','#bb8fce','#2e86c1'],
            series: [{
                type: "pie",
                startAngle: 150,
                field: 'COUNT_CALLS',
                categoryField: 'NAME'
            }],
            tooltip: {
                visible: true,
                //format: "{0}%",
                template: "#= category #: #= value #"
            }
        });
    }
});