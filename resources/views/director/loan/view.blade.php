@extends('home')

@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> View Loan
        </h1>
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
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.mg.loan',$data->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="loan_id" value="{{ $data->id }}"/>
                                <div class="form-group row">
                                    <div class="col-md-4 mb-3">
                                        <label for="borrower_id" >Select Borrower</label>
                                        <select class="form-control" disabled name="borrower_id">
                                            <option>Select Borrower Id</option>
                                            @if (count($borrower) > 0)
                                                @foreach ($borrower as $row)
                                                    @if ($row->id == $data->borrower_id)
                                                        <option selected value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @else
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="lender_name">Lender Name</label>
                                        <input id="lender_name" type="text" class="form-control" readonly value="{{ $data->lender_name }}" placeholder="Lender Name" name="lender_name" value="{{ old('lender_name') }}" required autocomplete="lender_name" autofocus>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="legal_loan_id" >Legal Loan ID</label>
                                        <input id="legal_loan_id" type="text" class="form-control" readonly value="{{ $data->legal_loan_id }}" placeholder="Loan Id" name="legal_loan_id" value="{{ old('legal_loan_id') }}" required autocomplete="legal_loan_id">

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="loan_internal_number" >Loan Internal Number</label>
                                        <input id="loan_internal_number" type="text" class="form-control" readonly value="{{ $data->loan_internal_number }}" placeholder="Loan Internal Number" name="loan_internal_number" required autocomplete="loan_internal_number">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="loan_type" >Loan Type</label>
                                        <input id="loan_type" type="text" class="form-control" readonly value="{{ $data->loan_type }}" placeholder="Loan Type" name="loan_type" required autocomplete="loan_type">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="loan_status" >Loan Status</label>
                                        <input id="loan_status" type="text" class="form-control" readonly value="{{ $data->loan_status}}" placeholder="Loan Status" name="loan_status" required autocomplete="loan_status">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="loan_reason" >Loan Reason</label>
                                        <input id="loan_reason" type="text" class="form-control" readonly value="{{ $data->loan_reason }}" placeholder="Loan Reason" name="loan_reason" required autocomplete="loan_reason">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="start_date" >Start Date</label>
                                        <input id="start_date" type="date" class="form-control" readonly value="{{ $data->start_date }}" placeholder="start_date" name="start_date" required autocomplete="start_date">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="end_date" >Loan End Date</label>
                                        <input id="end_date" type="date" class="form-control" readonly value="{{ $data->end_date }}" name="end_date" required autocomplete="end_date">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="interest_type" >Interest Type</label>
                                        <input id="interest_type" type="text" class="form-control" readonly value="{{ $data->interest_type }}" placeholder="Interest Type" name="interest_type" required autocomplete="interest_type">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="interest_rate" >Interest Rate</label>
                                        <input id="interest_rate" type="number" class="form-control" readonly value="{{ $data->interest_rate }}" placeholder="Interest Rate" name="interest_rate" required autocomplete="interest_rate">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="initial_amount" >Loan Initial Amount</label>
                                        <input id="initial_amount" type="text" class="form-control" readonly value="{{ $data->initial_amount }}" placeholder="Loan Initial Amount" name="initial_amount" required autocomplete="initial_amount">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="tenor" >Loan Tenor</label>
                                        <input id="tenor" type="text" class="form-control" readonly value="{{ $data->tenor }}" placeholder="Loan Tenor" name="tenor" required autocomplete="tenor">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="payment_period" >Loan Payment Period</label>
                                        <input id="payment_period" type="text" class="form-control" readonly value="{{ $data->payment_period }}" placeholder="Loan Payment Period" name="payment_period" required autocomplete="payment_period">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="administration_charges" >Administration Charges</label>
                                        <input id="administration_charges" type="text" class="form-control" readonly value="{{ $data->administration_charges }}" placeholder="Administration Charges" name="administration_charges" required autocomplete="administration_charges">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="government_charges" >Government Charges</label>
                                        <input id="government_charges" type="text" class="form-control" readonly value="{{ $data->government_charges }}" placeholder="Government Charges" name="government_charges" required autocomplete="government_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="agreement_charges" >Agreement Charges</label>
                                        <input id="agreement_charges" type="text" class="form-control" readonly value="{{ $data->agreement_charges }}" placeholder="Agreement Charges" name="agreement_charges" required autocomplete="agreement_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="provision_charges" >Provision Charges</label>
                                        <input id="provision_charges" type="text" class="form-control" readonly value="{{ $data->provision_charges }}" placeholder="Provision Charges" name="provision_charges" required autocomplete="provision_charges">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="skmht_charges" >SKMHT Charges</label>
                                        <input id="skmht_charges" type="text" class="form-control" readonly value="{{ $data->skmht_charges }}" placeholder="SKMHT Charges" name="skmht_charges" required autocomplete="skmht_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="apht_charges" >APHT Charges</label>
                                        <input id="apht_charges" type="text" class="form-control" readonly value="{{ $data->apht_charges }}" placeholder="SKMHT Charges" name="apht_charges" required autocomplete="apht_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="fiduciary_charges" >Fiduciary Charges</label>
                                        <input id="fiduciary_charges" type="text" class="form-control" readonly value="{{ $data->fiduciary_charges }}" placeholder="Fiduciary Charges" name="fiduciary_charges" required autocomplete="fiduciary_charges">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="certificate_charges" >Certificate Charges</label>
                                        <input id="certificate_charges" type="text" class="form-control" readonly value="{{ $data->certificate_charges }}" placeholder="Certificate Charges" name="certificate_charges" required autocomplete="certificate_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="other_charges" >Other Charges</label>
                                        <input id="other_charges" type="text" class="form-control" readonly value="{{ $data->other_charges }}" placeholder="Other Charges" name="other_charges" required autocomplete="other_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="insurance_charges" >Insurance Charges</label>
                                        <input id="insurance_charges" type="text" class="form-control" readonly value="{{ $data->insurance_charges }}" placeholder="Insurance Charges" name="insurance_charges" required autocomplete="insurance_charges">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="notary_charges" >Notary Charges</label>
                                        <input id="notary_charges" type="text" class="form-control" readonly value="{{ $data->notary_charges }}" placeholder="Notary Charges" name="notary_charges" required autocomplete="notary_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="notary_charges" >Public Notary Charges</label>
                                        <input id="notary_charges" type="text" class="form-control" readonly value="{{ $data->notary_charges }}" placeholder="Public Notary Charges" name="notary_charges" required autocomplete="notary_charges">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="collateral" >Collateral</label>
                                        <input id="collateral" type="text" class="form-control" readonly value="{{ $data->collateral }}" placeholder="Collateral" name="collateral" required autocomplete="collateral">
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="bank_account" >Bank Account</label>
                                        <input id="bank_account" type="text" class="form-control" readonly value="{{ $data->bank_account }}" placeholder="Bank Account" name="bank_account" required autocomplete="bank_account">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-12" id="fields">
                                        <label for="bank_account">Customer Field</label>
                                        @if (count($data->fields) > 0)
                                            @foreach ($data->fields as $row)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" value="{{ $row->name }}" class="form-control" readonly placeholder="Field Name" name="field_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input id="bank_account" type="text" value="{{ $row->value }}" class="form-control" readonly placeholder="Value" name="field_value[]" required autocomplete="bank_account">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($data->files) > 0)
                                                @foreach ($data->files as $frow)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" class="form-control" readonly value="{{ $frow->name }}" placeholder="File Name" name="file_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input id="file" type="file" class="form-control" readonly value="{{ asset('BorrowerFiles/'.$frow->value) }}" name="file_value[]" autocomplete="bank_account">
                                                        <img src="{{ asset('public/LoanFiles/'.$frow->value) }}" style="height: 100px; width:100px"/>
                                                    </div>
                                                </div>
                                                @endforeach
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
