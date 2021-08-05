@extends('home')

@section('pagesection')

<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Update Site
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Update <span class="fw-300"><i>Site</i></span>
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
                            <form method="POST" action="{{ route('create.db.backup') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            Create New Backup
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>File Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach ($arr as $row)
                                                <tr>
                                                    <td>
                                                        <a download href="{{ route("db.download",$row) }}"> {{ $row }} </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('db.file.delete',$row) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
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
