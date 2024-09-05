new Vue({
    el: '#header',
    data: {
        logoutLoading: false,
        profileData: null,
        menuShow: false,
        formData: {
            keyword: '',
            page: 1,
            status: 'published'
        }
    },
    methods: {

        /*function to search data*/
        searchData(){
            const params = new URLSearchParams();
            params.append('keyword', this.formData.keyword);
            const queryString = params.toString();
            const origin = new URL(window.location.href).origin;
            const url = `${origin}/search-blogs?${queryString}`;
            window.location.href = url;
        },

        /* Function of search dropdown */
        searchDropdown() {
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
        },

        /* Function of mode dropdown */
        userDropdown() {
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
        },

        /* Function of toggle menu */
        toggleMenu() {
            this.menuShow = !this.menuShow;
        },

        /* --- --- --- function of logout api --- --- --- */
        logout() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.logoutLoading = true;
            axios.post(`/api/front/user/logout`, '', {headers: headerContent}).then((response) => {
                this.logoutLoading = false;
                window.location.href = '/login'
            }).catch(err => {
                this.logoutLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of profile details api --- --- --- */
        profileDetails() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.post(`/api/front/user/get-profile`, this.profileParam, {headers: headerContent}).then((response) => {
                const res = response?.data
                if(res.status === 200) {
                    this.profileData = res?.data
                }
            })
        },

        /* --- --- --- function of two word --- --- --- */
        // Function of name control
        nameControl() {
            if (this.profileData && this.profileData.name) {
                let fullName = this.profileData.name;
                let words = fullName.split(' ');
                let initials = ` ${words[0][0].toUpperCase()}${ words[words.length - 1][0].toUpperCase()}`;
                return initials;
            }
        },

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },


        /* Function of scrolling header */

         onscroll() {
             const header = document.querySelector('.header');
             if(header){
                 if (window.scrollY > 100) {
                     header.classList.add('border-effect');
                 } else {
                     header.classList.remove('border-effect');
                 }
             }

        }
    },
    mounted(){
        window.addEventListener('scroll', this.onscroll)

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
    }
})
