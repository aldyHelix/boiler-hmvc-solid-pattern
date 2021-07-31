<?php

namespace Modules\Permission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['display_name', 'name', 'parent_id', 'guard_name'];
    
    protected static function newFactory()
    {
        return \Modules\Permission\Database\factories\PermissionFactory::new();
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id', 'id');
    }
}
