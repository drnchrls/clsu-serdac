<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionPublication extends Model
{
    use HasFactory;

    protected $table = 'submission_publications';

    protected $primaryKey = 'submission_publication_id';

    protected $fillable = [
        'submission_publication_user_id',
        // 'submission_publication_user_fname',
        // 'submission_publication_user_lname',
        // 'submission_publication_user_gender',
        // 'submission_publication_user_age',
        // 'submission_publication_user_occupation',
        // 'submission_publication_user_educational_level',
        'submission_publication_type',
        'submission_publication_title',
        'submission_publication_author',
        'submission_publication_contributor',
        'submission_publication_description',
        'submission_publication_issue',
        'submission_publication_volume',
        'submission_publication_date',
        'submission_publication_file',
        'submission_publication_file_path',
        'submission_publication_theme',
        'submission_publication_publisher',
        'submission_publication_doi',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'submission_publication_user_id');
    }
}
