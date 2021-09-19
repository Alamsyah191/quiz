<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'quiz_id',
    ];
    private $limit = 10;
    private $order = 'DESC';

    /**
     * Get the user that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function storeQuestion($data)
    {
        $data['quiz_id'] = $data['quiz_id'];
        $data['question'] = $data['question'];
        return Question::create($data);
    }
    public function updateQuestion($id, $data)
    {
        $pertanyaan = Question::find($id);
        $pertanyaan->question = $data['question'];
        $pertanyaan->quiz_id = $data['quiz_id'];
        $pertanyaan->save();
        return $pertanyaan;
    }

    public function deleteQuestion($id)
    {
        Question::where('id', $id)->delete();
    }
}
