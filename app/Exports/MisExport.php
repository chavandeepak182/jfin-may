<?php

namespace App\Exports;
use App\Models\Mis;
use Maatwebsite\Excel\Concerns\FromCollection;

class MisExport implements FromCollection
{
    protected $roleId;
    protected $userId;

    public function __construct($roleId, $userId)
    {
        $this->roleId = $roleId;
        $this->userId = $userId;
    }

    public function collection()
{
    $query = Mis::query();

    // ✅ 1. DSA MIS PAGE → ONLY DSA DATA (special case)
    if ($this->roleId === 'dsa_only') {
        $query->whereIn('created_by', function ($q) {
            $q->select('id')
              ->from('users')
              ->where('role_id', 6);
        });

        return $query->get();
    }

    // ✅ 2. Agent → only own data
    if ($this->roleId == config('constants.roles.agent')) {
        $query->where('created_by', $this->userId);
    }

    // ✅ 3. DSA (normal login) → only own data
    elseif ($this->roleId == 6) {
        $query->where('created_by', $this->userId);
    }

    // ✅ 4. Admin → EXCLUDE DSA
    elseif ($this->roleId == config('constants.roles.admin')) {
        $query->whereNotIn('created_by', function ($q) {
            $q->select('id')
              ->from('users')
              ->where('role_id', 6);
        });
    }

    return $query->get();
}
}
