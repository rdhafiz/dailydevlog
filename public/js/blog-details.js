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
