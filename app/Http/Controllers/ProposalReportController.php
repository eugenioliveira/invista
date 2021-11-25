<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use PDF;

class ProposalReportController extends Controller
{
    public function show(Proposal $proposal)
    {
        return PDF::loadView('proposals.report', ['proposal' => $proposal])->inline(
            sprintf('Proposta de Aquisição de Lotes %s.pdf', $proposal->id)
        );
    }
}
