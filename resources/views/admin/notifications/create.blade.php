@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Notifications</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('admin.notifications') }}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i> View Notifications</a>
        </div>
    </div>

    <form action="{{ route('admin.notifications.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="contact">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" autofocus>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="2">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <div>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection

