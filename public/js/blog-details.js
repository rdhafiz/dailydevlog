// Share post in social media content
const websiteUrl = new URL(window.location.href);
postId = websiteUrl.pathname.split('/').pop();

function share(social) {
    let url = encodeURI(window.location.href);
    if (social === "facebook") {
        const navUrl = "https://www.facebook.com/sharer/sharer.php?u=" + url;
        return window.open(navUrl, "_blank");
    }

    if (social === "twitter") {
        const navUrl = "https://twitter.com/intent/tweet?text=" + url;
        return window.open(navUrl, "_blank");
    }

    if (social === "linkedin") {
        const navUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
        return window.open(navUrl);
    }
}
