<?php

namespace Sprobe\Acl\Traits;

use Illuminate\Support\Facades\Cache;
use Sprobe\Acl\Models\Group;

trait Permissible
{
    /**
     * Checks if the User has Access for the
     * Resource
     *
     * @param string $resource
     * @param bool $write
     * @return bool
     */
    public function canAccessResource($resource, $write = false): bool
    {
        $action = ($write) ? config('permission.write') : config('permission.read');

        // retrieve user groups with permission to given resource
        $groups = Cache::remember("user.{$this->id}.groups", 60, function () use ($resource, $action) {
            return $this->groups()
                        ->whereHas('permissions', function ($query) use ($resource, $action) {
                            $query->whereHas('resource', function ($subQuery) use ($resource) {
                                return $subQuery->where('slug', $resource);
                            });
                            $query->whereHas('permission', function ($subQuery) use ($action) {
                                return $subQuery->where('name', $action);
                            });
                        })
                        ->get();
        });

        return $groups->isEmpty() ? false : true;
    }

    /**
     * Retrieves the groups of the user
     *
     * @return Sprobe\Acl\Models\Group[]
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Assigns User to a Group
     *
     * @param string $group
     * @return mixed
     */
    public function assignToGroup(string $group)
    {
        $group = Group::findByName($group);

        $this->groups()->syncWithoutDetaching([$group->id]);

        // reload the user groups
        $this->load('groups');

        return $this;
    }

    /**
     * Removes User from a Group
     *
     * @param string $group
     * @return mixed
     */
    public function removeFromGroup(string $group)
    {
        $group = Group::findByName($group);

        $this->groups()->detach($group->id);

        // reload the user groups
        $this->load('groups');

        return $this;
    }
}
