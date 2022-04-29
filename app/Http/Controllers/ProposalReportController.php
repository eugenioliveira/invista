<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Collection;
use PDF;
use Storage;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class ProposalReportController extends Controller
{
    public function show(Proposal $proposal)
    {
        /**
         * 1. Gerar o PDF da proposta e salvar na pasta 'documents'
         * 2. Gerar os PDF's das imagens de documentos, caso hajam
         * 3. Unir todos os arquivos em um só (inline)
         */
        $disk = Storage::disk('documents');
        $proposalFileName = sprintf('proposal%s.pdf', $proposal->id);
        $pdfs = collect([]);
        $proposalWrapper = PDF::loadView('proposals.report', ['proposal' => $proposal]);
        if ($this->savePdf($disk, $proposalWrapper, $proposalFileName)) {
            $pdfs->push($proposalFileName);
        }
        foreach ($proposal->documents as $document) {
            $mime = $disk->mimeType($document->filename);
            if (in_array($mime, ['image/jpeg', 'image/png'])) {
                $html = '<img src="' . $disk->path($document->filename) . '" width="600" />';
                $imageDocumentFileName = pathinfo($document->filename, PATHINFO_FILENAME) . '.pdf';
                $imageDocumentWrapper = PDF::loadHTML($html);
                if ($this->savePdf($disk, $imageDocumentWrapper, $imageDocumentFileName)) {
                    $pdfs->push($imageDocumentFileName);
                }
            } else {
                $pdfs->push($document->filename);
            }
        }

        $this->mergePdfs($disk, $pdfs, $proposalFileName);
    }

    /**
     * Salva um PDF no disco.
     *
     * @param FilesystemAdapter $disk
     * @param PdfWrapper $wrapper
     * @param string $filename
     * @return string|null
     */
    private function savePdf(FilesystemAdapter $disk, PdfWrapper $wrapper, string $filename)
    {
        $pdfOutput = $wrapper->setPaper('a4')->output();
        if ($disk->put($filename, $pdfOutput)) {
            return $filename;
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    private function mergePdfs(FilesystemAdapter $disk, Collection $pdfs, string $filename)
    {
        $pdfMerger = PdfMerger::init();

        foreach ($pdfs as $pdf) {
            $pdfMerger->addPDF($disk->path($pdf));
        }

        $pdfMerger->merge();
        return $pdfMerger->save($filename, 'browser');
    }
}
