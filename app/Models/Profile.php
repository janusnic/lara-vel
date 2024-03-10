<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // belongsTo працює так:
    // $this->belongsTo(User::class,
    //   'user_id' // foreignKey By Default Parent Model + Promary Key
    //   'id' // OwnerKey By Default Id
    // );

                
    
}
