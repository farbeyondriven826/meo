<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationReqData extends Model
{
    use HasFactory;

    protected $table = 'application_req_datas';

    protected $fillable = [
        'application_id',
        'client_id',
        'requirement_id',
        'key',
        'value'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(ApplicationForm::class, 'application_id', 'id');
    }

    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class, 'requirement_id', 'id');
    }
}
