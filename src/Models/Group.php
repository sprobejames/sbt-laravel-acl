<?php

namespace Sprobe\Acl\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

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

    /**
     * Retrieves or Create a new group
     *
     * @return Sprobe\Acl\Models\Group
     */
    public function findOrCreate(string $name): Group
    {
        $group = static::query()->where('name', $name)->first();

        if (! $group instanceof Group) {
            return static::query()->create(['name' => $name]);
        }

        return $group;
    }
}
