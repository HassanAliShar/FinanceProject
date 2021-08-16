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
                            <form method="POST" action="{{ route('setting.update.name',$site_name->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Change Site Name</label>
                                        <input type="text" value="{{ $site_name->value }}" placeholder="Enter New Site Name" name="site_name" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            Update Name
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <form method="POST" action="{{ route('setting.update.logo',$logo->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Select New Logo</label>
                                        <input type="file" name="logo">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('public/img/'.$logo->value) }}" width="100px" height="100px"/>
                                    </div>
                                    <div class="col-md-4">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            Update Logo
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <form method="POST" action="{{ route('setting.update.message',$welcome->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Welcome Message</label>
                                        <textarea name="site_message" class="form-control" rows="10">
                                            {{ $welcome->value }}
                                        </textarea>
                                        {{-- <input type="text" value="{{ $welcome->value }}" placeholder="Enter New Site Message" name="site_message" class="form-control"> --}}
                                    </div>
                                    <div class="col-md-4 justify-content-center">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            Change Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <form method="POST" action="{{ route('setting.update.footer',$footer->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Footer</label>
                                        <input type="text" value="{{ $footer->value }}" placeholder="Enter New Site Footer" name="site_footer" class="form-control">
                                    </div>
                                    <div class="col-md-4 justify-content-center">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            Change Footer
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
