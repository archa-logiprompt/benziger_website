@extends('admin.admin_layouts')
@section('body')
<div class="container">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">General Settings</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('admin.generalsettings') }}" class="btn btn-primary btn-round me-2"><i class="fas fa-list"></i> View Settings</a>
        </div>
    </div>

    <form action="{{ route('admin.generalsettings.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="logo">Logo</label>
                <div>
                    <input type="file" name="logo" accept="image/*">
                    @if ($errors->has('logo'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                </div>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" class="form-control" value="{{ old('contact') }}" autofocus>
                @if ($errors->has('contact'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}" autofocus>
                @if ($errors->has('email'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            
            <div class="form-group">
                <label for="whatsappContact">Whatsapp number</label>
                <input type="text" name="whatsappContact" class="form-control" value="{{ old('whatsappContact') }}" autofocus>
                @if ($errors->has('whatsappContact'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('whatsappContact') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="address_line1">Address Line 1</label>
                <textarea name="address_line1" class="form-control" cols="30" rows="2">{{ old('address_line1') }}</textarea>
                @if ($errors->has('address_line1'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('address_line1') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="address_line2">Address Line 2</label>
                <textarea name="address_line2" class="form-control" cols="30" rows="2">{{ old('address_line2') }}</textarea>
                @if ($errors->has('address_line2'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('address_line2') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                @if ($errors->has('city'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                @if ($errors->has('state'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('state') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="{{ old('country') }}" autofocus>
                @if ($errors->has('country'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('country') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" name="postalCode" class="form-control" value="{{ old('postalCode') }}" autofocus>
                @if ($errors->has('postalCode'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('postalCode') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="apiKey">API Key</label>
                <input type="text" name="apiKey" class="form-control" value="{{ old('apiKey') }}" autofocus>
                
            </div>

            <div class="form-group">
                <label for="apiSecret">API Secret</label>
                <input type="text" name="apiSecret" class="form-control" value="{{ old('apiSecret') }}" autofocus>
            </div>

            <div class="form-group">
                <label for="payment">Payment</label><br>
                <label>
                    <input type="radio" name="payment" value="0" {{ old('payment') == "0" ? "checked" : "" }} onclick="toggleAmountField()"> No
                </label>
                <label>
                    <input type="radio" name="payment" value="1" {{ old('payment') == "1" ? "checked" : "" }} onclick="toggleAmountField()"> Yes
                </label>
                @if ($errors->has('payment'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('payment') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" {{ old('payment') == "1" ? '' : 'disabled' }}>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleAmountField() {
        const paymentYes = document.querySelector('input[name="payment"][value="1"]');
        const amountField = document.getElementById('amount');
        
        amountField.disabled = !paymentYes.checked;
    }

    document.addEventListener('DOMContentLoaded', toggleAmountField);
</script>
@endsection
