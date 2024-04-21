export function fetchData(link, method, data, callBack) {
    let bodyData;
    if (data) {
        bodyData = JSON.stringify(data);
    } else {
        bodyData = undefined;
    }
    fetch(link, {
        method: method,
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body:  bodyData
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        callBack(response);
    })
}
