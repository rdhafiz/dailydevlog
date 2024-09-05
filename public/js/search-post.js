new Vue({
    el: '#searchBlogs',
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

        /* Function of previous page call */
        // PrevPage() {
        //     if (this.current_page > 1) {
        //         this.current_page = this.current_page - 1;
        //         this.listPost()
        //     }
        // },

        /* Function of next page call */
        // NextPage() {
        //     if (this.current_page < this.total_pages) {
        //         this.current_page = this.current_page + 1;
        //         this.listPost()
        //     }
        // },

        /* Function of change page call */
        // pageChange(page) {
        //     this.current_page = page;
        //     this.listPost()
        // },


    },
    mounted(){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const keyword = urlParams.get('keyword');
        const is_featured = urlParams.get('is_featured');
        if(keyword){
            this.formData.keyword = keyword;
            this.current_page = 1
        }
        if(is_featured){
            this.formData.is_featured = is_featured;
            this.current_page = 1
        }
    }
})
