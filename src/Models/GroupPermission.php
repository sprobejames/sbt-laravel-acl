<?php

namespace Sprobe\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'permission_id', 'resource_id'];

    /**
     * Retrieves the Permission of the Group
     *
     * @return Sprobe\Acl\Models\Permission
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Retrieves the Resource of the Group
     *
     * @return Sprobe\Acl\Models\Resource
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
