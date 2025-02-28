<?php

namespace GIS\RequestForm\Models;

use App\Models\User;
use GIS\RequestForm\Interfaces\RequestFormModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RequestForm extends Model implements RequestFormModelInterface
{
    protected $fillable = [
        "type",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function recordable(): MorphTo
    {
        return $this->morphTo();
    }
}
