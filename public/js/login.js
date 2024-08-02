new Vue({
    el: '#login',
    data: {
        loading: false,
        loginParam: {
            email: '',
            password: '',
            remember: '',
        },
        error: '',
        logoutLoading:false,
    },
    mounted() {  },
    methods: {

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* --- --- --- function of login api --- --- --- */
        login() {
            this.ClearErrorHandler();
            this.loading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/auth/login`, this.loginParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.loading = false;
                    this.error = response.data.error
                } else {
                    this.loading = false;
                    window.location.href = `/blogs`;
                    this.loginParam = {
                        email: '',
                        password: '',
                        remember: '',
                    };
                }
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

    },
})
