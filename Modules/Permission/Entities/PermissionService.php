<?php

namespace Modules\Permission\Entities;

use Modules\Permission\Entities\PermissionInterface;

class PermissionService
{
	protected $permissionRepository;

	public function __construct(PermissionInterface $permissionRepository)
	{
		$this->permissionRepository = $permissionRepository;
	}

	public function getService(){
		return $this->permissionRepository->all();
	}

}