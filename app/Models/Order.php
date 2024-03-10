<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunable;
// use Illuminate\Database\Eloquent\MassPrunable;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;
    // use MassPrunable;

    protected $fillable = [
        'order_number', 'user_id', 'status', 'grand_total', 'item_count', 'payment_status', 'payment_method',
        'first_name', 'last_name', 'address', 'city', 'country', 'post_code', 'phone_number', 'notes'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /**
 	* Get the prunable model query.
 	*/
	public function prunable(): Builder
	{
    	return static::where('created_at', '<=', now()->subMonth());
	}

    /**
     * Prepare the model for pruning.
     */
    protected function pruning(): void
    {
        // ...
    }

    public function user()     {
        return $this->belongsTo(User::class);
    }
    public function items()   {
        return $this->hasMany(OrderItem::class);
    }
}
