<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;
    
    protected $table = 'datasets';
    protected $primaryKey = 'dataset_id';
    protected $fillable = [
        'dataset_title',
        'dataset_type',
        'dataset_description',
        'dataset_author',
        'dataset_contributor',
        'dataset_date',
        'dataset_file',
        'dataset_file_path',

    ];
    public function generateCitation($dataset)
    {
        $removedAmpersand = str_replace(' & ', ",", $dataset->dataset_author);

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

        $year = Carbon::parse($dataset->dataset_date)->format('Y');
        $title = $dataset->dataset_title;
        $contributor = $dataset->dataset_contributor;

        if(count($citations) > 1){
            $last = array_pop($citations);
            $citation = implode(', ',$citations)." & ".$last." ($year). $title. $contributor.";
        }else{
            $citation = implode(', ',$citations)." ($year). $title. $contributor.";
        }
        return $citation;
    }
}
