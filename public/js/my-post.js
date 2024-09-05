function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name) || '';
}

window.onload = function () {
    const keyword = getQueryParam('keyword');
    const status = getQueryParam('status');
    document.getElementById('searchKey').value = keyword;
    document.getElementById('selectData').value = status;
};

function setParams() {
    const keyword = document.getElementById('searchKey').value.trim();
    const status = document.getElementById('selectData').value;
    const params = new URLSearchParams();

    if (keyword) {
        params.append('keyword', keyword);
    }

    if (status) {
        params.append('status', status);
    }

    const queryString = params.toString();
    window.location.href = `/my-blogs?${queryString}`;
}

document.getElementById('searchDataForm').addEventListener('submit', function (event) {
    event.preventDefault();
    setParams();
});

document.getElementById('selectData').addEventListener('change', function (event) {
    setParams();
});
