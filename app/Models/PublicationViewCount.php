<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationViewCount extends Model
{
    use HasFactory;
    
    protected $table = 'publication_view_counts';
    protected $primaryKey = 'publication_view_count_id';

    protected $fillable = [
        'publication_view_count_pub_id',
    ];

    public function publication(){
        return $this->belongsTo('App\Models\Publication', 'publication_view_count_pub_id');
    }
}
