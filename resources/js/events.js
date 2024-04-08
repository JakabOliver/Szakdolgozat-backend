import {fetchData} from "./fetchHelper.js";

const SELECTORS = {
    DATE_FROM: 'date_from',
    DATE_TO: 'date_to',
    EVENT: 'event',
    USER: 'user',
    LIMIT: 'limit',
    APPLY: 'apply-filter-button',
    EVENTS: 'events'
}


document.addEventListener("DOMContentLoaded", function (event) {
    init();
});


function init() {
    getData();
    document.getElementById(SELECTORS.APPLY).addEventListener('click', function () {
        getData();
    });
    document.getElementById(SELECTORS.LIMIT).addEventListener('input', function () {
        getData();
    });
}

function getData() {
    const filter = getFilterData();
    const limit = document.getElementById(SELECTORS.LIMIT).value;
    const sort = undefined;
    const link = '/event/list';
    const method = 'POST';
    const data = {filter, limit, sort};
    fetchData(link, method, data, buildData);
}


function getFilterData() {
    let data = {};
    data['date_from'] = document.getElementById(SELECTORS.DATE_FROM).value;
    data['date_to'] = document.getElementById(SELECTORS.DATE_TO).value;
    data['event'] = document.getElementById(SELECTORS.EVENT).value;
    data['user'] = document.getElementById(SELECTORS.USER).value;
    return data;
}

function buildData(data) {
    const events = data.events;
    const container = document.getElementById(SELECTORS.EVENTS);
    container.innerHTML = '';
    events.forEach(function (event) {
        // Create a new section element
        const section = document.createElement('section');
        section.classList.add('my-2', 'grid', 'grid-cols-4', 'gap-2');

        // Create and populate the divs inside the section
        const dateDiv = document.createElement('div');
        const dateLink = document.createElement('a');
        dateLink.href = `event/${event.id}`;
        dateLink.textContent = event.created_at;
        dateDiv.appendChild(dateLink);

        const eventDiv = document.createElement('div');
        eventDiv.textContent = event.name;

        const userDiv = document.createElement('div');
        const userLink = document.createElement('a');
        userLink.href = `user/${event.user_id}`;
        userLink.textContent = event.user_id;
        userDiv.appendChild(userLink);


        const countryDiv = document.createElement('div');
        countryDiv.textContent = event.country;

        // Append the divs to the section
        section.appendChild(dateDiv);
        section.appendChild(eventDiv);
        section.appendChild(userDiv);
        section.appendChild(countryDiv);

        // Append the section to the container
        container.appendChild(section);
    });
}
