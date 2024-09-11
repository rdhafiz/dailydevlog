const uploadFileInput = document.getElementById('upload-file');
const featuredImagePreview = document.getElementById('featured_preview');
const featuredImagePreviewParent = document.getElementById('featured_preview_parent');
const publishBtn = document.getElementById('publishBtnSubmit');
const publishBtnLoading = document.getElementById('publishBtnLoading');
const form = document.getElementById('managePost');
const editorContent = document.getElementById('editor-content');

// Switch handler for "Is Featured"
function changeIsFeatured(event) {
    const isChecked = event.target.checked;
    if(isChecked) {  }
}

// Switch handler for "Allow Comments"
function changeAllowComments(event) {
    const isChecked = event.target.checked;
    if(isChecked) {  }
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

// featured image upload
uploadFileInput.addEventListener('change', function () {
    if(!window.featured_image){
        console.log(234)
        featuredImagePreviewParent.classList.remove('hidden');
    }
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            featuredImagePreview.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
        featuredImagePreview.classList.remove('hidden');
    }
});

// resize image of content description
function resizeImage(file, maxWidth, maxHeight, quality = 0.7) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        const reader = new FileReader();

        reader.onload = (e) => {
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                let width = img.width;
                let height = img.height;

                // Calculate the new dimensions
                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob((blob) => {
                    const newFile = new File([blob], file.name, {
                        type: file.type,
                        lastModified: file.lastModified
                    });

                    const newReader = new FileReader();
                    newReader.onloadend = () => {
                        resolve(newReader.result);
                    };
                    newReader.onerror = reject;
                    newReader.readAsDataURL(newFile);
                }, file.type, quality);
            };
            img.src = e.target.result;
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

// editor define
const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        image: {
            class: ImageTool,
            config: {
                // Override the default behavior to handle base64 images
                endpoints: {
                    byFile: '', // No endpoint required
                    byUrl: ''
                },
                uploader: {
                    // Use a custom uploader to handle base64 image conversion
                    uploadByFile(file) {
                        return resizeImage(file, 800, 800) // Adjust max width and height as needed
                            .then((base64Image) => {
                                return {
                                    success: 1,
                                    file: {
                                        url: base64Image
                                    }
                                };
                            });
                    },
                    uploadByUrl(url) {
                        return Promise.resolve({
                            success: 1,
                            file: {
                                url: url
                            }
                        });
                    }
                }
            }
        },
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

// Function to set data into Editor.js
function setEditorData(data) {
    editor.isReady.then(() => {
        editor.render(data).catch(error => {
            console.error('Failed to set editor data:', error);
        });
    });
}

setEditorData(window.content_description);

document.addEventListener('DOMContentLoaded', function() {

    // Handle form submission
    document.getElementById('managePost').addEventListener('submit', function(event) {
        event.preventDefault();
        publishBtn.classList.add('hidden');
        publishBtnLoading.classList.remove('hidden');
        editor.save().then((outputData) => {
            editorContent.value = JSON.stringify(outputData);
            const formData = new FormData(form);
            const title = document.getElementById('title').value;
            const shortDesc = document.getElementById('short-description').value;
            const tags = document.getElementById('selectTag').value;
            const titleError = document.getElementById('title-error');
            const shortDescError = document.getElementById('short-description-error');
            const tagsError = document.getElementById('tags-error');
            const content = document.getElementById('content-error');
            publishBtn.classList.add('hidden');
            publishBtnLoading.classList.remove('hidden');
            setTimeout(() => {
                if (JSON.parse(formData.get('content'))?.blocks.length === 0 && title && shortDesc && tags) {
                    if(title && titleError) {
                        titleError.textContent = ''
                    }
                    if(shortDesc && shortDescError) {
                        shortDescError.textContent = ''
                    }
                    if(tags && tagsError) {
                        tagsError.textContent = ''
                    }
                    content.classList.remove('hidden');
                    publishBtn.classList.remove('hidden');
                    publishBtnLoading.classList.add('hidden');
                    content.textContent = 'The content field is required';
                    return;
                }
                this.submit();
            }, 2000);
        }).catch((error) => {
            console.error('Saving failed: ', error);
        });
    });

});
