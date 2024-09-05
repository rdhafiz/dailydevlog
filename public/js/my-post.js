
const selectOption = document.getElementById("selectData");
const selectedStatus = window.location.search
selectOption.addEventListener("change", function() {
    document.getElementById("statusForm").submit();
});

if(selectedStatus === '?status=draft') {
    selectOption.value = 'draft';
}else if(selectedStatus === '?status=published') {
    selectOption.value = 'published';
}else if (selectedStatus === '?status=archived') {
    selectOption.value = 'archived'
}
