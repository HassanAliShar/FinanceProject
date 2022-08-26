@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan
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
                        <!-- datatable start -->
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example2">
                            <thead>
                                <tr>
                                   <th> Borrower Name</th>
                                   <th>lender_name</th>
                                   <th> legal_loan_id</th>
                                   <th> loan_internal_number</th>
                                   <th> loan_type</th>
                                   <th> loan_status</th>
                                   <th> loan_reason</th>
                                   <th> start_date</th>
                                   <th> end_date</th>
                                   <th> interest_type</th>
                                   <th> interest_rate</th>
                                   <th> initial_amount</th>
                                   <th> tenor</th>
                                   <th> payment_period</th>
                                   <th> administration_charges</th>
                                   <th> government_charges</th>
                                   <th> agreement_charges</th>
                                   <th> provision_charges</th>
                                   <th> skmht_charges</th>
                                   <th> apht_charges</th>
                                   <th> fiduciary_charges</th>
                                   <th> certificate_charges</th>
                                   <th> other_charges</th>
                                   <th> insurance_charges</th>
                                   <th> notary_charges</th>
                                   <th> collateral</th>
                                   <th> bank_account</th>


                                    <th>Payment/Schedules</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)

                                    <tr>
                                        <td>{{ $item->borrower->name }}</td>
                                        <td>{{ $item->lender_name }}</td>
                                        <td>{{ $item->legal_loan_id }}</td>
                                        <td>{{ $item->loan_internal_number }}</td>
                                        <td>{{ $item->loan_type }}</td>
                                        <td>{{ $item->loan_status }}</td>
                                        <td>{{ $item->loan_reason }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                                        <td>{{ $item->interest_type }}</td>
                                        <td>{{ $item->interest_rate }}</td>
                                        <td>{{ number_format( $item->initial_amount, 2, ',', '.') }}</td>
                                        <td>{{ $item->tenor }}</td>
                                        <td>{{ $item->payment_period }}</td>
                                        <td>{{ $item->administration_charges }}</td>
                                        <td>{{ $item->government_charges }}</td>
                                        <td>{{ $item->agreement_charges }}</td>
                                        <td>{{ $item->provision_charges }}</td>
                                        <td>{{ $item->skmht_charges }}</td>
                                        <td>{{ $item->apht_charges }}</td>
                                        <td>{{ $item->fiduciary_charges }}</td>
                                        <td>{{ $item->certificate_charges }}</td>
                                        <td>{{ $item->other_charges }}</td>
                                        <td>{{ $item->insurance_charges }}</td>
                                        <td>{{ $item->notary_charges }}</td>
                                        <td>{{ $item->collateral }}</td>
                                        <td>{{ $item->bank_account }}</td>
                                        <td><a href="{{ route('staff.schdule.manage',$item->id) }}" class="btn btn-sm btn-primary">Payment/Schedules</a></td>
                                        <td>
                                            <a href="{{ route('staff.loan.view',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Lender Name</th>
                                    <th>Legal Loan Id</th>
                                    <th>Loan Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Interest Type</th>
                                    <th>Initial Amount</th>
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
                            </tfoot> --}}
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

