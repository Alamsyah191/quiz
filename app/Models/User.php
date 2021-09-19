<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'visible_password',
        'occupation', 'address', 'phone', 'bio', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function storeUser($data)
    {


        $data['password'] = bcrypt($data['password']);
        $data['visible_password'] = $data['password'];
        $data['is_admin'] = 0;

        return User::create($data);
    }

    function updateUser($data, $id)
    {
        $p = User::find($id);

        if ($data['password']) {
            $p->password = bcrypt($data['password']);
            $p->visible_password = $data['password'];
        }
        $p->name = $data['name'];
        $p->occupation = $data['occupation'];
        $p->bio = $data['bio'];
        $p->address = $data['address'];
        $p->email = $data['email'];

        $p->save();
        return $p;
    }
}
