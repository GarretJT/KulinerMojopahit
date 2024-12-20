<?php

namespace App;
use App\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Table name (optional if matching convention)
    protected $table = 'menus';

    // Mass assignable attributes
    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'image', 
        'tenant_id'
    ];

    /**
     * Define the relationship with the Tenant model
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
