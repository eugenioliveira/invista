window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Loading Alpine JS - TALL Stack
 */
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/**
 * Loadind Filepond
 */
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
window.FilePond = FilePond;
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);

const labels_pt_BR = {
  // labelIdle: 'Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'
  labelIdle:
    'Arraste e solte os arquivos ou <span class="filepond--label-action"> Clique aqui </span>',
  // labelInvalidField: 'Field contains invalid files',
  labelInvalidField: 'Arquivos inválidos',
  // labelFileWaitingForSize: 'Waiting for size',
  labelFileWaitingForSize: 'Calculando o tamanho do arquivo',
  // labelFileSizeNotAvailable: 'Size not available',
  labelFileSizeNotAvailable: 'Tamanho do arquivo indisponível',
  // labelFileLoading: 'Loading',
  labelFileLoading: 'Carregando',
  // labelFileLoadError: 'Error during load',
  labelFileLoadError: 'Erro durante o carregamento',
  // labelFileProcessing: 'Uploading',
  labelFileProcessing: 'Enviando',
  // labelFileProcessingComplete: 'Upload complete',
  labelFileProcessingComplete: 'Envio finalizado',
  // labelFileProcessingAborted: 'Upload cancelled',
  labelFileProcessingAborted: 'Envio cancelado',
  // labelFileProcessingError: 'Error during upload',
  labelFileProcessingError: 'Erro durante o envio',
  // labelFileProcessingRevertError: 'Error during revert',
  labelFileProcessingRevertError: 'Erro ao reverter o envio',
  // labelFileRemoveError: 'Error during remove',
  labelFileRemoveError: 'Erro ao remover o arquivo',
  // labelTapToCancel: 'tap to cancel',
  labelTapToCancel: 'clique para cancelar',
  // labelTapToRetry: 'tap to retry',
  labelTapToRetry: 'clique para reenviar',
  // labelTapToUndo: 'tap to undo',
  labelTapToUndo: 'clique para desfazer',
  // labelButtonRemoveItem: 'Remove',
  labelButtonRemoveItem: 'Remover',
  // labelButtonAbortItemLoad: 'Abort',
  labelButtonAbortItemLoad: 'Abortar',
  // labelButtonRetryItemLoad: 'Retry',
  labelButtonRetryItemLoad: 'Reenviar',
  // labelButtonAbortItemProcessing: 'Cancel',
  labelButtonAbortItemProcessing: 'Cancelar',
  // labelButtonUndoItemProcessing: 'Undo',
  labelButtonUndoItemProcessing: 'Desfazer',
  // labelButtonRetryItemProcessing: 'Retry',
  labelButtonRetryItemProcessing: 'Reenviar',
  // labelButtonProcessItem: 'Upload',
  labelButtonProcessItem: 'Enviar',
  // labelMaxFileSizeExceeded: 'File is too large',
  labelMaxFileSizeExceeded: 'Arquivo é muito grande',
  // labelMaxFileSize: 'Maximum file size is {filesize}',
  labelMaxFileSize: 'O tamanho máximo permitido: {filesize}',
  // labelMaxTotalFileSizeExceeded: 'Maximum total size exceeded',
  labelMaxTotalFileSizeExceeded: 'Tamanho total dos arquivos excedido',
  // labelMaxTotalFileSize: 'Maximum total file size is {filesize}',
  labelMaxTotalFileSize: 'Tamanho total permitido: {filesize}',
  // labelFileTypeNotAllowed: 'File of invalid type',
  labelFileTypeNotAllowed: 'Tipo de arquivo inválido',
  // fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
  fileValidateTypeLabelExpectedTypes:
    'Tipos de arquivo suportados são {allButLastType} ou {lastType}',
  // imageValidateSizeLabelFormatError: 'Image type not supported',
  imageValidateSizeLabelFormatError: 'Tipo de imagem inválida',
  // imageValidateSizeLabelImageSizeTooSmall: 'Image is too small',
  imageValidateSizeLabelImageSizeTooSmall: 'Imagem muito pequena',
  // imageValidateSizeLabelImageSizeTooBig: 'Image is too big',
  imageValidateSizeLabelImageSizeTooBig: 'Imagem muito grande',
  // imageValidateSizeLabelExpectedMinSize: 'Minimum size is {minWidth} × {minHeight}',
  imageValidateSizeLabelExpectedMinSize:
    'Tamanho mínimo permitida: {minWidth} × {minHeight}',
  // imageValidateSizeLabelExpectedMaxSize: 'Maximum size is {maxWidth} × {maxHeight}',
  imageValidateSizeLabelExpectedMaxSize:
    'Tamanho máximo permitido: {maxWidth} × {maxHeight}',
  // imageValidateSizeLabelImageResolutionTooLow: 'Resolution is too low',
  imageValidateSizeLabelImageResolutionTooLow: 'Resolução muito baixa',
  // imageValidateSizeLabelImageResolutionTooHigh: 'Resolution is too high',
  imageValidateSizeLabelImageResolutionTooHigh: 'Resolução muito alta',
  // imageValidateSizeLabelExpectedMinResolution: 'Minimum resolution is {minResolution}',
  imageValidateSizeLabelExpectedMinResolution:
    'Resolução mínima permitida: {minResolution}',
  // imageValidateSizeLabelExpectedMaxResolution: 'Maximum resolution is {maxResolution}'
  imageValidateSizeLabelExpectedMaxResolution:
    'Resolução máxima permitida: {maxResolution}',
};

FilePond.setOptions(labels_pt_BR);

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
