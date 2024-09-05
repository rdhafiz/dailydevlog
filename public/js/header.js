// function for getQueryParams
function getQueryParams(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name) || '';
}

window.onload = function () {
    const keyword = getQueryParams('keyword');
    const text = document.getElementById('global-data-show');
    if(text) {
        text.innerText = keyword
    }
};

/*function to search data*/
function searchData(){
    const globalSearchParam = document.getElementById('keyword');
    const params = new URLSearchParams();
    params.append('keyword', globalSearchParam.value.trim());
    const queryString = params.toString();
    const origin = new URL(window.location.href).origin;
    window.location.href = `${origin}/search-blogs?${queryString}`;
}

document.getElementById('globalSearchForm').addEventListener('submit', function (event) {
    event.preventDefault();
    searchData();
});

// function of toggle menu
let menuShow = false;
function toggleMenu() {
    const menu = document.getElementById('menu');
    if (!menuShow) {
        // If menuShow is true, apply the "visible" styles
        menu.classList.add('left-0', 'z-[9999]');
        menu.classList.remove('left-[-100%]', '-z-[10]');
    } else {
        // If menuShow is false, apply the "hidden" styles
        menu.classList.add('left-[-100%]', '-z-[10]');
        menu.classList.remove('left-0', 'z-[9999]');
    }
    menuShow = !menuShow;
}

/* Function of search dropdown */
function searchDropdown() {
    let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
    if(searchDropDownMenu) {
        searchDropDownMenu.classList.toggle('hidden');
    }
    let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
    if(dropDownMenu) {
        dropDownMenu.classList.add('hidden');
    }
    let userDropDownMenu = document.querySelector('#user-menu #user-dropdown');
    if(userDropDownMenu) {
        userDropDownMenu.classList.add('hidden');
    }
}

/* Function of mode dropdown */
function userDropdown() {
    let userDropDownMenu = document.querySelector('#user-menu #user-dropdown');
    if(userDropDownMenu) {
        userDropDownMenu.classList.toggle('hidden');
    }
    let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
    if(dropDownMenu) {
        dropDownMenu.classList.add('hidden');
    }
    let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
    if(searchDropDownMenu) {
        searchDropDownMenu.classList.add('hidden');
    }
}

/* Function of scrolling header */
function onscroll() {
    const header = document.querySelector('.header');
    if(header){
        if (window.scrollY > 100) {
            header.classList.add('border-effect');
        } else {
            header.classList.remove('border-effect');
        }
    }
}

window.addEventListener('scroll', onscroll)

window.addEventListener('mouseup', (e) => {

    /*hide search container*/
    const searchBtn = document.querySelector('#searchBtn');
    const searchDropDown = document.querySelector('#search-dropdown');
    if(searchBtn && searchDropDown) {
        if (!searchBtn.contains(e.target) && !searchDropDown.contains(e.target)) {
            searchDropDown.classList.add('hidden');
        }
    }

    /*hide theme container*/
    const userBtn = document.querySelector('#userToggle');
    const userDropDown = document.querySelector('#user-dropdown');
    if(userBtn && userDropDown) {
        if (!userBtn.contains(e.target) && !userDropDown.contains(e.target)) {
            userDropDown.classList.add('hidden');
        }
    }
})
