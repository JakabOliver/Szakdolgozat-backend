import {fetchData} from "./fetchHelper.js";

const SELECTORS = {
    DATE_FROM: 'date_from',
    DATE_TO: 'date_to',
    PAGE: 'page',
    USER: 'user',
    LIMIT: 'limit',
    APPLY: 'apply-filter-button',
    VISITS: 'visits'
}


document.addEventListener("DOMContentLoaded", function (event) {
    init();
});

function getFilterData() {
    let data = {};
    data['date_from'] = document.getElementById(SELECTORS.DATE_FROM).value;
    data['date_to'] = document.getElementById(SELECTORS.DATE_TO).value;
    data['page'] = document.getElementById(SELECTORS.PAGE).value;
    data['user'] = document.getElementById(SELECTORS.USER).value;
    return data;
}

function buildData(data) {
    const visits = data.visits;
    const container = document.getElementById(SELECTORS.VISITS);
    container.innerHTML = '';
    visits.forEach(function (visit) {
        // Create a new section element
        const section = document.createElement('section');
        section.classList.add('my-2', 'grid', 'grid-cols-3', 'gap-2');

        // Create and populate the divs inside the section
        const dateDiv = document.createElement('div');
        dateDiv.textContent = visit.created_at;

        const pageDiv = document.createElement('div');
        pageDiv.textContent = visit.page;

        const userDiv = document.createElement('div');
        const userLink = document.createElement('a');
        userLink.href = `user/${visit.user_id}`; // Assuming the route is user/show/{user_id}
        userLink.textContent = visit.user_id;
        userDiv.appendChild(userLink);

        // Append the divs to the section
        section.appendChild(dateDiv);
        section.appendChild(pageDiv);
        section.appendChild(userDiv);

        // Append the section to the container
        container.appendChild(section);
    });
}

function getData() {
    const filter = getFilterData();
    const limit = document.getElementById(SELECTORS.LIMIT).value;
    const sort = undefined;
    const link = '/visit/list';
    const data ={filter, limit, sort};
    fetchData(link, 'POST', data, buildData);

}

function init() {
    getData()
    document.getElementById(SELECTORS.APPLY).addEventListener('click', function () {
        getData()
    });
    document.getElementById(SELECTORS.LIMIT).addEventListener('input', function () {
        getData()
    });
}
