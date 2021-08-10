@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan Schedule
        </h1>
        <a href="{{ route('add.schdule',$id) }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add Loan Sechdule
        </a>
    </div>
    <div class="panel-tag mt-5">
        <div class="row">
            <div class="col-md-4"><h4> Outstanding Balance: <span class="text-info">{{ number_format($outstanding_balance,2,',','.') }}</span></h4></div>
            <div class="col-md-4"><h4> Paid Balance: <span class="text-info">{{ number_format($schdule,2,',','.') }}</span></h4></div>
            <div class="col-md-4"><h4> Total Balance: <span class="text-info">{{ number_format($loan_payment,2,',','.') }}</span></h4></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Loan Schedule <span class="fw-300"><i>info</i></span>
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
                            Import <code>Loan Schedule</code> Excel Sheet.
                            <hr/>
                            <form action="{{ route('import.schdule') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" value="{{ $id }}" name="loan_id"/>
                                    <div class="col-md-3">
                                        <label for="excel_file" class="">Select Sheet</label>
                                        <input id="excel_file" type="file" name="excel_file" class="form-control" required autocomplete="excel_file" autofocus>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Import
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a download class="btn btn-success mt-4" href="{{ asset('excel_formates/loan_schdules.xlsx') }}">
                                           Sheet Example Format
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-success mt-4" href="{{ route('export.schdule') }}">
                                            Export Data
                                         </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- datatable start -->
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>

                                        <th>Principal Payment</th>
                                        <th>Interest Payment</th>
                                        <th>Expected Payment</th>
                                        <th>Expected Payment Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td>{{number_format( $item->principal_payment, 2, ',', '.') }}</td>
                                            <td>{{ number_format( $item->interest_payment , 2, ',', '.') }}</td>
                                            <td>{{ number_format( $item->expected_payment , 2, ',', '.') }}</td>
                                            <td>{{ date('d-m-Y', strtotime( $item->expected_payment_date )) }}</td>
                                            <td>
                                                {!! $item->getStatus() !!}
                                            </td>

                                            <td>
                                                <a href="{{ route('paid.schdule',$item->id) }}" class="btn btn-sm btn-success">Paid</a>
                                                <a href="{{ route('show.schdule',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.schdul',$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('delete.schdule',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Principal Payment</th>
                                        <th>Interest Payment</th>
                                        <th>Expected Payment</th>
                                        <th>Expected Payment Date</th>
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

<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan Payment
        </h1>
        <a href="{{ route('add.payment',$id) }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add Loan Payment
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Loan Payment <span class="fw-300"><i>info</i></span>
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
                            Import <code>Loan Payment</code> Excel Sheet.
                            <hr/>
                            <form action="{{ route('import.payment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    {{-- <div class="col-md-6">
                                        <label for="borrower_id" class="">Select Loan</label>
                                        <select class="form-control" name="loan_id">
                                                <option>--Select Loan--</option>
                                            @if (count($loan) != 0)
                                                @foreach ($loan as $row)
                                                    <option value="{{ $row->id }}">{{ $row->lender_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> --}}
                                    <input type="hidden" value="{{ $id }}" name="loan_id"/>
                                    <div class="col-md-3">
                                        <label for="excel_file" class="">Select Sheet</label>
                                        <input id="excel_file" type="file" name="excel_file" class="form-control" required autocomplete="excel_file" autofocus>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Import
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a download class="btn btn-success mt-4" href="{{ asset('excel_formates/loan_payments.xlsx') }}">
                                           Sheet Example Format
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-success mt-4" href="{{ route('export.payment') }}">
                                           Export Data
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- datatable start -->
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>

                                        <th>Payment Amount</th>
                                        <th>Interest Amount</th>
                                        <th>Payment Date</th>
                                        <th>Payment Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_payment as $item)

                                        <tr>
                                            <th>{{ number_format( $item->payment_amount, 2, ',', '.') }}</th>
                                            <th>{{ $item->interest_amount }}</th>
                                            <th>{{date('d-m-Y', strtotime( $item->payment_date )) }}</th>
                                            <th>{{ $item->payment_note }}</th>
                                            <td>
                                                <a href="{{ route('show.payment',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.payment',$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('delete.payment',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Payment Amount</th>
                                        <th>Interest Amount</th>
                                        <th>Payment Date</th>
                                        <th>Payment Note</th>
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

