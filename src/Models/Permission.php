<?php

namespace Sprobe\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Retrieves or Create a new permission
     *
     * @return Sprobe\Acl\Models\Permission
     */
    public static function findOrCreate(string $name): Permission
    {
        $permission = static::query()->where('name', $name)->first();

        if (! $permission instanceof Permission) {
            return static::query()->create(['name' => $name]);
        }

        return $permission;
    }
}
