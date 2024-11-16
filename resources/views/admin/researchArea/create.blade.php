@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Add new Research Area</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.researcharea')}}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                View Research Area</a>
        </div>
    </div>
    <form action="{{ route('admin.researcharea.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}" autofocus>
                @if ($errors->has('description'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

</div>
</form>
</div>
@endsection