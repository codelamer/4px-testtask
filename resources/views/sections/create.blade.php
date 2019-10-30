@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                @include('partials.form-status')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {{ trans('sections.create-new-section') }}
                            <div class="pull-right">
                                <a href="{{ route('sections.index', app()->getLocale()) }}" class="btn btn-light btn-sm float-right">
                                    {!! trans('sections.buttons.back-to-sections') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sections.store', app()->getLocale()) }}" method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_name') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ trans('forms.create_section_ph_name') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_description') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <textarea name="description" class="form-control">{{ old(trim('description')) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('logo') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_logo') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input" />
                                        <label class="custom-file-label" for="customFile">{{ trans('forms.choose_file') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pw-change-container row">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_users') }}
                                </label>
                                <div class="col-md-9">
                                @foreach($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $user->id }}" id="check_{{ $user->id }}" name="users[]">
                                        <label class="form-check-label" for="check_{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <button class="btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save">
                                        {{ trans('forms.create_section_button_text') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

