<?php

namespace App\Imports;

use App\Enums\LotStatusType;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Validator;

class LotImport implements ToCollection
{
    use Importable;

    /**
     * As linhas a serem importadas
     *
     * @var Collection
     */
    private Collection $rows;

    /**
     * Realiza a importação
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows): void
    {
        $this->rows = collect();
        $validatedRows = $this->validate($rows);

        foreach ($validatedRows as $row) {
            $this->rows->push([
                'identification' => $row[0] . $row[1],
                'price' => app('currency')->format($row[2]),
                'front' => app('decimal')->format($row[3]),
                'back' => app('decimal')->format($row[4]),
                'left' => app('decimal')->format($row[5]),
                'right' => app('decimal')->format($row[6]),
            ]);
        }
    }

    /**
     * Retorna as linhas formatadas
     *
     * @return Collection
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    /**
     * Valida o arquivo em excel.
     *
     * @param Collection $rows
     * @return Collection
     */
    protected function validate(Collection $rows)
    {
        $validHeadingRows = collect([
            'Quadra',
            'Lote',
            'Preço',
            'Frente',
            'Fundos',
            'Direita',
            'Esquerda',
            'Conf. Frente',
            'Conf. Fundos',
            'Conf. Direita',
            'Conf. Esquerda',
            'Status'
        ]);

        if ($validHeadingRows->diff(collect($rows[0]))->isNotEmpty()) {
            throw new \UnexpectedValueException('As colunas do arquivo Excel não são válidas. Verifique.');
        }

        $rows->shift();

        return Validator::make($rows->toArray(),
            [
                '*.0' => ['required', 'max:3'],
                '*.1' => ['required', 'numeric'],
                '*.2' => ['required', 'numeric'],
                '*.3' => ['required', 'numeric'],
                '*.4' => ['required', 'numeric'],
                '*.5' => ['required', 'numeric'],
                '*.6' => ['required', 'numeric'],
                '*.7' => ['required', 'min:3'],
                '*.8' => ['required', 'min:3'],
                '*.9' => ['required', 'min:3'],
                '*.10' => ['required', 'min:3'],
                '*.11' => ['required', Rule::in(['Disponível','Vendido','Bloqueado','Sócio'])]
            ],
            [
                '*.0.required' => 'Erro na linha :attribute: Campo quadra vazio.'
            ]
        )->validateWithBag('importLots');
    }
}
