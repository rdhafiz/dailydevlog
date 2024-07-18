new Vue({
    el: '#header',
    data: {

    },
    methods: {
        /* Function of search dropdown */
        searchDropdown() {
            let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
            searchDropDownMenu.classList.toggle('hidden');
            let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
            dropDownMenu.classList.add('hidden');
        },

        /* Function of mode dropdown */
         modeDropdown() {
            let dropDownMenu = document.querySelector('#dropdown-menu #dropdown');
            dropDownMenu.classList.toggle('hidden');
            let searchDropDownMenu = document.querySelector('#search-dropdown-menu #search-dropdown');
            searchDropDownMenu.classList.add('hidden');
        },

        /* Function of scrolling header */

         onscroll() {
            if (window.scrollY > 50) {
                document.querySelector('.header').classList.add('border-effect');
            } else {
                document.querySelector('.header').classList.remove('border-effect');
            }
        }
    },
    mounted(){
        window.addEventListener('scroll', this.onscroll)

        window.addEventListener('mouseup', (e) => {

            /*hide search container*/
            const searchBtn = document.querySelector('#searchBtn');
            const searchDropDown = document.querySelector('#search-dropdown');
            if (!searchBtn.contains(e.target) && !searchDropDown.contains(e.target)) {
                searchDropDown.classList.add('hidden');
            }

            /*hide theme container*/
            const themeSwitch = document.querySelector('#themeSwitch');
            const dropDown = document.querySelector('#dropdown');
            if (!themeSwitch.contains(e.target) && !dropDown.contains(e.target)) {
                dropDown.classList.add('hidden');
            }
        })
    }
})
