@extends('layouts.contentLayoutMaster')

@section('title', 'Permission Access')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
<!-- Row grouping -->
<section id="row-grouping-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header border-bottom">
                <div class="col-sm-6">
                    <h4 class="card-title">Permission Group</h4>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modals-slide-in"><i data-feather="plus" class="mr-25"></i>Add New Permission</button>
                </div>
          </div>
          <div class="card-datatable">
            <table class="dt-row-grouping table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Display Name</th>
                  <th>Permission Name</th>
                  <th>Guard Name</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Row grouping -->
  <!-- Modal to add new record -->
  <div class="modal modal-slide-in fade" id="modals-slide-in">
    <div class="modal-dialog sidebar-sm">
      <form class="add-new-record modal-content pt-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
        </div>
        <div class="modal-body flex-grow-1">
          <div class="form-group">
            <label class="form-label" for="permission-display-name">Display Name</label>
            <input
              type="text"
              class="form-control dt-display-name"
              id="permission-display-name"
              placeholder="Display nama"
              aria-label="Display nama"
            />
          </div>
          <div class="form-group">
            <label class="form-label" for="permission-name">Permission name</label>
            <input
              type="text"
              id="permission-name"
              class="form-control dt-name"
              name="name"
              placeholder="Name of permission"
              aria-label="Name of Permission"
            />
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-email">Guard Type</label>
            <select class="form-control" id="basicSelect" name="guard_name">
              <option value="web" selected>WEB</option>
              <option value="api">API</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-email">Parent Permission</label>
            <select class="select2 form-control form-control-lg">
              @foreach ($parent_permission as $item)
                <option value="{{$item->id}}">{{$item->display_name}} | {{$item->name}}</option>
              @endforeach
            </select>
            <small class="text-muted">eg.<i>permission without dash means header menu permission.</i></small>
          </div>
          <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
          <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</section>
<!--/ Basic table -->
@endsection
@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <script>
      /**
         * DataTables Basic
         */

        $(function() {
            'use strict';

            var select = $('.select2'),

                dt_row_grouping_table = $('.dt-row-grouping'),
                //dt_multilingual_table = $('.dt-multilingual'),
                assetPath = '../../../app-assets/';

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');
            }

            select.each(function () {
              var $this = $(this);
              $this.wrap('<div class="position-relative"></div>');
              $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
              });
            });

            // Row Grouping
            // --------------------------------------------------------------------

            var groupColumn = 5;
            if (dt_row_grouping_table.length) {
                var groupingTable = dt_row_grouping_table.DataTable({
                    ajax: "{{ route('manage-permission') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'display_name', name: 'display_name' },
                        { data: 'name', name: 'name' },
                        { data: 'guard_name', name: 'guard_name' }, 
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                        { data: 'parent_name', name: 'parent_name' },
                    ],
                    columnDefs: [
                        { 
                          visible: false, 
                          targets: groupColumn 
                        },
                        {
                          targets:-2,
                          width:"50px"
                        }
                    ],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 10,
                    lengthMenu: [10, 25, 50, 75, 100],
                    drawCallback: function(settings) {
                        var api = this.api();
                        var rows = api.rows({ page: 'current' }).nodes();
                        var last = null;

                        api
                            .column(groupColumn, { page: 'current' })
                            .data()
                            .each(function(group, i) {
                                if (last !== group) {
                                    $(rows)
                                        .eq(i)
                                        .before('<tr class="group"><td colspan="8">' + group + '</td></tr>');

                                    last = group;
                                }
                            });
                    },
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['display_name'];
                                }
                            }),
                            type: 'column',
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
                // Order by the grouping
                $('.dt-row-grouping tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        groupingTable.order([groupColumn, 'desc']).draw();
                    } else {
                        groupingTable.order([groupColumn, 'asc']).draw();
                    }
                });
            }
        });
  </script>
@endsection
