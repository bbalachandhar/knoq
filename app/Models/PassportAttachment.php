<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassportAttachment extends Model
{
    use HasFactory;

    protected $table = 'passport_attachments';

    const UPLOAD_PATH = 'uploads/passport_attachments/';

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
