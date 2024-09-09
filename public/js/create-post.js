/*
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
    if(isChecked) {
        console.log(isChecked)
    }else {
        console.log(isChecked)
    }
}

// Switch handler for "Allow Comments"
function changeAllowComments(event) {
    const isChecked = event.target.checked;
    if(isChecked) {
        console.log(isChecked)
    }else {
        console.log(isChecked)
    }
}

// select 2 function
function runningFunction() {
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

const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        image: SimpleImage,
        list: List,
        checklist: Checklist,
        quote: Quote,
        warning: Warning,
        marker: Marker,
        code: CodeTool,
        delimiter: Delimiter,
        inlineCode: InlineCode,
        linkTool: LinkTool,
        embed: Embed,
        table: Table
    },
    placeholder: 'Starting typing here',
    i18n: {
        messages: {
            ui: {
                "blockTunes": {
                    "toggler": {
                        "Click to tune": "Click to tune",
                        "or drag to move": "or drag to move"
                    }
                },
                "inlineToolbar": {
                    "converter": {
                        "Convert to": "Convert to"
                    }
                },
                "toolbar": {
                    "toolbox": {
                        "Add": "Add"
                    }
                }
            },
            toolNames: {
                "Text": "Text",
                "Heading": "Heading",
                "List": "List",
                "Warning": "Warning",
                "Checklist": "Checklist",
                "Quote": "Quote",
                "Code": "Code",
                "Delimiter": "Delimiter",
                "Raw HTML": "Raw HTML",
                "Table": "Table",
                "Link": "Link",
                "Marker": "Marker",
                "Bold": "Bold",
                "Italic": "Italic",
                "InlineCode": "InlineCode"
            },
            tools: {
                "warning": {
                    "Title": "Title",
                    "Message": "Message"
                },
                "link": {
                    "Add a link": "Add a link"
                },
                "stub": {
                    "The block can not be displayed correctly.": "The block can not be displayed correctly."
                }
            },
            blockTunes: {
                "delete": {
                    "Delete": "Delete"
                },
                "moveUp": {
                    "Move up": "Move up"
                },
                "moveDown": {
                    "Move down": "Move down"
                }
            }
        }
    }
});

publishBtn.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    editor.save().then((outputData) => {
        document.getElementById('editor-content').value = JSON.stringify(outputData);
        this.submit();
        handleSubmit(event, publishBtn, publishBtnLoading, 'published');
    }).catch((error) => {
        console.log('Saving failed: ', error);
    });
});
*/



document.addEventListener('DOMContentLoaded', function() {
    const uploadFileInput = document.getElementById('upload-file');
    const featuredImagePreview = document.getElementById('featured_preview');
    const beforeUpload = document.getElementById('before-upload');
    const uploadLoading = document.getElementById('uploadLoading');
    const publishBtn = document.getElementById('publishBtnSubmit');
    const publishBtnLoading = document.getElementById('publishBtnLoading');
    const form = document.getElementById('managePost');
    const editorContent = document.getElementById('editor-content');

    // Editor.js setup
    const editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            header: Header,
            image: SimpleImage,
            list: List,
            checklist: Checklist,
            quote: Quote,
            warning: Warning,
            marker: Marker,
            code: CodeTool,
            delimiter: Delimiter,
            inlineCode: InlineCode,
            linkTool: LinkTool,
            embed: Embed,
            table: Table
        },
        placeholder: 'Starting typing here',
        i18n: {
            messages: {
                ui: {
                    "blockTunes": {
                        "toggler": {
                            "Click to tune": "Click to tune",
                            "or drag to move": "or drag to move"
                        }
                    },
                    "inlineToolbar": {
                        "converter": {
                            "Convert to": "Convert to"
                        }
                    },
                    "toolbar": {
                        "toolbox": {
                            "Add": "Add"
                        }
                    }
                },
                toolNames: {
                    "Text": "Text",
                    "Heading": "Heading",
                    "List": "List",
                    "Warning": "Warning",
                    "Checklist": "Checklist",
                    "Quote": "Quote",
                    "Code": "Code",
                    "Delimiter": "Delimiter",
                    "Raw HTML": "Raw HTML",
                    "Table": "Table",
                    "Link": "Link",
                    "Marker": "Marker",
                    "Bold": "Bold",
                    "Italic": "Italic",
                    "InlineCode": "InlineCode"
                },
                tools: {
                    "warning": {
                        "Title": "Title",
                        "Message": "Message"
                    },
                    "link": {
                        "Add a link": "Add a link"
                    },
                    "stub": {
                        "The block can not be displayed correctly.": "The block can not be displayed correctly."
                    }
                },
                blockTunes: {
                    "delete": {
                        "Delete": "Delete"
                    },
                    "moveUp": {
                        "Move up": "Move up"
                    },
                    "moveDown": {
                        "Move down": "Move down"
                    }
                }
            }
        }
    });

    // Show preview and hide loading spinner
    uploadFileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                featuredImagePreview.src = e.target.result;
                beforeUpload.classList.add('hidden');
                featuredImagePreview.classList.remove('hidden');
                uploadLoading.classList.remove('hidden');
                setTimeout(() => uploadLoading.classList.add('hidden'), 1000); // Hide after 1 second
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Handle form submission
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        editor.save().then((outputData) => {
            editorContent.value = JSON.stringify(outputData); // Save Editor.js content into hidden textarea

            // Simulate loading and submit the form
            publishBtn.classList.add('hidden');
            publishBtnLoading.classList.remove('hidden');
            setTimeout(() => {
                form.submit(); // Submit the form after 2 seconds
            }, 2000);
        }).catch((error) => {
            console.log('Saving failed: ', error);
        });
    });

    // Initialize select2
    function initializeSelect2() {
        $('#selectTag').select2({
            dropdownParent: $('#selectTagParent'),
            tags: true,
            placeholder: 'Select Tag',
            allowClear: true,
        });
    }

    setTimeout(() => {
        initializeSelect2();
    }, 300);
});
