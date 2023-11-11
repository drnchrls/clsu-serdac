<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadPublication extends Model
{
    use HasFactory;

    protected $table = 'download_publications';

    protected $primaryKey = 'download_id';

    protected $fillable = [
        'download_user_id',
        'download_publication_id',
        'download_publication_title',
        'download_publication_author',
        'download_reason',
        'download_date',
        'download_reason',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'download_user_id');
    }
}
