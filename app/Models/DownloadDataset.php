<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadDataset extends Model
{
    use HasFactory;
    
    protected $table = 'download_datasets';

    protected $primaryKey = 'download_id';

    protected $fillable = [
        'download_user_id',
        'download_dataset_id',
        'download_dataset_title',
        'download_dataset_author',
        'download_date',
        'download_reason',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'download_user_id');
    }
}
