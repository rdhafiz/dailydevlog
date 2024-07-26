new Vue({
    el: '#footer',
    data: {
        categoryLoading: false,
        categoryData: [],
    },
    mounted() {
        this.listCategory()
    },
    methods: {

        /* --- --- --- category --- --- --- */
        listCategory() {
            this.categoryLoading = true;
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.get(`/api/front/categories`, {headers: headerContent}).then((response) => {
                this.categoryData = response?.data?.data
            })
        },

    },
})
