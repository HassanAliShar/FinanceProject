@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Manage Borrower
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Borrowers <span class="fw-300"><i>data</i></span>
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
                       <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example3">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>internal_number</th>
                                <th>identity_no</th>
                                <th>identity_type</th>
                                <th>nationality</th>
                                <th>place_of_birth</th>
                                <th>dob</th>
                                <th>last_education</th>
                                <th>mother_maiden</th>
                                <th>surveyor</th>
                                <th>partner_spouse</th>
                                <th>partner_spouse_identity_number</th>
                                <th>partner_spouse_contact_number</th>
                                <th>partner_spouse_domicile_address</th>
                                <th>marriage_status</th>
                                <th>family_card_number</th>
                                <th>home_number</th>
                                <th>mobile_number</th>
                                <th>office_number</th>
                                <th>domicile_status</th>
                                <th>email</th>
                                <th>status</th>
                                <th>tax_identity_no</th>
                                <th>borrower_type</th>
                                <th>person_in_contact</th>
                                <th>reference</th>
                                <th>identity_address</th>
                                <th>domicile_address</th>
                                <th>office_address</th>
                                <th>occupation</th>
                                <th>line_of_business</th>
                                <th>business_experience</th>
                                <th>business_capital</th>
                                <th>annual_income</th>
                                <th>other_income</th>
                                <th>joint_income</th>
                                <th>total_income</th>
                                <th>living_expenses</th>
                                <th>business_expenses</th>
                                <th>other_expenses</th>
                                <th>other_loan</th>
                                <th>net_cash_flow</th>
                                <th>total_assets</th>
                                <th>other_lenders</th>
                                <th>bank_account</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)

                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->internal_number }}</td>
                                    <td>{{ $item->identity_no }}</td>
                                    <td>{{ $item->identity_type }}</td>
                                    <td>{{ $item->nationality }}</td>
                                    <td>{{ $item->place_of_birth }}</td>
                                    <td>{{ $item->dob }}</td>
                                    <td>{{ $item->last_education }}</td>
                                    <td>{{ $item->mother_maiden }}</td>
                                    <td>{{ $item->surveyor }}</td>
                                    <td>{{ $item->partner_spouse }}</td>
                                    <td>{{ $item->partner_spouse_identity_number }}</td>
                                    <td>{{ $item->partner_spouse_contact_number }}</td>
                                    <td>{{ $item->partner_spouse_domicile_address }}</td>
                                    <td>{{ $item->marriage_status }}</td>
                                    <td>{{ $item->family_card_number }}</td>
                                    <td>{{ $item->home_number }}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>{{ $item->office_number }}</td>
                                    <td>{{ $item->domicile_status }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->tax_identity_no }}</td>
                                    <td>{{ $item->borrower_type }}</td>
                                    <td>{{ $item->person_in_contact }}</td>
                                    <td>{{ $item->reference }}</td>
                                    <td>{{ $item->identity_address }}</td>
                                    <td>{{ $item->domicile_address }}</td>
                                    <td>{{ $item->office_address }}</td>
                                    <td>{{ $item->occupation }}</td>
                                    <td>{{ $item->line_of_business }}</td>
                                    <td>{{ $item->business_experience }}</td>
                                    <td>{{ $item->business_capital }}</td>
                                    <td>{{ $item->annual_income }}</td>
                                    <td>{{ $item->other_income }}</td>
                                    <td>{{ $item->joint_income }}</td>
                                    <td>{{ $item->total_income }}</td>
                                    <td>{{ $item->living_expenses }}</td>
                                    <td>{{ $item->business_expenses }}</td>
                                    <td>{{ $item->other_expenses }}</td>
                                    <td>{{ $item->other_loan }}</td>
                                    <td>{{ $item->net_cash_flow }}</td>
                                    <td>{{ $item->total_assets }}</td>
                                    <td>{{ $item->other_lenders }}</td>
                                    <td>{{ $item->bank_account }}</td>
                                    <td>
                                        <a href="{{ route('staff.view.borrower',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

