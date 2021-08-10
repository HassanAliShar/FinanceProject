@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Requested Loan
        </h1>
        <a href="{{ route('add.mg.loan') }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add Loan
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Requested Loan <span class="fw-300"><i>info</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
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
                                        <th>Type</th>
                                        <th>Status</th>
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
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('view_requested.mg.loan',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('delete_req.mg.loan',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
                                        <th>Type</th>
                                        <th>Status</th>
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

