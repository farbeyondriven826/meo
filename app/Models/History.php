<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthday',
        'sex',
        'street',
        'brgy',
        'municipality',
        'province',
    ];

    /**
     * Get histories
     * 
     * @param int|null $limit
     */
    public function histories(
        ?int $limit = null,
        bool $paginate = false,
        ?int $page = 1
    ) {
        // Fetch clients with `latestLogout` and `user` relationships
        $records = Client::with(['latestLogout', 'user'])->get();

        // Filter to include only those clients with `clientUser` (non-admin users)
        $filteredRecords = $records->filter(fn($client) => $client->user && !$client->user->isAdmin);

        // Sort the filtered collection by `latestLogout->created_at` in PHP
        $sortedRecords = $filteredRecords->sortByDesc(fn($client) => $client->latestLogout->created_at ?? null);

        if ($paginate) {
            $perPage = $limit ?? 5;

            // Paginate the sorted collection in PHP
            $currentPageItems = $sortedRecords->slice(($page - 1) * $perPage, $perPage)->values();
            return new \Illuminate\Pagination\LengthAwarePaginator(
                $currentPageItems,
                $sortedRecords->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        return $sortedRecords->values();
    }
}
