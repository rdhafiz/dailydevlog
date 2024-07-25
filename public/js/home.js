new Vue({
    el: '#home',
    data: {
        tableData: [],
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
        searchTimeout: null,
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
            this.tableData.page = this.current_page;
            axios.get(`/api/front/posts`, {params: this.tableData}, {headers: headerContent}).then((response) => {
                let res = response.data
                console.log(res)
                this.loading = false;
                this.tableData = res?.data
                this.last_page = res?.data?.last_page
                this.total_pages = res?.data?.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page));
                this.current_page = res?.data?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
            })
        },

    },
    mounted(){

        this.listBlog();

    }
})
