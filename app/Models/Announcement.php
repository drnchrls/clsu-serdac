<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $primaryKey = 'announcement_id';
    protected $fillable = [
        'announcement_title',
        'announcement_description',
        'announcement_image',
        'announcement_type',
        'announcement_links',
    ];
}
