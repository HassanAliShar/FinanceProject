@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan
        </h1>
        <a href="{{ route('add.loan') }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add Loan
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Loan <span class="fw-300"><i>info</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            Import <code>Loan</code> Excel Sheet.
                            <hr/>
                            <form action="{{ route('import.loan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="borrower_id" class="">Select Borrower</label>
                                        <select class="form-control" name="borrower_id">
                                                <option>--Select Loan--</option>
                                            @if (count($borrower) != 0)
                                                @foreach ($borrower as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="excel_file" class="">Select Sheet</label>
                                        <input id="excel_file" type="file" name="excel_file" class="form-control" required autocomplete="excel_file" autofocus>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            Import
                                        </button>
                                        <a download class="btn btn-success mt-1 ml-auto" href="{{ asset('excel_formates/loan.xlsx') }}">
                                            Sheet Example Format
                                        </a>

                                    </div>
                                    <div class="col-md-3">
                                        <a download class="btn btn-success mt-4 ml-auto" href="{{ route('export.loan') }}">
                                            Eport Data
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- datatable start -->
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>
                                        <th>Lender Name</th>
                                        <th>Legal Loan Id</th>
                                        <th>Loan Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Interest Type</th>
                                        <th>Initial Amount</th>
                                        <th>Payment/Schedules</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->lender_name }}</td>
                                            <td>{{ $item->legal_loan_id }}</td>
                                            <td>{{ $item->loan_type }}</td>
                                            <td>{{ date('d-m-Y', strtotime( $item->start_date )) }}</td>
                                            <td>{{ date('d-m-Y', strtotime( $item->end_date)) }}</td>
                                            <td>{{ $item->interest_type }}</td>
                                            <td>{{ number_format( $item->initial_amount, 2, ',', '.')  }}</td>
                                            <td><a href="{{ route('manage.schedule',$item->id) }}" class="btn btn-sm btn-primary">Payment/Schedules</a></td>
                                            <td>
                                                <a href="{{ route('show.loan',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.loan',$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('delete.loan',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>

                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Lender Name</th>
                                        <th>Legal Loan Id</th>
                                        <th>Loan Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Interest Type</th>
                                        <th>Initial Amount</th>
                                        <th>Payment/Schedules</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

