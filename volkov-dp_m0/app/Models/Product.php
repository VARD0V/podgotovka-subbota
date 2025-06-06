<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'type_id',
        'name',
        'articul',
        'minimal_cost',
    ];
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
