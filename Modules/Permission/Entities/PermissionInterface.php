<?php 

namespace Modules\Permission\Entities;

interface PermissionInterface {
	public function all();
	public function getAllWithParentName();
}