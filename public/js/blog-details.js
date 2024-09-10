const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        image: {
            class: SimpleImage,
            config: {
                // `SimpleImage` should handle base64 automatically
                uploader: {
                    uploadByFile: () => Promise.resolve({ success: 1, file: {} }),
                    uploadByUrl: (url) => Promise.resolve({
                        success: 1,
                        file: { url }
                    })
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
    data: window.editorContent,  // Ensure this contains valid JSON
    readOnly: true,
});


function convertToHTML(data) {
    let html = '';

    data.blocks.forEach((block, index) => {
        switch (block.type) {
            case 'paragraph':
                html += `<p>${block.data.text}</p>`;
                break;
            case 'image':
                html += `<div style="text-align:center;"><img src="${block.data.file.url}" alt="Editor.js image" style="max-width:100%; height:auto;" /></div>`;
                break;
            case 'header':
                html += `<h${block.data.level}>${block.data.text}</h${block.data.level}>`;
                break;
            case 'list':
                if (block.data.style === 'unordered') {
                    html += '<ul>';
                    block.data.items.forEach(item => {
                        html += `<li>${item}</li>`;
                    });
                    html += '</ul>';
                } else if (block.data.style === 'ordered') {
                    html += '<ol>';
                    block.data.items.forEach(item => {
                        html += `<li>${item}</li>`;
                    });
                    html += '</ol>';
                }
                break;
            case 'quote':
                html += `<blockquote><p>${block.data.text}</p><footer>${block.data.caption || ''}</footer></blockquote>`;
                break;
            // Handle additional block types if needed
            default:
                html += `<div>Unsupported block type: ${block.type}</div>`;
                break;
        }

        // Add spacing between blocks
        if (index < data.blocks.length - 1) {
            html += '<br>'; // or any other spacer, e.g., a <hr> or margin CSS
        }
    });

    return html;
}


// // Convert the data and insert it into the DOM
const htmlContent = convertToHTML(window.editorContent);
document.getElementById('editor-content').innerHTML = htmlContent;
