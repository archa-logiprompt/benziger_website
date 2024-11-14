@extends('admin.admin_layouts')
@section('body')
<?php $currentPage = 'admin.generalsettings'; ?>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">General Settings</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                @if($settings->isEmpty())
                <a href="{{ route('admin.generalsettings.create') }}" class="btn btn-primary btn-round me-2" >
                    <i class="fa fa-plus"></i> Add General Settings
                </a>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Whatsapp contact</th>
                                        <th>Address Line 1</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Postal Code</th>
                                        <th>API Key</th>
                                        <th>API Secret</th>
                                        <th>Payment Status</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset($row->logo) }}" style="height: 90px; width: 120px;"></td>
                                        <td>{{ $row->contact }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->whatsappContact }}</td>
                                        <td>{{ $row->address_line1 }}</td>
                                        <td>{{ $row->city }}</td>
                                        <td>{{ $row->state }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->postalCode }}</td>
                                        <td>{{ $row->apiKey }}</td>
                                        <td>{{ $row->apiSecret }}</td>
                                        <td>{{ $row->payment ? 'Yes' : 'No' }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/generalsettings/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ URL::to('admin/generalsettings/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection