<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerProduct extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_product',
        'id_partner',
        'amount',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
