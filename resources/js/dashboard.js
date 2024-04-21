import {Chart, registerables} from 'chart.js';
import {fetchData} from "./fetchHelper.js";

Chart.register(...registerables);

document.addEventListener("DOMContentLoaded", function (event) {
    init();
});


function init() {
    fetchData('/dashboard/chart/requests', 'GET', null, drawRequestsChart);
    fetchData('/dashboard/chart/events', 'GET', null, drawEventsChart);
}

function log(data) {
    console.log(data);
}


function drawRequestsChart(input) {
    const ctx = document.getElementById('requests');
    const data = getEmptyDataSetForChart();
    data.datasets[0].label = 'requests in the past seven days';
    input.forEach((element) => {
        data.labels.push(element.date);
        data.datasets[0].data.push(element.count);
    });

    drawChart(ctx, 'line', data);
}


function drawEventsChart(input) {
    const ctx = document.getElementById('events');
    const data = getEmptyDataSetForChart();
    data.datasets[0].label = 'Event counts in the past month';
    input.forEach((element) => {
        data.labels.push(element.name);
        data.datasets[0].data.push(element.count);
    });

    drawChart(ctx, 'bar', data);
}

function drawChart(ctx, type, data) {
    new Chart(ctx, {
        type: type,
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


function getEmptyDataSetForChart() {
    return {
        labels: [],
        datasets: [{
            label: '',
            data: [],
        }]
    };
}
