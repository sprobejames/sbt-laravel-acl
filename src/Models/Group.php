<?php

namespace Sprobe\Acl\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * Retrieves all users of the group
     *
     * @return App\Models\User[]
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Retrieves all permissions of the group
     *
     * @return Sprobe\Acl\Models\GroupPermission[]
     */
    public function permissions()
    {
        return $this->hasMany(GroupPermission::class, 'group_id');
    }
}
