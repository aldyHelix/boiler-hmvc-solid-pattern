<?php

namespace Modules\Test\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\Button;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id = 1)
    {
        $buttonList = collect([
            [
                'name' => 'edit',
                'display_name' => 'Edit',
                'icon' => 'circle',
                'route' => 'manage-permission'
            ],
            [
                'name' => 'view',
                'display_name' => 'View',
                'icon' => 'circle',
                'route' => 'manage-permission',
            ],
            [
                'name' => 'delete',
                'display_name' => 'Delete',
                'icon' => 'circle',
                'route' => 'manage-permission',
                'class' => 'delete-record'
            ]
        ]);
        $data['button'] = Button::dropDownButtonIconOnly($buttonList, $id);
        return view('test::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('test::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('test::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('test::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
