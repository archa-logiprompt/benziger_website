@php

    $journalId = $journalDataById[0]->journal_id;
    $email = $journalDataById[0]->email;
    $name = $journalDataById[0]->name;
    $title = $journalDataById[0]->paper_title;
    $departmentId = $journalDataById[0]->department_id;
    $Id = $journalDataById[0]->id;
    // dd($Id);
@endphp


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Jorunel View</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container">
                        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
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

                                            <p class="mt-2"><strong>Department:</strong>
                                                {{ $row->dname }}
                                            </p>
                                            <p><strong>Mobile:</strong> +{{ $row->country_code }}
                                                {{ $row->mobile }}
                                            </p>
                                            <p><strong>Paper:</strong> <input type="file" name="file"
                                                    id="file" required>
                                            </p>
                                            <p><strong>Keywords:</strong> {{ $row->key_words }}</p>
                                        </div>
                                        {{-- <input type="hidden" value={{ $row->journal_id }}> --}}
                                        <input type="hidden" name="id" value={{ $Id }}>
                                        <input type="hidden" name="journelid" value={{ $journalId }}>
                                        {{-- <input type="hidden" name="email" value={{ $email }}>
                                        <input type="hidden" name="departmentid" value={{ $departmentId }}> --}}
                                        {{-- @if ($role == 2 && !checkJournalStatus($userId, $journalId))
                                            <div class="card-footer">

                                                <button type="submit" href="" class="btn btn-success btn-sm">
                                                    <i class="fa-solid fa-check"></i> Approve
                                                </button>
                                                <a class="btn btn-danger btn-sm" id="modal-popup-button">
                                                    <i class="fa-solid fa-ban"></i> Reject
                                                </a>

                                            </div>
                                        @endif --}}
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit">Resubmit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
