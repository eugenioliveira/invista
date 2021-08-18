<?php


namespace App\Actions\Company;


use App\Models\Company;

class SearchCompany
{
    /**
     * Realiza a busca de pessoa jurídica por nome ou CNPJ.
     *
     * @param string $searchTerm
     * @param false $pagination
     * @param array $creatorIds
     * @return Company[]|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_CompanyCollection
     */
    public function search(string $searchTerm, $pagination = false, array $creatorIds = [])
    {
        $companyQuery = Company::where(function ($query) use ($searchTerm) {
            $query
                ->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('cnpj', 'like', '%' . $searchTerm . '%');
        })
            ->with(['shareholders', 'address'])
            ->orderBy('name');

        if (count($creatorIds) > 0) {
            $companyQuery->whereIn('creator_id', $creatorIds);
        }

        return $pagination ? $companyQuery->paginate($pagination) : $companyQuery->get();
    }
}