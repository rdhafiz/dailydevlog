function convertToHTML(data) {
    let html = '';
    data.blocks.forEach((block, index) => {
        switch (block.type) {
            case 'paragraph':
                html += `<p>${block.data.text}</p>`;
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
                html += `<div class="border-theme-start flex justify-center"><q class="flex justify-start items-center gap-2"><p>${block.data.text}</p><footer>${block.data.caption || ''}</footer></q></div>`;
                break;
            case 'image':
                html += `<div style="text-align:center;"><img src="${block.data.file.url}" alt="${block.data.caption || 'Editor.js image'}" style="max-width:100%; height:auto; object-fit: cover;" /></div>`;
                break;
            case 'code':
                html += `<pre><code>${block.data.code}</code></pre>`;
                break;
            case 'delimiter':
                html += `<hr />`;
                break;
            case 'embed':
                html += `<div class="embed-container">${block.data.url}</div>`;
                break;
            case 'raw':
                html += `${block.data.html}`;
                break;
            case 'linkTool':
                html += `<a href="${block.data.link}" target="_blank">${block.data.title || block.data.link}</a>`;
                break;
            case 'checklist':
                html += '<ul style="list-style: none; padding: 10px 0 !important;">';
                block.data.items.forEach(item => {
                    html += `<li style="list-style: none" class="flex justify-start items-center"><input type="checkbox" ${item.checked ? 'checked' : ''} disabled />  <span style="margin-left: 6px"> ${item.text} </span> </li>`;
                });
                html += '</ul>';
                break;
            case 'table':
                html += '<table border="1" cellpadding="5" cellspacing="0">';
                block.data.content.forEach(row => {
                    html += '<tr>';
                    row.forEach(cell => {
                        html += `<td>${cell}</td>`;
                    });
                    html += '</tr>';
                });
                html += '</table>';
                break;
            default:
                html += `<div>Unsupported block type: ${block.type}</div>`;
                break;
        }
    });

    return html;
}

const htmlContent = convertToHTML(window.editorContent);
document.getElementById('editor-content').innerHTML = htmlContent;
