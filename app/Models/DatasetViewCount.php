<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetViewCount extends Model
{
    use HasFactory;
    
    protected $table = 'dataset_view_counts';
    protected $primaryKey = 'dataset_view_count_id';

    protected $fillable = [
        'dataset_view_count_pub_id',
    ];

    public function publication(){
        return $this->belongsTo('App\Models\Dataset', 'dataset_view_count_pub_id');
    }
}
