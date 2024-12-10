<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'requirement_id',
        'application_form_id',
        'remarks',
        'is_file_approve'
    ];
    
    public function form(): BelongsTo
    {
        return $this->belongsTo(ApplicationForm::class, 'application_form_id', 'id');
    }
    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class, 'requirement_id', 'id');
    }

  
}
