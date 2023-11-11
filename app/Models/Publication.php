<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';
    protected $fillable = [
        'publication_title',
        'publication_type',
        'publication_description',
        'publication_author',
        'publication_date',
        'publication_contributor',
        'publication_volume',
        'publication_issue',
        'publication_file',
        'publication_file_path',
        'publication_theme',
        'publication_publisher',
        'publication_doi',
    ];

    public function generateCitation($publication)
    {
        $removedAmpersand = str_replace(' & ', ",", $publication->publication_author);

        // Split the full name into individual authors using a comma
        $authors = explode(',', $removedAmpersand);
        $citations = [];
        
        foreach ($authors as $author) {

            $unwantedWords = ['Mr.', 'Mrs.', 'Md.', 'Most.', 'Dr.', 'Prof.', 'PhD.']; //add prefix to remove
            $trimmedText = str_replace($unwantedWords, "", $author);

            $trimmed = trim($trimmedText);

            $authorParts = explode(' ', $trimmed);

            $initials = '';
            
            $lastWord = array_pop($authorParts); // Get and remove the last word (last name)

            foreach ($authorParts as $part) {
                $initials .= strtoupper($part[0]).".";
            }

            // Combine initials and last name
            $fullAuthorName = $lastWord.', '.$initials;

            $citations[] = $fullAuthorName;
            
        }

        $year = Carbon::parse($publication->publication_date)->format('Y');
        $title = $publication->publication_title;
        $contributor = $publication->publication_contributor;

        if(count($citations) > 1){
            $last = array_pop($citations);
            $citation = implode(', ',$citations)." & ".$last." ($year). $title. $contributor.";
        }else{
            $citation = implode(', ',$citations)." ($year). $title. $contributor.";
        }
        return $citation;
    }
}
