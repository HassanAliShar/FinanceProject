@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Requested Borrower
        </h1>
        <a href="{{ route('add.b.approve') }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add New
        </a>
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
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Identity No</th>
                                        <th>Nationality</th>
                                        <th>Borrower Type</th>
                                        <th>Request for</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td scope="row">{{ $item->name }}</td>
                                            <td>{{ $item->identity_no }}</td>
                                            <td>{{ $item->nationality }}</td>
                                            <td>{{ $item->borrower_type }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <a href="{{ route('accept.borrower',$item->id) }}" class="btn btn-sm btn-success">Accept</a>
                                                <a href="{{ route('reject.borrower',$item->id) }}" class="btn btn-sm btn-danger">Reject</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Identity No</th>
                                        <th>Nationality</th>
                                        <th>Borrower Type</th>
                                        <th>Request for</th>
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

