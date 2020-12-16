<?php


namespace App\Http\Livewire;


use Illuminate\Validation\Rule;

trait ValidatesLotUniqueness
{
    public function validateLotUniqueness(string $allotmentId, bool $ignore = false): bool
    {
        $this->resetErrorBag();

        $fields = [
            'block' => $this->lot->block,
            'number' => $this->lot->number
        ];

        $blockUnique = Rule::unique('lots')->where(function ($query) use ($allotmentId) {
            return $query
                ->where('allotment_id', $allotmentId)
                ->where('number', $this->lot->number);
        });

        $numberUnique = Rule::unique('lots')->where(function ($query) use ($allotmentId) {
            return $query
                ->where('allotment_id', $allotmentId)
                ->where('block', $this->lot->block);
        });

        if ($ignore) {
            $blockUnique->ignore($this->lot);
            $numberUnique->ignore($this->lot);
        }

        $validator = \Validator::make($fields,
            [
                'block' => $blockUnique,
                'number' => $numberUnique
            ],
            [
                'block.unique' => sprintf('A combinação Quadra-Lote %s já existe.', $this->lot->identification),
                'number.unique' => sprintf('A combinação Quadra-Lote %s já existe.', $this->lot->identification),
            ]
        );

        if ($validator->fails()) {
            $this->addError('lot.block', $validator->errors()->first('block'));
            $this->addError('lot.number', $validator->errors()->first('number'));
            return false;
        }

        return true;
    }
}
