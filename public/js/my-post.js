const selectOption = document.getElementById("selectData");
const searchLocation = window.location.search
selectOption.addEventListener("change", function() {
    document.getElementById("statusForm").submit();
});

if(searchLocation === '?status=draft') {
    selectOption.value = 'draft';
}else if(searchLocation === '?status=published') {
    selectOption.value = 'published';
}else if (searchLocation === '?status=archived') {
    selectOption.value = 'archived'
}
