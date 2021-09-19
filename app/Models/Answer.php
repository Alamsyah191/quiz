<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',

    ];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function storeAnswer($data, $pertanyaan)
    {
        foreach ($data['options'] as $key => $option) {
            $is_correct = false;
            if ($key == $data['correct_answer']) {
                $is_correct = true;
            }
            $answer = Answer::create([
                'question_id' => $pertanyaan->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
    }

    public function updateAnswer($data, $pertanyaan)
    {
        $this->deleteAnswer($pertanyaan->id);

        $this->storeAnswer($data, $pertanyaan);
    }

    public function deleteAnswer($questionId)
    {
        Answer::where('question_id', $questionId)->delete();
    }
}
