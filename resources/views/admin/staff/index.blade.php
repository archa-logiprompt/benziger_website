

@extends('admin.admin_layouts');
@section('body');
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Staff</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.staff.create')}}" class="btn btn-primary btn-round me-2"><i class="fa fa-plus"></i>
                Add Staff</a>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Staff List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr><th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                @foreach($staff as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->description}}</td>
                    <td>{{ $row->email	 }}</td>

                    
                    <td>
                        <a href="{{ URL::to('admin/staff/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{ URL::to('admin/staff/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                                 </tfoot>
                         
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection