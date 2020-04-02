<?php

namespace Sprobe\Acl\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Sprobe\Acl\Exceptions\GroupDoesNotExistException;

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
    public static function findOrCreate(string $name): Group
    {
        $group = static::query()->where('name', $name)->first();

        if (! $group instanceof Group) {
            return static::query()->create(['name' => $name]);
        }

        return $group;
    }

    /**
     * Retrieves the Group by name
     *
     * @param string $name
     * @return Sprobe\Acl\Models\Group
     */
    public static function findByName(string $name): Group
    {
        $group = static::query()->where('name', $name)->first();

        if (! $group instanceof Group) {
            throw new GroupDoesNotExistException;
        }

        return $group;
    }

    /**
     * Gives the Group Permission to th Resource
     *
     * @param string $resource
     * @param bool $write
     * @return GroupPermission
     */
    public function givePermissionToResource(string $resource, $write = false)
    {
        // retrieve the resource
        $resource = Resource::findBySlug($resource);

        // retrieve the permission type
        $action = ($write) ? config('permission.write') : config('permission.read');
        $permission = Permission::whereName($action)->first();

        // create the group permission
        GroupPermission::firstOrCreate([
            'group_id' => $this->id,
            'resource_id' => $resource->id,
            'permission_id' => $permission->id,
        ]);

        // reload the model's permissions
        $this->load('permissions');

        return $this;
    }
}
