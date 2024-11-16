@extends('admin.admin_layouts')
@section('body')
    <div class="container">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Update Department</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('department') }}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                    View Department</a>
            </div>
        </div>
        <form action="{{ url('admin/department/update/' . $service->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ $service->name }}" autofocus>
                    @if ($errors->has('name'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control " cols="30" rows="10">{{ $service->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Existing Photo</label>
                    <div>
                        <img src="{{ asset($service->image) }}" style="height: 90px; width: 120px;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Change Photo *</label>
                    <div>
                        <input type="file" name="image" accept="image/*">
                        @if ($errors->has('image'))
                            <div class="alert alert-danger mt-2">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
    </div>
    </form>
    </div>
@endsection
