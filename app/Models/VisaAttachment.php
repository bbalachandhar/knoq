<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaAttachment extends Model
{
    use HasFactory;

    protected $table = 'visa_attachments';

    const UPLOAD_PATH = 'uploads/visa_attachments/';

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
        'file_extension',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}