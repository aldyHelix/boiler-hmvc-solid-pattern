<?php

namespace Modules\Permission\Entities;

use Modules\Permission\Entities\PermissionInterface;
use Modules\Permission\Entities\Permission;
use DB;

class PermissionRepository implements PermissionInterface
{
	protected $permission;
	protected $db;

	public function __construct(Permission $permission, DB $db)
	{
		$this->permission = $permission;
		$this->db = $db;
	}

	public function all(){
		return $this->permission->all();
	}

	public function getAllWithParentName(){
		return DB::table('permissions as p1')
							 ->rightJoin('permissions as p2', 'p1.id', '=','p2.parent_id')
							 ->select('p2.id', 'p2.display_name', 'p2.name','p2.guard_name', 'p1.display_name as parent_name')
							 ->get();
	}

	public function getAllIdAndDiplayName()
	{
		return $this->permission->select('id', 'display_name', 'name')->get();
	}

}
