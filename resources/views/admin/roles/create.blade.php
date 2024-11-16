@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Add New Role</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.roles.view')}}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                View Role</a>
        </div>
    </div>


    <form action="{{route('admin.role.store')}}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" class="form-control">
            @if ($errors->has('name'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('name') }}
                </div>
                @endif
        </div>

        <div class="form-group">
            <label for="name">Short name</label>
            <input type="text" name="short_name" class="form-control">
        </div>
    
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
@endsection