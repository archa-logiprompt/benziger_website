@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Add New Staff</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.staff')}}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                View Staff</a>
    </div>
    </div>
    

<form action="{{route('admin.staff.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
    <label for="name">Name </label>
   <input type="text" name="name" class="form-control">

    </div> <div class="form-group">
   <label for="email"> Email</label>
   <input type="email" name="email" class="form-control">
</div> <div class="form-group">
   <label for="">Phone Number</label>
   <input type="number" name="phone" class="form-control ">
   </div> <div class="form-group">
<label for="password"> Password</label>
<input type="text" name="password" class="form-control">
</div> <div class="form-group">
<label for="">Department</label>
<select class="form-control" name="department_id">
    @foreach($department as $item)
      <option value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
  </select>
</div> <div class="form-group">
<label for="">Description</label>
{{-- <input type="text" name="description" class="form-control"> --}}
<textarea  name="description" class="form-control"></textarea>
</div>
<div class="form-group">
<button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
@endsection