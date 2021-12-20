<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CLIENT_STEP()
 * @method static static FINANCIAL_STEP()
 * @method static static DOCUMENT_STEP()
 */
final class ProposalWizardSteps extends Enum
{
    const CLIENT_STEP = 1;
    const FINANCIAL_STEP = 3;
    const DOCUMENT_STEP = 4;
}
