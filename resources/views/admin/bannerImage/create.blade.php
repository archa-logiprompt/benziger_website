@extends('admin.admin_layouts')

@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Create Banner Images</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('admin.bannerImage') }}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i> View Banners</a>
        </div>
    </div>

    <!-- banner image Create Form -->
    <form action="{{ route('admin.bannerImage.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
           
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" autofocus>
                @if ($errors->has('title'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="picture">Picture *</label>
                <input type="file" name="picture" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp">
                @if ($errors->has('picture'))   
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('picture') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
