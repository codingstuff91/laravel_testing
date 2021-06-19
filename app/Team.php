<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {
        if($this->countMembers() >= $this->size)
        {
            throw new \Exception;
        }

        $this->members()->save($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function countMembers()
    {
        return $this->members()->count();
    }
}
