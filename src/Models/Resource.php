<?php

namespace Sprobe\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Sprobe\Acl\Exceptions\ResourceDoesNotExistException;

class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Retrieves or Create a new resource
     *
     * @return Sprobe\Acl\Models\Resource
     */
    public static function findOrCreate(string $name): Resource
    {
        $resource = static::query()->where('slug', $name)->first();

        if (! $resource instanceof Resource) {
            return static::query()->create([
                            'name' => ucfirst($name),
                            'slug' => $name,
                        ]);
        }

        return $resource;
    }

    /**
     * Retrieves the Resource by slug
     *
     * @param string $slug
     * @return Sprobe\Acl\Models\Resource
     */
    public static function findBySlug(string $slug): Resource
    {
        $resource = static::query()->where('slug', $slug)->first();

        if (! $resource instanceof Resource) {
            throw new ResourceDoesNotExistException;
        }

        return $resource;
    }
}
