@extends('layouts.admin')

@section('title')
    Roles
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap5.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/examples/examples.ecommerce.datatables.list.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $('.delete-row').on('click', function() {
            const id = $(this).attr('data-id')
            const name = $(this).attr('data-name')

            Swal.fire({
                title: "Are you Sure ?",
                text: 'Delete ' + name,
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#ccc",
                confirmButtonText: "Yes",
                closeOnConfirm: !1
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete-roles-' + id).submit()
                }
            })

        })
    </script>
@endsection

@section('main')
    <div class="row">
        <div class="col">
            <div class="card card-modern">
                <div class="card-body">
                    <div class="datatables-header-footer-wrapper mt-2">
                        <div class="datatable-header">
                            <div class="row align-items-center mb-3">
                                @can('setting.roles.create')
                                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                        <a class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4"
                                            href="/admin/roles/create">+ Add Role</a>
                                    </div>
                                @endcan
                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Show:</label>
                                        <select class="form-control select-style-1 results-per-page"
                                            name="results-per-page">
                                            <option value="12" selected>12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input type="text" class="search-term form-control" name="search-term"
                                                id="search-term" placeholder="Search User">
                                            <button class="btn btn-default" type="submit">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list"
                            style="min-width: 550px;">
                            <thead>
                                <tr>
                                    <th width="8%">No</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Permissions</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <strong>{{ ucwords(str_replace('_', ' ', $role->name)) }}</strong>
                                        </td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge bg-secondary rounded-3 fw-semibold">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="actions">
                                            @can('setting.roles.edit')
                                                <a href="/admin/roles/{{ $role->id }}/edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="solid mt-5 opacity-4">
                        <div class="datatable-footer">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <div class="results-info-wrapper"></div>
                                </div>
                                <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                    <div class="pagination-wrapper"></div>
                                </div>
                            </div>
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
