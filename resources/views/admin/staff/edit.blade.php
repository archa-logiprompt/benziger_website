@extends('admin.admin_layouts');
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Staff</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{route('admin.staff')}}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i></i>
                View Staff</a>
    </div>
    </div>
<form action="{{url('admin/staff/update/'.$staffdetails->id)}}" method="post" enctype="multipart/form-data">
    @csrf


 <div class="form-group">
    <label for="">Name</label>   
<input type="text" name="name" value="{{ $staffdetails->name }}" class="form-control">
 </div>
  <div class="form-group">
<label for="">Email</label>
<input type="email" name="email" value="{{$staffdetails->email}}" class="form-control"></div>
<div class="form-group">
<label for="">Phone</label>
<input type="number" name="phone" id="" value="{{$staffdetails->phone}}" class="form-control"></div>
<div class="form-group">
<label for="">Password</label>
<input type="text" name="password" value="{{$staffdetails->password}}" class="form-control">
</div> <div class="form-group">
<label for="">Department</label>
{{-- <input type="text" name="department_id" value="{{$staffdetails->dname}}" class="form-control"> --}}
<select class="form-control" id="type" name="department_id">
    @foreach($department as $user)
        <option value="{{ $user->id }}" {{ $user->id == $staffdetails->department_id ? 'selected' : '' }}>{{ $user->name }}</option>
    @endforeach
</select>
</div> <div class="form-group">
<label for="">Description</label>
<input type="text" name="description" value="{{$staffdetails->description}}" class="form-control">
</div> <div class="form-group">
<button type="submit" value="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
@endsection