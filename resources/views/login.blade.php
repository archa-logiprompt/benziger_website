@extends('assets.css')
@section('content')
<style>
    .bg-gradient-yellow {
    background: linear-gradient(to right, yellow, blue);
}

</style>
    <section class="bg-gradient-emerald-white-emerald-green vh-100 md-h-100">
        <div class="container">
            <div class="d-flex justify-content-center">
            <img width="625" height="90" src="https://www.bbconkollam.org/wp-content/uploads/2017/10/logo.jpg" class="custom-logo" alt="Bishop Benziger College of Nursing" srcset="https://www.bbconkollam.org/wp-content/uploads/2017/10/logo.jpg 625w, https://www.bbconkollam.org/wp-content/uploads/2017/10/logo-300x43.jpg 300w" sizes="(max-width: 625px) 100vw, 625px">
            </div>
            <div class="row align-items-center d-flex">
                <div class="row p-5 rounded">
                <div class="col-12 text-center fw-bold fs-4 p-3" style="color: #e44190">
    <span>Admin Login</span>
</div>

                    

                    <img class="bg-gradient-yellow d-none d-md-block col-md-6 px-0" 
     src="{{asset('uploads/benzigerimage.jpg')}}">


                    <div class="bg-gradient-emerald-blue p-4 col-12 col-md-6">
                        <form action="{{ route('check.login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label text-white">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="email">
                                <div class="error text-danger">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
                                <div class="error text-danger">{{ $errors->first('password') }}</div>
                            </div>

                            <button type="submit"
                                class="btn btn-round-edge with-rounded btn-gradient-fast-blue-purple btn-box-shadow text-white">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
