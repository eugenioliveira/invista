<?php


namespace App\Actions\Person;


use App\Models\Person;

class SearchPerson
{
    /**
     * Busca pessoas pelo CPF ou nome.
     *
     * @param string $searchTerm
     * @return Person[]|\LaravelIdea\Helper\App\Models\_PersonCollection
     */
    public function search(string $searchTerm, $excludeId = null)
    {
        if (strlen($searchTerm) >= 3) {
            $personQuery = Person::where(function ($query) use ($searchTerm) {
                $query
                    ->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('cpf', 'like', '%' . $searchTerm . '%');
            });

            if ($excludeId) {
                $personQuery->where('id', '<>', $excludeId);
            }

            return $personQuery->get();
        }
    }
}