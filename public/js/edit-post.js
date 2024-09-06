const uploadFileInput = document.getElementById('upload-file');
const featuredImagePreview = document.getElementById('featured_preview');
const beforeUpload = document.getElementById('before-upload');
const uploadLoading = document.getElementById('uploadLoading');
// const archiveBtn = document.getElementById('archiveBtnSubmit');
// const archiveBtnLoading = document.getElementById('archiveBtnLoading');
// const draftBtn = document.getElementById('draftBtnSubmit');
// const draftBtnLoading = document.getElementById('draftBtnLoading');
const publishBtn = document.getElementById('publishBtnSubmit');
const publishBtnLoading = document.getElementById('publishBtnLoading');

// Switch handler for "Is Featured"
function changeIsFeatured(event) {
    const isChecked = event.target.checked;
    const featureThumb = document.getElementById('is_feature_thumb');

    if (isChecked) {
        featureThumb.classList.remove('bg-gray-400', 'left-1');
        featureThumb.classList.add('bg-white', 'left-10');
    } else {
        featureThumb.classList.remove('bg-white', 'left-10');
        featureThumb.classList.add('bg-gray-400', 'left-1');
    }
}

// Switch handler for "Allow Comments"
function changeAllowComments(event) {
    const isChecked = event.target.checked;
    const commentThumb = document.getElementById('allow_comment_thumb');

    if (isChecked) {
        commentThumb.classList.remove('bg-gray-400', 'left-1');
        commentThumb.classList.add('bg-white', 'left-10');
    } else {
        commentThumb.classList.remove('bg-white', 'left-10');
        commentThumb.classList.add('bg-gray-400', 'left-1');
    }
}

// Initialize RichTextEditor
function runningFunction() {
    let editor1 = new RichTextEditor("#content_description");
    $('#selectTag').select2({
        dropdownParent: $('#selectTagParent'),
        tags: true,
        placeholder: 'Select Tag',
        allowClear: true,
    });

    let selectTag = document.getElementById('selectTag');
    let tagArray = document.getElementById('tagArray');
    selectTag.addEventListener('change', function () {
        tagArray.value = $(this).val().join(',');
    });
}

setTimeout(() => {
    runningFunction();
}, 300);

uploadFileInput.addEventListener('change', function () {
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            featuredImagePreview.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);

        // Show loading spinner (just simulating here, can be enhanced)
        beforeUpload.classList.add('hidden');
        featuredImagePreview.classList.remove('hidden');
        uploadLoading.classList.remove('hidden');
        uploadLoading.classList.add('hidden');
    }
});

// Show loading spinner on submit and handle status change
function handleSubmit(event, btn, loadingElement, status) {
    event.preventDefault();
    btn.classList.add('hidden');
    loadingElement.classList.remove('hidden');
    setTimeout(() => {
        loadingElement.classList.add('hidden');
        btn.classList.remove('hidden');
    }, 2000); // Simulate 2-second form submission delay
}

publishBtn.addEventListener('submit', function (event) {
    handleSubmit(event, publishBtn, publishBtnLoading, 'published');
});
