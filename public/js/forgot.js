new Vue({
    el: '#forgot',
    data: {
        tab: 'forgot',
        forgotLoading: false,
        resetLoading: false,
        forgetParam: {
            email: '',
        },
        resetParam: {
            email: '',
            code: '',
            password: '',
            password_confirmation: '',
        },
        error: '',
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
        forgot() {
            this.ClearErrorHandler();
            this.forgotLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/auth/forgot`, this.forgetParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.forgotLoading = false;
                    this.error = response.data.error
                } else {
                    this.forgotLoading = false;
                    this.tab = 'reset'
                    this.resetParam = this.forgetParam
                }
            }).catch(err => {
                this.forgotLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of login api --- --- --- */
        reset() {
            this.ClearErrorHandler();
            this.resetLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/auth/reset`, this.resetParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.resetLoading = false;
                    this.error = response.data.error
                } else {
                    this.resetLoading = false;
                    window.location.href = `/login`;
                    this.resetParam = {
                        email: '',
                        code: '',
                        password: '',
                        password_confirmation: '',
                    };
                }
            }).catch(err => {
                this.resetLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

    },
})
