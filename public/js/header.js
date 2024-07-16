/* Function of search dropdown */
function searchDropdown() {
    let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
    searchDropDownMenu.classList.toggle('hidden');
    let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
    dropDownMenu.classList.add('hidden');
}

/* Function of mode dropdown */
function modeDropdown() {
    let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
    dropDownMenu.classList.toggle('hidden');
    let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
    searchDropDownMenu.classList.add('hidden');
}

/* Function of scrolling header */

function onscroll() {
    if (window.scrollY > 50) {
        document.querySelector('.header').classList.add('border-effect');
    } else {
        document.querySelector('.header').classList.remove('border-effect');
    }
}

window.addEventListener('scroll', onscroll)
