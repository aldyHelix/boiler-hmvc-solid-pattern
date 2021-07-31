<?php

namespace Modules\Permission\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Permission\Entities\Permission;
use Modules\Permission\Entities\PermissionInterface;
use Modules\Permission\Entities\PermissionService;
use DataTables;
use App\Helpers\Button;

class PermissionController extends Controller
{

    private $permissionRepository;
    private $permissionService;
    private $button;

    public function __construct(
        PermissionInterface $permissionRepository, 
        PermissionService $permissionService,
        Button $button)
    {
        $this->permissionRepository     = $permissionRepository;
        $this->permissionService        = $permissionService;
        $this->button                   = $button;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        //dd($this->permissionRepository->getAllWithParentName());
        $data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Dashboard"], ['link' => "javascript:void(0)", 'name' => "Permission"]
        ];
        if ($request->ajax())
        {
            $data = $this->permissionRepository->getAllWithParentName();
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
            
            return Datatables::of($data)
                    ->addColumn('action', function($row) use ($buttonList){
                        // $btn = $this->button->dropDownButtonIconOnly($buttonList, $row->id);
                        // $btn = $btn.$this->button->editButtonIconOnly('edit', 'manage-permission', $row->id);
                        return '<button type="button" class="btn btn-icon btn-flat-success">
                        <i data-feather="camera"></i>
                      </button>';
                    })
                    ->rawColumns(['action','parent_name'])
                    ->make(true);
        }
        return view('permission::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('permission::create');
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
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('permission::edit');
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
