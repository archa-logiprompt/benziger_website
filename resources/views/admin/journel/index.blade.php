@extends('admin.admin_layouts');
@section('body')
    @php
        $userId = Auth::user()->id;
        $role = Auth::user()->role;
    @endphp
    <div class="container">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Jorunel</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                {{-- <a href="{{route('admin.staff.create')}}" class="btn btn-primary btn-round me-2"><i class="fa fa-plus"></i>
                Add Staff</a> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jorunel List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Paper title</th>
                                        <th>Research Area</th>
                                        <th>Mobile </th>
                                        <th>paper</th>
                                        <th>abstract</th>
                                        <th>keyword</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                    @foreach ($journalData as $row)
                                        @if ($row->staff_id == $userId || $role == 1)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->paper_title }}</td>
                                                <td>{{ $row->department_id }}</td>
                                                <td>+{{ $row->country_code }} {{ $row->mobile }}</td>
                                                <td>{{ $row->paper }}</td>
                                                <td>
                                                    {{ $truncated = Str::of($row->abstract)->limit(20) }}</td>
                                                <td>{{ $row->key_words }}</td>
                                                <td>
                                                    <a href="{{ URL::to('staff/journal/viewById/' . $row->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tfoot>

                            </table>
                            {{-- <button id="modal-popup-button" type="button" class="btn btn-danger btn-sm"><i
                                    class="fa-solid fa-xmark"></i></button> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="modal fade" id="myModal" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='close-modal-btn' class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('#modal-popup-button').on('click', function() {
                $('#myModal').modal('show')
            })

            $('#close-modal-btn').on('click', function() {
                $('#myModal').modal('hide')
            })

        })
    </script>
@endsection
