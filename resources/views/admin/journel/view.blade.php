@extends('admin.admin_layouts');
@section('body')
    @php
        $userId = Auth::user()->id;
        $journalId = $journalDataById[0]->journal_id;
        $email = $journalDataById[0]->email;
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
                        <h4 class="card-title">Jorunel View</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <form action="{{ route('journal.accept') }}" method="POST">
                                    @csrf
                                    <div class="d-flex flex-wrap">
                                        @foreach ($journalDataById as $row)
                                            <div class="card m-2 flex-grow-1" style="width: 500px;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $row->name }}</h5>
                                                    <p><strong>Paper Title:</strong> {{ $row->paper_title }}</p>
                                                    <div class="row">
                                                        <div class="row">
                                                            <p><strong>Abstract:</strong> </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-10">

                                                                {{ $row->abstract }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="mt-2"><strong>Research Area:</strong>
                                                        {{ $row->research_area }}
                                                    </p>
                                                    <p><strong>Mobile:</strong> +{{ $row->country_code }}
                                                        {{ $row->mobile }}
                                                    </p>
                                                    <p><strong>Paper:</strong> {{ $row->paper }}</p>
                                                    <p><strong>Keywords:</strong> {{ $row->key_words }}</p>
                                                    <input type="hidden" value={{ $row->journal_id }}>
                                                </div>
                                                <input type="hidden" name="staffid" value={{ $userId }}>
                                                <input type="hidden" name="journelid" value={{ $journalId }}>
                                                <input type="hidden" name="email" value={{ $email }}>
                                                <div class="card-footer">
                                                    <button type="submit" href="" class="btn btn-success btn-sm">
                                                        <i class="fa-solid fa-check"></i> Approve
                                                    </button>
                                                    <a class="btn btn-danger btn-sm" id="modal-popup-button">
                                                        <i class="fa-solid fa-ban"></i> Reject
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
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
                    <h4 class="modal-title">Reject this Jorunel !</h4>
                    <button type="button" class="close" id='close-modal-btn'>&times;</button>
                </div>
                <form action="{{ route('journal.reject') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>Reason for Rejecting the Jorunel *</p>
                        <textarea class="form-control" name="reason" Placeholder="Enter the reason for rejecting this journel"></textarea>
                        <input type="hidden" name="staffid" value={{ $userId }}>
                        <input type="hidden" name="journelid" value={{ $journalId }}>
                        <input type="hidden" name="email" value={{ $email }}>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id='close-modal-btn' class="btn  btn-outline-danger"
                            data-dismiss="modal">Reject</button>
                    </div>
                </form>
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
