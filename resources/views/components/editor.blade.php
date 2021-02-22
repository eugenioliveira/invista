<div x-data="documentEditor()" x-init="initEditor($refs.edt, $refs.tb)">
    <div class="document-editor">
        <div class="document-editor__toolbar" x-ref="tb"></div>
        <div class="document-editor__editable-container">
            <div class="document-editor__editable" x-ref="edt">
                {{ $slot }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function documentEditor() {
                return {
                    initEditor(editableContainer, toolbarContainer) {
                        CaixetaDocumentEditor
                            .create(editableContainer)
                            .then(editor => {
                                window.editor = editor;
                                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                            })
                            .catch(error => console.log(error.stack))
                    }
                }
            }
        </script>
    @endpush</div>