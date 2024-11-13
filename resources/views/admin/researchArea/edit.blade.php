@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Research Area</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.researcharea')}}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                View Research Area</a>
        </div>
    </div>

    <form action="{{ url('admin/researcharea/update/'.$service->id) }}" method="post">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="">Research Area *</label>
                <input type="text" name="researchArea" class="form-control" value="{{ $service->researchArea }}" autofocus>
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="description" class="form-control" value="{{  $service->description }}" autofocus>
            </div>
        </div>

        <div class="card-body">


            <button type="submit" class="btn btn-success">Update</button>
        </div>
</div>
</form>
</div>
@endsection