

new Vue({
    el: '#single-details',
    data: {
        websiteUrl: new URL(window.location.href),
        postId: null,
        postParam: {
            title: '',
            slug: '',
            content: '',
            featured_image: null,
            category_ids: [],
            status: 'draft',
            meta_title: '',
            meta_description: '',
            is_featured: 0,
            allow_comments: 1,
        },
    },
    methods: {

        /* --- --- --- function of single post api --- --- --- */
        singlePost() {
            const id = this.websiteUrl.pathname.split('/').pop();
            let headerContent = {
                'Content-Type': 'application/json; charset=utf-8',
            }
            axios.get(`/api/front/posts/`+this.postId, this.postParam, {headers: headerContent}).then((response) => {
                this.postParam = response?.data
                this.postParam.tags = response?.data?.tags.split(',');
            }).catch(err => {
                this.manageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = res?.data?.errors;
                }
            });
        },

        /* --- --- --- function of author name control --- --- --- */
        nameControl(authorName) {
            let words = authorName.split(' ');
            let initials = ` ${words[0][0].toUpperCase()}${ words[words.length - 1][0].toUpperCase()}`;
            return initials;
        },

         share(social) {
            let url = encodeURI(window.location.href);
            if (social == "facebook") {
                const navUrl = "https://www.facebook.com/sharer/sharer.php?u=" + url;
                window.open(navUrl, "_blank");
                return;
            }

            if (social == "twitter") {
                const navUrl = "https://twitter.com/intent/tweet?text=" + url;
                window.open(navUrl, "_blank");
                return;
            }

            if (social == "linkedin") {
                const navUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                window.open(navUrl);
                return;
            }
        }
    },
    mounted(){
        this.postId = this.websiteUrl.pathname.split('/').pop();
        this.singlePost();
    }
})
