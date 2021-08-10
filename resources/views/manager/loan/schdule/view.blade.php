@extends('home')

@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> View Requested Loan Schedule
        </h1>
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
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="form-group row">
                                    <label for="principal_payment" class="col-md-4 col-form-label text-md-right">Principle Payment</label>

                                    <div class="col-md-6">
                                        <input id="principal_payment" type="text" readonly class="form-control" value="{{ $data->principal_payment }}" placeholder="Principal Payment" name="principal_payment" value="{{ old('principal_payment') }}" required autocomplete="lender_name" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="interest_payment" class="col-md-4 col-form-label text-md-right">Interest Payment</label>

                                    <div class="col-md-6">
                                        <input id="interest_payment" type="text" readonly class="form-control" value="{{ $data->interest_payment }}" placeholder="Interest Payment" name="interest_payment" value="{{ old('interest_payment') }}" required autocomplete="interest_payment">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expected_payment" class="col-md-4 col-form-label text-md-right">Expected Payment</label>

                                    <div class="col-md-6">
                                        <input id="expected_payment" type="text" readonly class="form-control" value="{{ $data->expected_payment }}" placeholder="Expected Payment" name="expected_payment" required autocomplete="identity_type">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expected_payment_date" class="col-md-4 col-form-label text-md-right">Expected Payment Date</label>

                                    <div class="col-md-6">
                                        <input id="expected_payment_date" type="date" readonly class="form-control" value="{{ $data->expected_payment_date }}" placeholder="Expected Payment Date" name="expected_payment_date" required autocomplete="expected_payment_date">
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
