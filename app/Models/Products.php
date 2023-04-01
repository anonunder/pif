<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
use App\Models\Distributors;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'company_id', 'additional', 'content', 'formula', 'version', 'category', 'aneks', 'locale','pdf_link','pdf_specifications'
    ];
 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];
    public function company(){
        return $this->belongsTo(Companies::class);
    }
    public function distributor(){
        return $this->belongsTo(Distributors::class);
    }
}
