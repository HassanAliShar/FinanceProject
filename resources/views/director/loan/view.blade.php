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
                            <form>
                                @csrf
                                <div class="form-group row">
                                    <label for="borrower_id" class="col-md-4 col-form-label text-md-right">Select Borrower</label>

                                    <div class="col-md-6">
                                        <select class="form-control" disabled name="borrower_id">
                                            <option>Select Borrower Id</option>
                                            @if (count($borrower) > 0)
                                                @foreach ($borrower as $row)
                                                    @if ($data->borrower_id == $row->id)
                                                        <option selected value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @else
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lender_name" class="col-md-4 col-form-label text-md-right">Lender Name</label>

                                    <div class="col-md-6">
                                        <input id="lender_name" type="text" readonly class="form-control" value="{{ $data->lender_name }}" placeholder="Lender Name" name="lender_name" value="{{ old('lender_name') }}" required autocomplete="lender_name" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="legal_loan_id" class="col-md-4 col-form-label text-md-right">Legal Loan ID</label>

                                    <div class="col-md-6">
                                        <input id="legal_loan_id" type="text" readonly class="form-control" value="{{ $data->legal_loan_id }}" placeholder="Loan Id" name="legal_loan_id" value="{{ old('legal_loan_id') }}" required autocomplete="legal_loan_id">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="laon_type" class="col-md-4 col-form-label text-md-right">Loan Type</label>

                                    <div class="col-md-6">
                                        <input id="loan_type" type="text" readonly class="form-control" value="{{ $data->loan_type }}" placeholder="Loan Type" name="loan_type" required autocomplete="identity_type">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="start_date" class="col-md-4 col-form-label text-md-right">Start Date</label>

                                    <div class="col-md-6">
                                        <input id="start_date" type="date" readonly class="form-control" value="{{ $data->start_date }}" placeholder="start_date" name="start_date" required autocomplete="start_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="end_date" class="col-md-4 col-form-label text-md-right">Loan End Date</label>

                                    <div class="col-md-6">
                                        <input id="end_date" type="date" readonly value="{{ $data->end_date }}" class="form-control" name="end_date" required autocomplete="end_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="interest_type" class="col-md-4 col-form-label text-md-right">Interest Type</label>

                                    <div class="col-md-6">
                                        <input id="interest_type" type="text" readonly class="form-control" value="{{ $data->interest_type }}" placeholder="Interest Type" name="interest_type" required autocomplete="interest_type">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="interest_rate" class="col-md-4 col-form-label text-md-right">Interest Rate</label>

                                    <div class="col-md-6">
                                        <input id="interest_rate" type="number" readonly class="form-control" value="{{ $data->interest_rate }}" placeholder="Interest Rate" name="interest_rate" required autocomplete="interest_rate">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="initial_amount" class="col-md-4 col-form-label text-md-right">Loan Initial Amount</label>

                                    <div class="col-md-6">
                                        <input id="initial_amount" type="text" readonly class="form-control" value="{{ $data->initial_amount }}" placeholder="Loan Initial Amount" name="initial_amount" required autocomplete="initial_amount">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="loan_tenor" class="col-md-4 col-form-label text-md-right">Loan Tenor</label>

                                    <div class="col-md-6">
                                        <input id="loan_tenor" type="text" readonly class="form-control" value="{{ $data->tenor }}" placeholder="Loan Tenor" name="tenor" required autocomplete="loan_tenor">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payment_period" class="col-md-4 col-form-label text-md-right">Loan Payment Period</label>

                                    <div class="col-md-6">
                                        <input id="payment_period" type="text" readonly class="form-control" value="{{ $data->payment_period }}" placeholder="Loan Payment Period" name="payment_period" required autocomplete="payment_period">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provision_charges" class="col-md-4 col-form-label text-md-right">Perovision Charges</label>

                                    <div class="col-md-6">
                                        <input id="provision_charges" type="text" readonly class="form-control" value="{{ $data->provision_charges }}" placeholder="Perovision Charges" name="provision_charges" required autocomplete="provision_charges">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="insurance_charges" class="col-md-4 col-form-label text-md-right">Insurance Charges</label>

                                    <div class="col-md-6">
                                        <input id="insurance_charges" type="text" readonly class="form-control" value="{{ $data->insurance_charges }}" placeholder="Insurance Charges" name="insurance_charges" required autocomplete="insurance_charges">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="notary_charges" class="col-md-4 col-form-label text-md-right">Public Notary Charges</label>

                                    <div class="col-md-6">
                                        <input id="notary_charges" type="text" readonly class="form-control" value="{{ $data->notary_charges }}" placeholder="Public Notary Charges" name="notary_charges" required autocomplete="notary_charges">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="collateral" class="col-md-4 col-form-label text-md-right">Collateral</label>

                                    <div class="col-md-6">
                                        <input id="collateral" type="text" readonly class="form-control" value="{{ $data->collateral }}" placeholder="Collateral" name="collateral" required autocomplete="collateral">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bank_account" class="col-md-4 col-form-label text-md-right">Bank Account</label>

                                    <div class="col-md-6">
                                        <input id="bank_account" type="text" readonly class="form-control" value="{{ $data->bank_account }}" placeholder="Bank Account" name="bank_account" required autocomplete="bank_account">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_account" style="display: flex; align-items: center; justify-content: flex-end;" class="col-md-4 col-form-label text-md-right">Customer Field</label>
                                    <div class="col-md-6" id="fields">
                                        @if (count($data->fields) > 0)
                                            @foreach ($data->fields as $row)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" value="{{ $row->name }}" class="form-control" placeholder="Field Name" name="field_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input id="bank_account" type="text" value="{{ $row->value }}" class="form-control" placeholder="Value" name="field_value[]" required autocomplete="bank_account">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($data->files) > 0)
                                                @foreach ($data->files as $frow)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" class="form-control" value="{{ $frow->name }}" placeholder="File Name" name="file_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{-- <input id="file" type="file" class="form-control" value="{{ asset('BorrowerFiles/'.$frow->value) }}" name="file_value[]" autocomplete="bank_account"> --}}
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
