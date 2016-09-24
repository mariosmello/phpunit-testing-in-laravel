<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {

        if ($user instanceof User) {
            $this->guardAgainstTooANewMember();
            return $this->members()->save($user);
        }

        $this->guardAgainstTooManyMembers($user);
        return $this->members()->saveMany($user);

    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    protected function guardAgainstTooANewMember()
    {
        if ( $this->count() >= $this->size) {
            throw new \Exception;
        }
    }

    protected function guardAgainstTooManyMembers(Collection $userCollection)
    {
        $totalUsers = $this->count() + $userCollection->count();

        if ($totalUsers > $this->size) {
            throw new \Exception;
        }
    }
}
