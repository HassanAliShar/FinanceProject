@extends('home')

@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> View Borrower
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Borrower <span class="fw-300"><i>info</i></span>
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
                                    <div class="col-md-6 mb-3">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control" readonly value="{{ $data->name }}" placeholder="Full Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="internal_number">Internal Borrower ID</label>
                                        <input id="internal_number" type="text" class="form-control" readonly value="{{ $data->internal_number }}" placeholder="Identity No" name="internal_number" value="{{ old('internal_number') }}" required autocomplete="internal_number">

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="identity_no">Identity No</label>
                                        <input id="identity_no" type="text" class="form-control" readonly value="{{ $data->identity_no }}" placeholder="Identity No" name="identity_no" value="{{ old('identity_no') }}" required autocomplete="identity_no">

                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="identity_type">Identity Type</label>
                                        <input id="identity_type" type="text" class="form-control" readonly value="{{ $data->identity_type }}" placeholder="Identity Type" name="identity_type" required autocomplete="identity_type">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nationality">Nationality</label>
                                        <input id="nationality" type="text" class="form-control" readonly value="{{ $data->nationality }}" placeholder="Nationality" name="nationality" required autocomplete="nationality">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="place_of_birth" >Place Of Birth</label>
                                        <input id="place_of_birth" type="text" placeholder="Place Of Birth" class="form-control" readonly value="{{ $data->place_of_birth }}" name="place_of_birth" required autocomplete="place_of_birth">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="dob" >Date Of Birth</label>
                                        <input id="dob" type="text" class="form-control date" placeholder="DD/MM/YYYY" readonly value="{{ date('d-m-Y', strtotime($data->dob)) }}" name="dob" required autocomplete="dob">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="tax_identity_no" >Tax Identity Number</label>
                                        <input id="tax_identity_no" type="text" class="form-control" readonly value="{{ $data->tax_identity_no }}" placeholder="Tax Identity Number" name="tax_identity_no" required autocomplete="tax_identity_no">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="last_education" >Last Education</label>
                                        <input id="last_education" type="text" class="form-control" readonly value="{{ $data->last_education }}" placeholder="Last Education" name="last_education" required autocomplete="last_education">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="mother_maiden" >Mother Maiden Name</label>
                                        <input id="mother_maiden" type="text" class="form-control" readonly value="{{ $data->mother_maiden }}" placeholder="Mother Maiden Name" name="mother_maiden" required autocomplete="mother_maiden">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="surveyor" >Surveyor</label>
                                        <input id="surveyor" type="text" class="form-control" readonly value="{{ $data->surveyor }}" placeholder="Surveyor" name="surveyor" required autocomplete="surveyor">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="partner_spouse" >Partner/Spouse</label>
                                        <input id="partner_spouse" type="text" class="form-control" readonly value="{{ $data->partner_spouse }}" placeholder="Partner/Spouse" name="partner_spouse" required autocomplete="partner_spouse">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="partner_spouse_identity_number" >Partner/Spouse Identity Number</label>
                                        <input id="partner_spouse_identity_number" type="text" class="form-control" readonly value="{{ $data->partner_spouse_identity_number }}" placeholder="Partner/Spouse Identity Number" name="partner_spouse_identity_number" required autocomplete="partner_spouse_identity_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="partner_spouse_contact_number" >Person in Contact Number</label>
                                        <input id="partner_spouse_contact_number" type="text" class="form-control" readonly value="{{ $data->partner_spouse_contact_number }}" placeholder="Partner/Spouse Contact Number" name="partner_spouse_contact_number" required autocomplete="partner_spouse_contact_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="partner_spouse_domicile_address" >Partner/Spouse Domicile Address</label>
                                        <input id="partner_spouse_domicile_address" type="text" class="form-control" readonly value="{{ $data->partner_spouse_domicile_address }}" placeholder="Partner/Spouse Domicile Address" name="partner_spouse_domicile_address" required autocomplete="partner_spouse_domicile_address">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="marriage_status" >Marriage Status</label>
                                        <input id="marriage_status" type="text" class="form-control" readonly value="{{ $data->marriage_status }}" placeholder="Marriage Status" name="marriage_status" required autocomplete="marriage_status">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="family_card_number" >Family Card Number</label>
                                        <input id="family_card_number" type="text" class="form-control" readonly value="{{ $data->family_card_number }}" placeholder="Family Card Number" name="family_card_number" required autocomplete="family_card_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="home_number" >Home Number</label>
                                        <input id="home_number" type="text" class="form-control" readonly value="{{ $data->home_number }}" placeholder="Home Number" name="home_number" required autocomplete="home_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="mobile_number" >Mobile Number</label>
                                        <input id="mobile_number" type="text" class="form-control" readonly value="{{ $data->mobile_number }}" placeholder="Mobile Number" name="mobile_number" required autocomplete="mobile_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="office_number" >Office Number</label>
                                        <input id="office_number" type="text" class="form-control" readonly value="{{ $data->office_number }}" placeholder="Office Number" name="office_number" required autocomplete="office_number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="domicile_status" >Domicile Status</label>
                                        <input id="domicile_status" type="text" class="form-control" readonly value="{{ $data->domicile_status }}" placeholder="Domicile Status" name="domicile_status" required autocomplete="domicile_status">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="email" >Email</label>
                                        <input id="email" type="text" class="form-control" readonly value="{{ $data->email }}" placeholder="Email" name="email" required autocomplete="email">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="borrower_type" >Borrower Type</label>
                                        <input id="borrower_type" type="text" class="form-control" readonly value="{{ $data->borrower_type }}" placeholder="Borrower Type" name="borrower_type" required autocomplete="borrower_type">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="person_in_contact" >Person in Contact</label>
                                        <input id="person_in_contact" type="text" class="form-control" readonly value="{{ $data->person_in_contact }}" placeholder="Person in Contact" name="person_in_contact" required autocomplete="person_in_contact">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="reference" >Reference</label>
                                        <input id="reference" type="text" class="form-control" readonly value="{{ $data->reference }}" placeholder="Reference" name="reference" required autocomplete="reference">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="identity_address" >Identity Address</label>
                                        <input id="identity_address" type="text" class="form-control" readonly value="{{ $data->identity_address }}" placeholder="Identity Address" name="identity_address" required autocomplete="identity_address">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="domicile_address" >Domicile Address</label>
                                        <input id="domicile_address" type="text" class="form-control" readonly value="{{ $data->domicile_address }}" placeholder="Domicile Address" name="domicile_address" required autocomplete="domicile_address">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="office_address" >Office Address</label>
                                        <input id="office_address" type="text" class="form-control" readonly value="{{ $data->office_address }}" placeholder="Office Address" name="office_address" required autocomplete="office_address">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="occupation" >Occupation</label>
                                        <input id="occupation" type="text" class="form-control" readonly value="{{ $data->occupation }}" placeholder="Occupation" name="occupation" required autocomplete="occupation">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="line_of_business" >Line of Business</label>
                                        <input id="line_of_business" type="text" class="form-control" readonly value="{{ $data->line_of_business }}" placeholder="Line of Business" name="line_of_business" required autocomplete="line_of_business">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="business_experience" >Business Experiences</label>
                                        <input id="business_experience" type="text" class="form-control" readonly value="{{ $data->business_experience }}" placeholder="Business Experiences" name="business_experience" required autocomplete="business_experience">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="business_capital" >Business Capitals</label>
                                        <input id="business_capital" type="text" class="form-control" readonly value="{{ $data->business_capital }}" placeholder="Business Capital" name="business_capital" required autocomplete="business_capital">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="annual_income" >Annual Income</label>
                                        <input id="annual_income" type="text" class="form-control" readonly value="{{ $data->annual_income }}" placeholder="Annual Income" name="annual_income" required autocomplete="annual_income">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="other_income" >Other Income</label>
                                        <input id="other_income" type="text" class="form-control" readonly value="{{ $data->other_income }}" placeholder="Other Income" name="other_income" required autocomplete="other_income">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="joint_income" >Joint Income</label>
                                        <input id="joint_income" type="text" class="form-control" readonly value="{{ $data->joint_income }}" placeholder="Joint Income" name="joint_income" required autocomplete="joint_income">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="total_income" >Total Income</label>
                                        <input id="total_income" type="text" class="form-control" readonly value="{{ $data->total_income }}" placeholder="Total Income" name="total_income" required autocomplete="total_income">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="living_expenses" >Living Expenses</label>
                                        <input id="living_expenses" type="text" class="form-control" readonly value="{{ $data->living_expenses }}" placeholder="Living Expenses" name="living_expenses" required autocomplete="living_expenses">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="business_expenses" >Business Expenses</label>
                                        <input id="business_expenses" type="text" class="form-control" readonly value="{{ $data->business_expenses }}" placeholder="Business Expenses" name="business_expenses" required autocomplete="business_expenses">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="other_expenses" >Other Expenses</label>
                                        <input id="other_expenses" type="text" class="form-control" readonly value="{{ $data->other_expenses }}" placeholder="Other Expenses" name="other_expenses" required autocomplete="other_expenses">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="other_loan" >Other Loan</label>
                                        <input id="other_loan" type="text" class="form-control" readonly value="{{ $data->other_loan }}" placeholder="Other Loan" name="other_loan" required autocomplete="other_loan">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="net_cash_flow" >Net Cash Flow</label>
                                        <input id="net_cash_flow" type="text" class="form-control" readonly value="{{ $data->net_cash_flow }}" placeholder="Net Cash Flow" name="net_cash_flow" required autocomplete="net_cash_flow">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="total_assets" >Total Assets</label>
                                        <input id="total_assets" type="text" class="form-control" readonly value="{{ $data->net_cash_flow }}" placeholder="Total Assets" name="total_assets" required autocomplete="total_assets">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="other_lenders" >Other Lender</label>
                                        <input id="other_lenders" type="text" class="form-control" readonly value="{{ $data->other_lenders }}" placeholder="Other Lender" name="other_lenders" required autocomplete="other_lenders">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="bank_account" >Bank Account</label>
                                        <input id="bank_account" type="text" class="form-control" readonly value="{{ $data->bank_account }}" placeholder="Bank Account" name="bank_account" required autocomplete="bank_account">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 mb-3" id="fields">
                                        <label for="bank_account" >Customer Field</label>
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
                                                    <img src="{{ asset('public/BorrowerFiles/'.$frow->value) }}" style="height: 80px; width:80px"/>
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
