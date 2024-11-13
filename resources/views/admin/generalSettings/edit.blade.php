@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit General Settings</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('department') }}" class="btn btn-primary btn-round me-2">
                <i class="fas fa-list"></i> View Settings
            </a>
        </div>
    </div>
    <form action="{{ url('admin/department/update/'.$settings->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="">Existing Logo</label>
                <div>
                    <img src="{{ asset('storage/'.$settings->image) }}" style="height: 90px; width: 120px;">
                </div>
            </div>

            <div class="form-group">
                <label for="">Change Logo</label>
                <div>
                    <input type="file" name="logo" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label for="">Contact</label>
                <input type="text" name="contact" class="form-control" value="{{ old('contact', $settings->contact) }}" autofocus>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $settings->email) }}" autofocus>
            </div>

            <div class="form-group">
                <label for="">Address Line 1</label>
                <textarea name="address_line1" class="form-control" cols="30" rows="4">{{ old('address_line1', $settings->address_line1) }}</textarea>
            </div>

            <div class="form-group">
                <label for="">Address Line 2</label>
                <textarea name="address_line2" class="form-control" cols="30" rows="4">{{ old('address_line2', $settings->address_line2) }}</textarea>
            </div>

            <div class="form-group">
                <label for="">City</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $settings->city) }}">
            </div>

            <div class="form-group">
                <label for="">State</label>
                <input type="text" name="state" class="form-control" value="{{ old('state', $settings->state) }}">
            </div>

            <div class="form-group">
                <label for="">Country</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $settings->country) }}">
            </div>

            <div class="form-group">
                <label for="">Postal Code</label>
                <input type="text" name="postalCode" class="form-control" value="{{ old('postalCode', $settings->postalCode) }}">
            </div>

            <div class="form-group">
                <label for="">API Key</label>
                <input type="text" name="apiKey" class="form-control" value="{{ old('apiKey', $settings->apiKey) }}">
            </div>

            <div class="form-group">
                <label for="">API Secret</label>
                <input type="text" name="apiSecret" class="form-control" value="{{ old('apiSecret', $settings->apiSecret) }}">
            </div>

            <div class="form-group">
                <label for="">Payment</label><br>
                <label>
                    <input type="radio" name="payment" value="0" {{ $settings->payment == "0" ? "checked" : "" }}> No
                </label>
                <label>
                    <input type="radio" name="payment" value="1" {{ $settings->payment == "1" ? "checked" : "" }}> Yes
                </label>
            </div>

            <div class="form-group">
                <label for="">Amount</label>
                <input type="text" name="amount" class="form-control" value="{{ old('amount', $settings->amount) }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection
