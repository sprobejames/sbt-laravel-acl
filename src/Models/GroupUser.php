<?php

namespace Sprobe\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Sprobe\Acl\Exceptions\GroupDoesNotExistException;

class GroupUser extends Model
{
    /** @var string */
    protected $table = 'group_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'user_id'];
}
