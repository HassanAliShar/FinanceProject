@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Requested Loan Payment
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
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td>{{ number_format( $item->payment_amount, 2, ',', '.') }}</td>
                                            <td>{{ $item->interest_amount }}</td>
                                            <td>{{date('d-m-Y', strtotime( $item->payment_date )) }}</td>
                                            <td>{{ $item->payment_note }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <a href="{{ route('requested_view.mg.payment',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('delete_req.mg.payment',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
                                        <th>Status</th>
                                        <th>Type</th>
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

