<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'menit',


    ];

    /**
     * Get all of the comments for the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user');
    }

    public function storeQuiz($data)
    {
        return Quiz::create($data);
    }
    public function storeAssign($data)
    {
        $q_id = $data['quiz_id'];
        $q = Quiz::find($q_id);
        $u_id = $data['user_id'];
        return $q->users()->syncWithoutDetaching($u_id);
    }

    public function hasQuizAttempt()
    {
        $kerjakan = [];

        $auth = Auth::user()->id;
        $user = Result::where('user_id', $auth)->get();
        foreach ($user as $u) {
            array_push($kerjakan, $u->quiz_id);
        }

        return $kerjakan;
    }
}
