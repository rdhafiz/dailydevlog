new Vue({
    el: '#categories',
    data: {
        categoryParam: {
            id: '',
            name: '',
            slug: '',
            description: '',
            icon: null,
            parent_id: ''
        },
        singleLoading: false,
        manageLoading: false,
        uploadLoading: false,
        error: null,
        searchTimeout: null,
        websiteUrl: new URL(window.location.href),

        tableData: [],
        deleteLoading: false,
        formData: {
            keyword: '',
            limit: 20,
            page: 1,
            sort_mode: ''
        },
        total_pages: 0,
        current_page: 0,
        buttons: [],
        last_page: 0,
        loading: false,
        msg: null
    },
    methods: {

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* Function of search list data */
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.listCategory();
            }, 800);
        },

        /* --- --- --- function of list category api --- --- --- */
        listCategory() {
            this.loading = true;
            this.msg = null;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.formData.page = this.current_page;
            axios.get(`/api/front/categories`, {params: this.formData}, {headers: headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.tableData = res.data;
                this.tableData.forEach(each => {
                    each.deleteLoading = false;
                })
                this.last_page = res.last_page;
                this.total_pages = res.total < res.per_page ? 1 : Math.ceil((res.total / res.per_page))
                this.current_page = res.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map(i => i + 1);
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
            })
        },

        /* --- --- --- manage categories api --- --- --- */
        manageCategory() {
            this.manageLoading = true;
            if(!this.categoryParam.id) {
                this.createCategory()
            }else {
                this.updateCategory()
            }
        },

        /* --- --- --- function of update api --- --- --- */
        updateCategory() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.put(`/api/front/categories/`+this.categoryParam.id, this.categoryParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.error = response.data.error
                } else {
                    window.location.href = '/categories';
                }
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            }).finally(()=> {
                this.manageLoading = false;
            })
        },

        /* --- --- --- function of create api --- --- --- */
        createCategory() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/categories`, this.categoryParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.error = response.data.error
                } else {
                    window.location.href="/categories";
                }
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            }).finally(()=> {
                this.archiveLoading = false;
                this.draftLoading = false;
                this.publishLoading = false;
            });
        },

        /* --- --- --- function of single post api --- --- --- */
        singleCategory() {
            this.singleLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.get(`/api/front/categories/`+this.categoryParam.id, this.categoryParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.singleLoading = false;
                    this.error = response.data.error;
                } else {
                    this.categoryParam = response?.data;
                }
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            }).finally(()=> {
                this.singleLoading = false;
            });
        },

        /* Function of search list data */
        deleteCategory(data, index) {
            let _this = this;
            data.deleteLoading = true;
            this.$set(this.tableData, index, data);
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            _this.msg = null;
            setTimeout(()=> {
                axios.delete(`/api/front/categories/`+data.id, null, {headers: headerContent}).then((response) => {
                    if (response.data.error) {
                        this.error = response.data.error
                    } else {
                        this.listCategory();
                        this.msg = response?.data?.message;
                        setTimeout(function(){
                            _this.msg = null;
                        }, 3000);
                    }
                }).catch(err => {
                    data.deleteLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        this.error = res?.data?.errors;
                    }
                });
            }, 3000)
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
                this.uploadLoading = false
                if (response) {
                    this.categoryParam.icon = response?.data?.filename
                } else {
                    this.error = response?.data?.errors
                }
            })
        },

    },
    mounted(){
        const param = this.websiteUrl.pathname.split('/').pop();
        if(param !== 'categories'){
            if(param !== 'new'){
                this.categoryParam.id = param;
                this.singleCategory();
            }else {
                this.categoryParam.id = '';
            }
        }

        this.listCategory();
    }
})
