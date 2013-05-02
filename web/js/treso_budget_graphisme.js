$(function () {
    var chart_debit;
    var title_budget = document.getElementById('title_budget');
    $(document).ready(function () {
        // Build the chart
        chart_debit = new Highcharts.Chart({
            chart: {
                renderTo: 'graphe_depense',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                width: 450,
                hight: 450,
            },
            title: {
                text: title_budget.innerHTML+' Dépense'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 2
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Répartition Catégories Budget',
                data: _data_debit
            }]
        });
    });
});

$(function () {
    var chart_credit;
    var title_budget = document.getElementById('title_budget');
    $(document).ready(function () {
        // Build the chart
        chart_credit = new Highcharts.Chart({
            chart: {
                renderTo: 'graphe_recette',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                width: 450,
                hight: 450,
            },
            title: {
                text: title_budget.innerHTML+" Recette"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Répartition Catégories Budget Recette',
                data: _data_credit
            }]
        });
    });
});