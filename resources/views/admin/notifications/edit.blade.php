@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Notifications</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('admin.notifications') }}" class="btn btn-primary btn-round me-2">
                <i class="fas fa-list"></i> View Notifications
            </a>
        </div>
    </div>
    <form action="{{ url('admin/notifications/update/'.$data->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}" autofocus>
                @if ($errors->has('title'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="4">{{ old('description', $data->description) }}</textarea>
                @if ($errors->has('description'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="">Existing Image</label>
                <div>

                    <img src="{{ asset($data->image) }}" style="height: 90px; width: 120px;">
                </div>
            </div>

            <div class="form-group">
                <label for="">Change Image</label>
                <div>
                    <input type="file" name="image" accept="image/*">
                    @if ($errors->has('image'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                </div>
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection
