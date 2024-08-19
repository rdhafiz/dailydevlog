new Vue({
    el: '#post',
    data: {
        postParam: {
            title: '',
            slug: '',
            content: '',
            featured_image: null,
            category: '',
            status: 'draft',
            is_featured: 0,
            allow_comments: 1,
        },
        singleLoading: false,
        archiveLoading: false,
        draftLoading: false,
        publishLoading: false,
        uploadLoading: false,
        error: null,
        tagsSelect2: null,
        insertedData: '',
        searchTimeout: null,
        websiteUrl: new URL(window.location.href),
        postId: null,
        tagsLoading: false,
        categoryData: [],
        categories: [],
        categoryIds: [],
        tags: [],
        richTextEditor: null
    },
    methods: {

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* --- --- --- featured value change --- --- --- */
        changeIsFeatured(event) {
            if(event.target.checked){
                this.postParam.is_featured = 1;
            }else{
                this.postParam.is_featured = 0;
            }
        },

        /* --- --- --- comment value change --- --- --- */
        changeAllowComments(event) {
            if(event.target.checked){
                this.postParam.allow_comments = 1;
            }else{
                this.postParam.allow_comments = 0;
            }
        },

        /* --- --- --- manage post api --- --- --- */
        managePost(status) {
            if(status == 'archived'){
                this.postParam.status = 'archived';
                this.archiveLoading = true;
            }else if (status == 'draft') {
                this.postParam.status = 'draft';
                this.draftLoading = true;
            }else {
                this.postParam.status = 'published';
                this.publishLoading = true;
            }
            if(!this.postParam.id) {
                this.createPost()
            }else {
                this.updatePost()
            }
        },

        /* --- --- --- function of update api --- --- --- */
        updatePost() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            this.postParam.content = document.getElementById('content_description').value;
            if(typeof this.postParam.tags !== 'string'){
                this.postParam.tags = this.postParam.tags.join('')
            }
             setTimeout(()=> {
                 axios.put(`/api/front/posts/`+this.postParam.id, this.postParam, {headers: headerContent}).then((response) => {
                     if (response.data.error) {
                         this.error = response.data.error
                     } else {
                         window.location.href = '/blogs';
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
                 })
             }, 500)
        },

        /* --- --- --- function of create api --- --- --- */
        createPost() {
            this.ClearErrorHandler();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.error = null;
            this.postParam.content = document.getElementById('content_description').value;
            axios.post(`/api/front/posts`, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.error = response.data.error
                } else {
                    window.location.href="/blogs";
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
        singlePost() {
            this.singleLoading = true;
            this.richTextEditor = new RichTextEditor("#content_description", {height: 300});
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.get(`/api/front/posts/`+this.postParam.id, this.postParam, {headers: headerContent}).then((response) => {
                if (response.data.error) {
                    this.singleLoading = false;
                    this.error = response.data.error;
                } else {
                    this.postParam = response?.data
                    this.postParam.tags = response?.data?.tags.split(',');
                    if(this.postParam.is_featured == 1){
                        $('#is_featured').prop('checked', true);
                    }else{
                        $('#is_featured').prop('checked', false);
                    }
                    if(this.postParam.allow_comments == 1){
                        $('#comment').prop('checked', true);
                    }else{
                        $('#comment').prop('checked', false);
                    }
                    console.log(this.postParam.tags)
                    this.richTextEditor.setHTMLCode(this.postParam.content)
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

        /* Function of tags list */
        listTags() {
            this.tagsLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            let _this = this;
            axios.get(`/api/front/tags`, {headers: headerContent}).then((response) => {
                this.tags = response?.data?.data;
                console.log(this.tags)
                setTimeout(() => {
                    this.tagsSelect2 = $('#selectTag').select2({
                        dropdownParent: $('#selectTagParent'),
                        tags: true,
                        placeholder: 'Select Tag',
                        allowClear: true,
                    });
                    this.tagsSelect2.on('change', function () {
                        _this.postParam.tags = $(this).val().join(',');
                        console.log($(this).val())
                    });
                }, 500)
            })
        },

    },
    mounted(){
        const param = this.websiteUrl.pathname.split('/').pop();
        if(param !== 'new'){
            this.postParam.id = this.websiteUrl.pathname.split('/').pop();
            this.singlePost();
        }else {
            this.postParam.id = '';
        }
        if(param === 'new') {
            this.richTextEditor = new RichTextEditor("#content_description", {height: 300});
            $('#is_featured').prop('checked', false);
            $('#comment').prop('checked', true);
        }

        this.listTags();

        window.addEventListener('mouseup', (e) => {

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
