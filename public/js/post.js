new Vue({
    el: '#post',
    data: {
        postParam: {
            title: '',
            slug: '',
            content: '',
            featured_image: null,
            category: 'category',
            status: 'draft',
            meta_title: '',
            meta_description: '',
            is_featured: false,
            allow_comments: true,
        },
        tableData: [],
        deleteParam: {
            id: '',
        },
        deleteLoading: false,
        formData: {
            keyword: '',
            limit: 20,
            page: 1,
        },
        total_pages: 0,
        current_page: 0,
        buttons: [],
        last_page: 0,
        loading: false,
        manageLoading: false,
        uploadLoading: false,
        error: null,
        insertedData: '',
        searchTimeout: null,
    },
    methods: {

        /* Function of action dropdown */
        actionDropdown() {
            let actionDropDownMenu = document.querySelector('#action-menu #action-dropdown');
            actionDropDownMenu.classList.toggle('hidden');
        },

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* --- --- --- manage post api --- --- --- */ 
        managePost() {
                this.createPost()
        },

        /* --- --- --- function of update api --- --- --- */ 
        updatePost() {
            this.ClearErrorHandler();
            this.manageLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.patch(`/api/front/posts`, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.manageLoading = false;
                    this.error = response.data.error
                } else {
                    this.manageLoading = false;
                }
            }).catch(err => {
                this.manageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of create api --- --- --- */
        createPost() {
            this.ClearErrorHandler();
            this.manageLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.post(`/api/front/posts`, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.manageLoading = false;
                    this.error = response.data.error
                } else {
                    this.manageLoading = false;
                    window.location.href="/post";
                }
            }).catch(err => {
                this.manageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },
        
        /* --- --- --- function of single post api --- --- --- */ 
        singlePost() {
            axios.put(`/api/front/posts/`+postParam.id, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.manageLoading = false;
                    this.error = response.data.error
                } else {
                    this.manageLoading = false;
                }
            }).catch(err => {
                this.manageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of list post api --- --- --- */ 
        listPost() {
            this.loading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.tableData.page = this.current_page;
            axios.get(`/api/front/posts`, {params: this.tableData}, {headers: headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.tableData = res?.data
                this.last_page = res?.data?.last_page
                this.total_pages = res?.data?.total < res.resources.per_page ? 1 : Math.ceil((res.resources.total / res.resources.per_page));
                this.current_page = res?.data?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                }
            })
        },
        
        /* Function of search list data */ 
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.listPost();
            }, 800);
        },

        /* Function of search list data */ 
        deletePost(id) {
            this.ClearErrorHandler();
            this.deleteLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.delete(`/api/front/posts/`+id, null, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.deleteLoading = false;
                    this.error = response.data.error
                } else {
                    this.deleteLoading = false;
                    this.listPost();
                }
            }).catch(err => {
                this.deleteLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
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
                    this.postParam.featured_image = response?.data?.filename
                } else {
                    this.error = res.errors
                }
            })
        },

        /* Function of insert data */
        insertData(event) {
            this.insertedData = event.target.innerText
        },

        /* Function of category dropdown */
        categpryDropdown() {
            let userDropDownMenu = document.querySelector('#categoryDropdown #inserted-dropdown');
            userDropDownMenu.classList.toggle('hidden');
        },

    },
    mounted(){

        if(this.postParam.id !== undefined) {
            this.singlePost();
        }
        
        this.listPost();

        window.addEventListener('mouseup', (e) => {

            /*hide action content*/
            const actionBtn = document.querySelector('#actionToggle');
            const actionDropDown = document.querySelector('#action-dropdown');
            if(actionBtn && actionDropDown) {
                if (!actionBtn.contains(e.target) && !actionDropDown.contains(e.target)) {
                    actionDropDown.classList.add('hidden');
                }
            }

            /*hide action content*/
            const categoryBtn = document.querySelector('#insertToggle');
            const categoryDropDown = document.querySelector('#inserted-dropdown');
            if(categoryBtn && categoryDropDown) {
                if (!categoryBtn.contains(e.target) && !categoryDropDown.contains(e.target)) {
                    categoryDropDown.classList.add('hidden');
                }
            }
        })
        
    }
})