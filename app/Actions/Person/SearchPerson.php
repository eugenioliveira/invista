<?php


namespace App\Actions\Person;


use App\Models\Person;

class SearchPerson
{
    /**
     * Busca pessoas pelo CPF ou nome.
     *
     * @param string $searchTerm
     * @param int|null $pagination
     * @param array $excludeIds
     * @param array $onlyIds
     * @return Person[]|\LaravelIdea\Helper\App\Models\_PersonCollection
     */
    public function search(string $searchTerm, $pagination = false, array $excludeIds = [], array $onlyIds = [])
    {
        $personQuery = Person::where(function ($query) use ($searchTerm) {
            $query
                ->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('cpf', 'like', '%' . $searchTerm . '%');
        })->orderBy('first_name')->orderBy('last_name');

        if (count($excludeIds) > 0) {
            $personQuery->whereNotIn('id', $excludeIds);
        }

        if (count($onlyIds) > 0) {
            $personQuery->whereIn('id', $onlyIds);
        }

        return $pagination ? $personQuery->paginate($pagination) : $personQuery->get();
    }
}