<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {
        $this->guardAgainTooManyTeamMembers();

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
    
    protected function guardAgainTooManyTeamMembers()
    {
        if($this->countMembers() >= $this->size)
        {
            throw new \Exception;
        }
    }
}
