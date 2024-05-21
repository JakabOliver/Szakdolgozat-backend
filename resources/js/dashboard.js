import {Chart, registerables} from 'chart.js';
import {fetchData} from "./fetchHelper.js";

Chart.register(...registerables);
const charts = {
    'requests': null,
    'events': null
}

document.addEventListener('DOMContentLoaded', (event) => {
    const requestChartOptions = document.querySelectorAll('.requests-chart .selectors .option');
    const eventsChartOptions = document.querySelectorAll('.events-chart .selectors .option');

    requestChartOptions.forEach((element)  =>  {
        element.addEventListener('click', requestChartOptionClicked.bind(null, requestChartOptions));
    });
    eventsChartOptions.forEach((element) => {
        element.addEventListener('click', eventChartOptionClicked.bind(null, eventsChartOptions));
    });
    init();
});


function init() {
    loadRequests();
    loadEvents();
}

const requestChartOptionClicked = (requestChartOptions, event) => {
    requestChartOptions.forEach((el) => el.classList.remove('active'));
    event.target.classList.add('active');
    const range = event.target.getAttribute('data-value');
    loadRequests(range);
};

const eventChartOptionClicked = (eventsChartOptions, event) => {
    eventsChartOptions.forEach((el) => el.classList.remove('active'));
    event.target.classList.add('active');
    const range = event.target.getAttribute('data-value');
    loadEvents(range);
};

const loadRequests = (range = 7) => {
    const url = '/dashboard/chart/requests/' + range;
    fetchData(url, 'GET', null, drawRequestsChart);
};
const loadEvents = (range = 1) => {
    const url = '/dashboard/chart/events/' + range;
    fetchData(url, 'GET', null, drawEventsChart);
};

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

    charts.requests = drawChart(ctx, charts.requests, 'line', data);
}


function drawEventsChart(input) {
    const ctx = document.getElementById('events');
    const data = getEmptyDataSetForChart();
    data.datasets[0].label = 'Event counts in the past month';
    input.forEach((element) => {
        data.labels.push(element.name);
        data.datasets[0].data.push(element.count);
    });

    charts.events = drawChart(ctx, charts.events, 'bar', data);
}

function drawChart(ctx, chart, type, data) {
    if (chart !== null) chart.destroy();
    return new Chart(ctx, {
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
