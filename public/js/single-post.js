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
            is_featured: 0,
            allow_comments: 1,
        },
        manageLoading: false,
        uploadLoading: false,
        error: null,
        insertedData: '',
        searchTimeout: null,
        websiteUrl: new URL(window.location.href),
        postId: null,
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
            if(this.websiteUrl.pathname.split('/').pop() === 'new') {
                this.createPost()
            }else {
                this.updatePost()
            }
        },

        /* --- --- --- function of update api --- --- --- */
        updatePost() {
            this.ClearErrorHandler();
            this.manageLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            axios.put(`/api/front/posts/`+this.postId, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.manageLoading = false;
                    this.error = response.data.error
                } else {
                    this.manageLoading = false;
                    this.window.location.href = '/post';
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
            const id = this.websiteUrl.pathname.split('/').pop();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.get(`/api/front/posts/`+this.postId, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.manageLoading = false;
                    this.error = response.data.error
                } else {
                    this.manageLoading = false;
                    this.postParam = response?.data
                }
            }).catch(err => {
                this.manageLoading = false;
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
        categoryDropdown() {
            let userDropDownMenu = document.querySelector('#categoryDropdown #inserted-dropdown');
            userDropDownMenu.classList.toggle('hidden');
        },

    },
    mounted(){

        if(this.websiteUrl.pathname.split('/').pop() !== 'new') {
            this.postId = this.websiteUrl.pathname.split('/').pop();
            this.singlePost();
        }

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
