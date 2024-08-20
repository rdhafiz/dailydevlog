new Vue({
    el: '#post',
    data: {
        tableData: [],
        deleteLoading: false,
        formData: {
            keyword: '',
            limit: 20,
            page: 1,
            status: '',
            sort_mode: ''
        },
        total_pages: 0,
        current_page: 0,
        buttons: [],
        last_page: 0,
        loading: false,
        searchTimeout: null,
        msg: null
    },
    methods: {

        /* Function of action dropdown */
        actionDropdown(id) {
            let actionDropDownMenu = document.querySelector(`#action-menu #action-dropdown${id}`);
            actionDropDownMenu.classList.toggle('hidden');
        },

        /* --- --- --- function of clear error handler --- --- --- */
        ClearErrorHandler() {
            const elements = document.querySelectorAll('.error-report');
            elements.forEach((e) => {
                e.textContent = '';
            });
        },

        /* --- --- --- function of list post api --- --- --- */
        listPost() {
            this.loading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.formData.page = this.current_page;
            axios.get(`/api/front/posts`, {params: this.formData}, {headers: headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.tableData = res.data;
                this.tableData.forEach(each => {
                    each.tags = each?.tags.split(',');
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

        /* Function of search list data */
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.listPost();
            }, 800);
        },

        /* Function of delete data */
        deletePost(data, index) {
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
               axios.delete(`/api/front/posts/`+data.id, null, {headers: headerContent}).then((response) => {
                   if (response.data.error) {
                       this.error = response.data.error
                   } else {
                       this.listPost();
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

        /* Function of previous page call */
        PrevPage() {
            if (this.current_page > 1) {
                this.current_page = this.current_page - 1;
                this.listPost()
            }
        },

        /* Function of next page call */
        NextPage() {
            if (this.current_page < this.total_pages) {
                this.current_page = this.current_page + 1;
                this.listPost()
            }
        },

        /* Function of change page call */
        pageChange(page)
        {
            this.current_page = page;
            this.listPost()
        },


    },
    mounted(){

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

        })

    }
})
