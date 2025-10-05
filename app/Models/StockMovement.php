<?php

// app/Models/StockMovement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'type', 'quantity', 'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
