function sendSignLocation(element) {
    if (!element.dataset.value) {
        var xhr = new XMLHttpRequest();

        var body = 'x='+element.dataset.x+'&y='+element.dataset.y;
        xhr.open("POST", '/', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);

        successHandler(xhr);
    }
}
function clearBoard(element) {

        var xhr = new XMLHttpRequest();

        xhr.open("GET", '/?clear=true', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send();
        successHandler(xhr);

}

function successHandler(xhr) {
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            document.body.innerHTML = xhr.responseText;
        }
    };
}
