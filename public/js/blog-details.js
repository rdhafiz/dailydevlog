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
    data: window.editorContent,
    readOnly: true,
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
