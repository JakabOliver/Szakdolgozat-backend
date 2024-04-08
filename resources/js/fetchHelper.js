export function fetchData(link, method, data, callBack) {

    fetch(link, {
        method: method,
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        callBack(response);
    })
}
