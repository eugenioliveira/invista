<div>
    <div class="p-4 space-y-3">
        <div>
            @if($proposal->documents->isNotEmpty())
                <div class="p-4 border rounded">
                    <h1 class='text-lg font-medium'>Documentos cadastrados</h1>
                    <ul class="list-disc px-4">
                        @foreach($proposal->documents as $document)
                            <li>
                                <a
                                        target="_blank"
                                        class="text-blue-500 hover:underline"
                                        href="{{ \Storage::disk('documents')->url($document->filename) }}">
                                    {{ $document->filename }}
                                </a>
                                <span> - </span>
                                <x-button.link wire:click='deleteDocument({{ $document->id }})'>
                                    Remover
                                </x-button.link>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div wire:ignore>
            <div x-data="{
                        init() {
                            FilePond.setOptions({
                                allowMultiple: true,
                                server: {
                                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                        @this.upload('documents', file, load, error, progress);
                                    },
                                    revert: (filename, load) => {
                                        @this.removeUpload('documents', filename, load);
                                    }
                                }
                            });
                            FilePond.create($refs.documentUploadInput, {
                                acceptedFileTypes: ['image/png', 'image/jpeg', 'application/pdf'],
                            });
                        }
                    }">
                <input x-ref="documentUploadInput" type="file" multiple>
            </div>

        </div>
        @error('documents')
        <x-alert type="danger" :autoclose="false">{{ $message }}</x-alert>
        @enderror
        @error('documents.*')
        <x-alert type="danger" :autoclose="false">{{ $message }}</x-alert>
        @enderror
    </div>
</div>
