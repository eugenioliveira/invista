<?php

namespace App\Imports;

use App\Enums\LotStatusType;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Validator;

class LotsSheetImport implements ToCollection, WithHeadingRow
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
                'identification' => $row['quadra'] . $row['lote'],
                'block' => $row['quadra'],
                'number' => $row['lote'],
                'price' => app('decimal')->format($row['preco']),
                'formatted_price' => app('currency')->format($row['preco']),
                'front' => app('decimal')->format($row['frente']),
                'back' => app('decimal')->format($row['fundos']),
                'right' => app('decimal')->format($row['direita']),
                'left' => app('decimal')->format($row['esquerda']),
                'front_side' => $row['conf_frente'],
                'back_side' => $row['conf_fundos'],
                'right_side' => $row['conf_direita'],
                'left_side' => $row['conf_esquerda'],
                'status' => collect(LotStatusType::asSelectArray())->flip()[$row['status']]
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
        return Validator::make($rows->toArray(),
            [
                '*.quadra' => ['required', 'max:3'],
                '*.lote' => ['required', 'numeric'],
                '*.preco' => ['required', 'numeric'],
                '*.frente' => ['required', 'numeric'],
                '*.fundos' => ['required', 'numeric'],
                '*.direita' => ['required', 'numeric'],
                '*.esquerda' => ['required', 'numeric'],
                '*.conf_frente' => ['required', 'min:3'],
                '*.conf_fundos' => ['required', 'min:3'],
                '*.conf_direita' => ['required', 'min:3'],
                '*.conf_esquerda' => ['required', 'min:3'],
                '*.status' => ['required', Rule::in(['Disponível', 'Vendido', 'Bloqueado', 'Sócio'])]
            ],
            [
                '*.quadra.required' => 'Erro na linha :attribute: Campo quadra vazio.',
                '*.quadra.max' => 'Erro na linha :attribute: O campo quadra aceita no máximo 3 caracteres.',
                '*.lote.required' => 'Erro na linha :attribute: Campo lote vazio.',
                '*.lote.numeric' => 'Erro na linha :attribute: Campo lote deve ser um número.',
                '*.preco.required' => 'Erro na linha :attribute: Campo preco vazio.',
                '*.preco.numeric' => 'Erro na linha :attribute: Campo preco deve ser um número.',
                '*.frente.required' => 'Erro na linha :attribute: Campo frente vazio.',
                '*.frente.numeric' => 'Erro na linha :attribute: Campo frente deve ser um número.',
                '*.fundos.required' => 'Erro na linha :attribute: Campo fundos vazio.',
                '*.fundos.numeric' => 'Erro na linha :attribute: Campo fundos deve ser um número.',
                '*.direita.required' => 'Erro na linha :attribute: Campo direita vazio.',
                '*.direita.numeric' => 'Erro na linha :attribute: Campo direita deve ser um número.',
                '*.esquerda.required' => 'Erro na linha :attribute: Campo esquerda vazio.',
                '*.esquerda.numeric' => 'Erro na linha :attribute: Campo esquerda deve ser um número.',
                '*.conf_frente.required' => 'Erro na linha :attribute: Campo confrontação de frente vazio.',
                '*.conf_frente.min' => 'Erro na linha :attribute: Campo confrontação de frente deve possuir no mínimo 3 caracteres.',
                '*.conf_fundos.required' => 'Erro na linha :attribute: Campo confrontação de fundos vazio.',
                '*.conf_fundos.min' => 'Erro na linha :attribute: Campo confrontação de fundos deve possuir no mínimo 3 caracteres.',
                '*.conf_direita.required' => 'Erro na linha :attribute: Campo confrontação de direita vazio.',
                '*.conf_direita.min' => 'Erro na linha :attribute: Campo confrontação de direita deve possuir no mínimo 3 caracteres.',
                '*.conf_esquerda.required' => 'Erro na linha :attribute: Campo confrontação de esquerda vazio.',
                '*.conf_esquerda.min' => 'Erro na linha :attribute: Campo confrontação de esquerda deve possuir no mínimo 3 caracteres.',
                '*.status' => 'Erro na linha :attribute: Campo status vazio.',
                '*.status.in' => 'Erro na linha :attribute: Os valores permitidos para o campo status são exatamente: Disponível, Vendido, Bloqueado, Sócio.'
            ]
        )->validateWithBag('importLots');
    }
}
