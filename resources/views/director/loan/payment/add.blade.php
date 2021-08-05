@extends('home')

@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Add Loan Payment
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
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.payment',$id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="payment_amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                                    <div class="col-md-6">
                                        <input id="payment_amount" type="text" class="form-control" placeholder="Payment Amount" name="payment_amount" value="{{ old('payment_amount') }}" required autocomplete="lender_name" autofocus>


                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="interest_amount" class="col-md-4 col-form-label text-md-right">Interest Amount</label>

                                    <div class="col-md-6">
                                        <input id="interest_amount" type="text" class="form-control" placeholder="Payment Amount" name="interest_amount" value="{{ old('interest_amount') }}" required autocomplete="interest_amount" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payment_date" class="col-md-4 col-form-label text-md-right">Payment Date</label>

                                    <div class="col-md-6">
                                        <input id="payment_date" type="date" class="form-control" placeholder="Payment Date" name="payment_date" required autocomplete="payment_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payment_note" class="col-md-4 col-form-label text-md-right">Payment Note</label>

                                    <div class="col-md-6">
                                        <input id="payment_note" type="text" class="form-control" placeholder="Payment Note" name="payment_note" required autocomplete="payment_note">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Save Payment
                                        </button>
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
