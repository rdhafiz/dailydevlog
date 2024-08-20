new Vue({
    el: '#post',
    data: {
        tableData: [],
        formData: {
            keyword: '',
            limit: 20,
            page: 1,
            status: 'published',
            sort_mode: ''
        },
        total_pages: 0,
        current_page: 0,
        buttons: [],
        last_page: 0,
        loading: false,
    },
    methods: {
        /* --- --- --- function of author name control --- --- --- */
        nameControl(authorName) {
            let words = authorName.split(' ');
            let initials = ` ${words[0][0].toUpperCase()}${ words[words.length - 1][0].toUpperCase()}`;
            return initials;
        },

        /* --- --- --- function of list post api --- --- --- */
        listBlog() {
            this.loading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            this.formData.page = this.current_page;
            axios.get(`/api/front/posts`, {params: this.formData}, {headers: headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.tableData = res.data
                this.tableData.forEach(each => {
                    each.tags = each?.tags.split(',');
                })
                this.last_page = res.last_page
                this.total_pages = res.total < res.per_page ? 1 : Math.ceil((res.total / res.per_page))
                this.current_page = res.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map(i => i + 1);
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
            })
        },

        /* Function of previous page call */
        PrevPage() {
            if (this.current_page > 1) {
                this.current_page = this.current_page - 1;
                this.listBlog()
            }
        },

        /* Function of next page call */
        NextPage() {
            if (this.current_page < this.total_pages) {
                this.current_page = this.current_page + 1;
                this.listBlog()
            }
        },

        /* Function of change page call */
        pageChange(page)
        {
            this.current_page = page;
            this.listBlog()
        },


    },
    mounted(){
        this.listBlog();
    }
})
