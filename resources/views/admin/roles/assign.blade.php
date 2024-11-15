@extends('admin.admin_layouts');
@section('body')
    ;

    <div class="container">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Assign Roles</h3>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.role.createView') }}" class="btn btn-primary btn-round me-2"><i class="fa fa-plus"></i>
                        Add Role</a>
                </div> -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Department List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container mt-4">
                                <div class="row m-4 bg-light py-4">
                                    <div class="col-2">
                                        <span>Id</span>
                                    </div>
                                    <div class="col-6">
                                        <span>Category</span>
                                    </div>
                                    <div class="col-4">
                                        <span>View</span>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('admin.role.assignrole') }}">
                                    @csrf
                                    <input type="hidden" name="role_id" , value="{{ $assignData['roleid'] }}" />
                                    @foreach ($assignData['categories'] as $row)
                                        <div class="row m-4">
                                            <div class="col-2">
                                                <span>{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-6">
                                                <span>{{ $row->category_name }}</span>
                                            </div>
                                            <div class="col-4">
                                                <span>
                                                    <input type="checkbox" name="category_id[]"
                                                        {{ in_array($row->id, $assignData['assigned']->toArray()) ? 'checked' : '' }}
                                                        value="{{ $row->id }}">
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
