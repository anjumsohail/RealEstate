@extends('layouts.main')

@section('content')
    <section class="post-wrapper-top dm-shadow clearfix">
        <form id="usrpropAdd" class="form-horizontal fv-form fv-form-bootstrap" wire:submit.prevent="save"
            enctype="multipart/form-data" data-fv-framework="bootstrap" data-fv-icon-valid="glyphicon glyphicon-ok"
            data-fv-icon-invalid="glyphicon glyphicon-remove" data-fv-icon-validating="glyphicon glyphicon-refresh"
            method="post" novalidate="novalidate">
            @csrf
            <section>
                <div id="content" class="col-lg-12 col-md-10 col-sm-12 col-xs-12">
                    <div class="boxes">
                        <!-- Service Information Column -->
                        <div class="form-horizontal clearfix">
                            <div id="success" class="errmsg">
                                <!-- For success/fail messages -->
                            </div>
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                    <strong>There were some problems with your input:</strong>
                                    <ul class="mt-2 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mid_title">Map Search</div>
                            <p> Find Property via Map - Draw the Circle Find Properties within that </p>

                            @livewire('map-search')

                        </div>
                    </div>
                </div>
            </section>
        </form>
    </section>
@endsection
