<?php
namespace App\Helpers;
use Form;

class Button {

	public static function basicButton($class ,$url, $button_name, $icon_name)
	{
		return '<a class="'.$class.'" href="'.$url.'"><i class="fa fa-'.$icon_name.'"></i>'.$button_name.'</a>';
	}

	public static function deleteButton($class ,$route_name, $id , $button_name, $icon_name)
	{
		return Form::open(['method' => 'DELETE','route' => [$route_name, $id],'style'=>'display:inline']).''.Form::submit($button_name, ['class' => $class]).''.Form::close();
	}
	
	public static function dropDownButtonIconOnly($buttonAction, $id)
	{
		$button = '<div class="d-inline-flex">';
		$button = $button.'<a class="btn btn-icon dropdown-toggle hide-arrow text-primary waves-effect" data-toggle="dropdown"><i data-feather="camera"></i></a>';
		$button = $button.'<div class="dropdown-menu dropdown-menu-right">';

		foreach($buttonAction as $row){
			if($row['name'] == 'delete') {
				$btn = '<form method="DELETE" route="'.route($row['route'], $id).'" style="display:inline"><button type="submit" class="dropdown-item"><i data-feather="'.$row['icon'].'" class="font-small-4 mr-50"></i></button></form>';
			} else {
				$btn = '<a href="'.route($row['route'], $id).'" class="dropdown-item">';
				$btn = $btn.'<i data-feather="'.$row['icon'].'" class="font-small-4 mr-50"></i></a>';
			}
			$button = $button.$btn;
		}
		$button = $button.'</div></div>';

		return $button;
	}

	public static function dropDownButtonTextOnly($buttonAction, $id)
	{
		$button = '<div class="d-inline-flex">';
		$button = $button.'<a class="btn btn-primary dropdown-toggle hide-arrow text-primary waves-effect" data-toggle="dropdown">More</a>';
		$button = $button.'<div class="dropdown-menu dropdown-menu-left">';

		foreach($buttonAction as $row){
			if($row['name'] == 'delete') {
				$btn = '<form method="DELETE" route="'.route($row['route'], $id).'" style="display:inline"><a type="submit" class="dropdown-item">'.$row['display_name'].'</a></form>';
			} else {
				$btn = '<a href="'.route($row['route'], $id).'" class="dropdown-item">'.$row['display_name'].'</a>';
			}
			$button = $button.$btn;
		}
		$button = $button.'</div></div>';

		return $button;
	}

	public static function editButtonIconOnly($icon, $route, $id)
	{
		return '<a href="'.route($route, $id).'" class="btn btn-icon btn-icon rounded-circle btn-flat-success"><i data-feather="'.$icon.'"></i></a>';
	}

}