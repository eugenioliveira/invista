/**
 * Arquivo de configuração e compilação do editor WYSIWYG, requerido para
 * configuração de modelos de contratos.
 **/

import ClassicEditor from "@ckeditor/ckeditor5-editor-classic/src/classiceditor";
import Essentials from "@ckeditor/ckeditor5-essentials/src/essentials";
import Paragraph from "@ckeditor/ckeditor5-paragraph/src/paragraph";
import Heading from "@ckeditor/ckeditor5-heading/src/heading";
import List from "@ckeditor/ckeditor5-list/src/list";
import Bold from "@ckeditor/ckeditor5-basic-styles/src/bold";
import Italic from "@ckeditor/ckeditor5-basic-styles/src/italic";

import CKEditorInspector from '@ckeditor/ckeditor5-inspector';

export function create(element) {
    ClassicEditor.create(document.querySelector('#bio'), {
        plugins: [Essentials, Paragraph, Heading, List, Bold, Italic],
        toolbar: ['heading', 'bold', 'italic', 'numberedList', 'bulletedList']
    }).then(editor => {
        console.log('Editor inicializado.');
        // Inicializa o inspetor. Comentar quando em produção
        CKEditorInspector.attach('editor', editor);
        // Disponibiliza o editor globalmente.
        window.editor = editor;
    }).catch(error => console.log(error.stack));
}