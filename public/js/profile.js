new Vue({
    el: '#profile',
    data: {
        profileLoading: false,
        profileParam: {
            avatar: null,
            name: '',
            email: '',
            bio: '',
            website: '',
        },
        passwordParam: {
            current_password: '',
            password: '',
            password_confirmation: '',
        },
        profileUpdateLoading: false,
        changePasswordLoading: false,
        profileData: null,
        error: '',
        logoutLoading: false,
        msg: null,
        uploadLoading: false,
    },
    mounted() {
        this.profileDetails();
    },
    methods: {

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* --- --- --- function of profile details api --- --- --- */
        profileDetails() {
            this.ClearErrorHandler();
            this.profileLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/user/get-profile`, this.profileParam, {headers: headerContent}).then((response) => {
                const res = response?.data
                if(res.status === 200) {
                    this.loading = false;
                    this.profileData = res?.data
                    this.profileParam = JSON.parse(JSON.stringify(res?.data));
                } else {
                    this.loading = false;
                    this.error = res.data.error
                }
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of two word --- --- --- */
        nameControl() {
            if (this.profileData && this.profileData.name) {
                let fullName = this.profileData.name;
                let words = fullName.split(' ');
                let initials = ` ${words[0][0].toUpperCase()}${ words[words.length - 1][0].toUpperCase()}`;
                return initials;
            }
        },

        /* --- --- --- function of profile update api --- --- --- */
        profileUpdate() {
            let _this = this;
            this.ClearErrorHandler();
            this.profileUpdateLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            _this.msg = null;
            axios.post(`/api/front/user/update-profile`, this.profileParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.profileUpdateLoading = false;
                    this.error = response.data.error
                } else {
                    this.profileUpdateLoading = false;
                    this.profileDetails();
                    _this.msg = response?.data?.msg
                    setTimeout(function(){
                        _this.msg = null;
                    }, 3000);
                }
            }).catch(err => {
                this.profileUpdateLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of change password api --- --- --- */
        changePassword() {
            let _this = this;
            this.ClearErrorHandler();
            this.changePasswordLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            _this.msg = null;
            axios.post(`/api/front/user/change-password`, this.passwordParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.changePasswordLoading = false;
                    this.error = response.data.error
                } else {
                    this.msg = response?.data?.msg
                    this.changePasswordLoading = false;
                    _this.msg = response?.data?.msg
                    setTimeout(function(){
                        _this.msg = null;
                    }, 3000);
                    this.passwordParam = {
                        current_password: '',
                        password: '',
                        password_confirmation: '',
                    }
                }
            }).catch(err => {
                this.changePasswordLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of logout api --- --- --- */
        logout() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.logoutLoading = true;
            this.error = null;
            axios.post(`/api/front/user/logout`, '', {headers: headerContent}).then((response) => {
                this.logoutLoading = false;
                window.location.href = '/login'
            }).catch(err => {
                this.changePasswordLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of update avatar api --- --- --- */
        updateAvatar() {
            let _this = this;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            _this.msg = null;
            axios.post(`/api/front/user/update-avatar`, this.profileParam, {headers: headerContent}).then((response) => {
                if(response.data.status === 200) {
                    this.uploadLoading = false;
                    this.msg = response?.data?.msg;
                    _this.msg = response?.data?.msg;
                    setTimeout(function(){
                        _this.msg = null;
                        console.log(3)
                    }, 3000);
                }
            }).catch(err => {
                this.uploadLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* F */
        deleteAvatar(event) {
            this.uploadLoading = true;
            this.profileParam.avatar = null
            this.updateAvatar()
        },

        /* --- --- --- function of attach file api --- --- --- */
        uploadFile(event) {
            let headerContent = {
                'Content-Type': 'multipart/form-data',
            }
            this.uploadLoading = true;
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file)
            axios.post(`/api/front/media`, formData, {headers: headerContent}).then((response) => {
                if (response) {
                    this.profileParam.avatar = response?.data?.filename
                    this.updateAvatar();
                } else {
                    this.error = response?.data?.errors
                }
            })
        },

    },
})
