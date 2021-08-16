@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan Schedule
        </h1>
    </div>
    <div class="panel-tag mt-5 bg-info">
        <div class="row">
            <div class="col-md-6"><h2 class="text-center" style="color:#fff"> Borrower Name: <span class="text-default">{{ $borrower_name }}</span></h2></div>
            <div class="col-md-6"><h2 class="text-center" style="color:#fff"> Legal Loan ID: <span class="text-default">{{ $legal_loan_id }}</span></h2></div>
        </div>
    </div>
    <div class="panel-tag mt-5 shadow">
        <div class="row">
            <div class="col-md-4"><h4> Outstanding Balance: <span class="text-info">{{ number_format($outstanding_balance,2,',','.') }}</span></h4></div>
            <div class="col-md-4"><h4> Paid Amount: <span class="text-info">{{ number_format($schdule,2,',','.') }}</span></h4></div>
            <div class="col-md-4"><h4> Total Amount: <span class="text-info">{{ number_format($loan_payment,2,',','.') }}</span></h4></div>
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
                                                {{-- <a href="{{ route('show.schdule',$item->id) }}" class="btn btn-sm btn-primary">View</a> --}}
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal_{{ $item->id }}">
                                                    View
                                                </button>
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
                                            <td>{{ number_format( $item->payment_amount, 2, ',', '.') }}</td>
                                            <td>{{ number_format($item->interest_amount, 2, ',', '.') }}</td>
                                            <td>{{date('d-m-Y', strtotime( $item->payment_date )) }}</td>
                                            <td>{{ $item->payment_note }}</td>
                                            <td>
                                                {{-- <a href="{{ route('show.mg.payment',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.mg.payment',$item->id) }}" class="btn btn-sm btn-info">Edit</a> --}}
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewPayment_{{ $item->id }}">
                                                    View
                                                </button>
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



  <!-- Schdule Modal Start Here -->
    @foreach ($data as $row)
        <div class="modal fade" id="exampleModal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('update.mg.schdule',$row->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="loan_id" value="{{ $row->loan_id }}"/>
                                <div class="form-group row">
                                    <label for="principal_payment" class="col-md-4 col-form-label text-md-right">Principle Payment</label>

                                    <div class="col-md-6">
                                        <input id="principal_payment" type="text" class="form-control" value="{{ $row->principal_payment }}" placeholder="Principal Payment" name="principal_payment" value="{{ old('principal_payment') }}" required autocomplete="lender_name" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="interest_payment" class="col-md-4 col-form-label text-md-right">Interest Payment</label>

                                    <div class="col-md-6">
                                        <input id="interest_payment" type="text" class="form-control" value="{{ $row->interest_payment }}" placeholder="Interest Payment" name="interest_payment" value="{{ old('interest_payment') }}" required autocomplete="interest_payment">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expected_payment" class="col-md-4 col-form-label text-md-right">Expected Payment</label>

                                    <div class="col-md-6">
                                        <input id="expected_payment" type="text" class="form-control" value="{{ $row->expected_payment }}" placeholder="Expected Payment" name="expected_payment" required autocomplete="identity_type">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expected_payment_date" class="col-md-4 col-form-label text-md-right">Expected Payment Date</label>

                                    <div class="col-md-6">
                                        <input id="expected_payment_date" type="text" class="form-control date" placeholder="DD/MM/YYYY" value="{{ date('d-m-Y', strtotime($row->expected_payment_date)) }}" placeholder="Expected Payment Date" name="expected_payment_date" required autocomplete="expected_payment_date">
                                    </div>
                                </div>


                                {{-- <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update Schedule
                                        </button>
                                    </div>
                                </div> --}}

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewModal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="form-group row">
                                <label for="principal_payment" class="col-md-4 col-form-label text-md-right">Principle Payment</label>

                                <div class="col-md-6">
                                    <input id="principal_payment" type="text" readonly class="form-control" value="{{ $row->principal_payment }}" placeholder="Principal Payment" name="principal_payment" value="{{ old('principal_payment') }}" required autocomplete="lender_name" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="interest_payment" class="col-md-4 col-form-label text-md-right">Interest Payment</label>

                                <div class="col-md-6">
                                    <input id="interest_payment" type="text" readonly class="form-control" value="{{ $row->interest_payment }}" placeholder="Interest Payment" name="interest_payment" value="{{ old('interest_payment') }}" required autocomplete="interest_payment">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expected_payment" class="col-md-4 col-form-label text-md-right">Expected Payment</label>

                                <div class="col-md-6">
                                    <input id="expected_payment" type="text" readonly class="form-control" value="{{ $row->expected_payment }}" placeholder="Expected Payment" name="expected_payment" required autocomplete="identity_type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expected_payment_date" class="col-md-4 col-form-label text-md-right">Expected Payment Date</label>

                                <div class="col-md-6">
                                    <input id="expected_payment_date" type="text" readonly class="form-control date" value="{{ date('d-m-Y', strtotime($row->expected_payment_date)) }}" placeholder="Expected Payment Date" name="expected_payment_date" required autocomplete="expected_payment_date">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Schdule End Here --}}
    {{-- Payment Modal Start Here --}}
        @foreach ($data_payment as $row )
            <div class="modal fade" id="editPayment_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('update.mg.payment',$row->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $row->loan_id }}" name="loan_id"/>
                                    <div class="form-group row">
                                        <label for="payment_amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                                        <div class="col-md-6">
                                            <input id="payment_amount" type="text" class="form-control" value="{{ $row->payment_amount }}" placeholder="Payment Amount" name="payment_amount" value="{{ old('payment_amount') }}" required autocomplete="lender_name" autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="interest_amount" class="col-md-4 col-form-label text-md-right">Interest Amount</label>

                                        <div class="col-md-6">
                                            <input id="interest_amount" type="text" class="form-control" value="{{ $row->interest_amount }}" placeholder="Payment Interest Amount" name="interest_amount" value="{{ old('interest_amount') }}" required autocomplete="interest_amount" autofocus>


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="payment_date" class="col-md-4 col-form-label text-md-right">Payment Date</label>

                                        <div class="col-md-6">
                                            <input id="payment_date" type="text" class="form-control date" placeholder="DD/MM/YYYY" value="{{ date('d-m-Y', strtotime($row->payment_date)) }}" placeholder="Payment Date" name="payment_date" required autocomplete="payment_date">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="payment_note" class="col-md-4 col-form-label text-md-right">Payment Note</label>

                                        <div class="col-md-6">
                                            <input id="payment_note" type="text" class="form-control" value="{{ $row->payment_note }}" placeholder="Payment Note" name="payment_note" required autocomplete="payment_note">
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update Payment
                                            </button>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewPayment_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form >
                                @csrf
                                <div class="form-group row">
                                    <label for="payment_amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                                    <div class="col-md-6">
                                        <input id="payment_amount" readonly  type="text" class="form-control" value="{{ $row->payment_amount }}" placeholder="Payment Amount" name="payment_amount" value="{{ old('payment_amount') }}" required autocomplete="lender_name" autofocus>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="interest_amount" class="col-md-4 col-form-label text-md-right">Interest Amount</label>

                                    <div class="col-md-6">
                                        <input id="interest_amount" readonly  type="text" class="form-control" value="{{ $row->interest_amount }}" placeholder="Payment Interest Amount" name="interest_amount" value="{{ old('interest_amount') }}" required autocomplete="interest_amount" autofocus>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payment_date" class="col-md-4 col-form-label text-md-right">Payment Date</label>

                                    <div class="col-md-6">
                                        <input id="payment_date" readonly type="text" class="form-control date" placeholder="DD/MM/YYYY" value="{{ date('d-m-Y', strtotime($row->payment_date)) }}" placeholder="Payment Date" name="payment_date" required autocomplete="payment_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="payment_note" class="col-md-4 col-form-label text-md-right">Payment Note</label>

                                    <div class="col-md-6">
                                        <input id="payment_note" readonly type="text" class="form-control" value="{{ $row->payment_note }}" placeholder="Payment Note" name="payment_note" required autocomplete="payment_note">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    {{-- Payment Modal End Here --}}
@endsection

