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
                            {!! trans('users.editing-user', ['name' => $user->name]) !!}
                            <div class="pull-right">
                                <a href="{{ route('users.index', app()->getLocale()) }}" class="btn btn-light btn-sm float-right">
                                    {!! trans('users.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update',[ app()->getLocale(), $user->id ]) }}" method="POST" role="form" class="needs-validation">
                            {!! csrf_field() !!}
                            @method('PUT')
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_user_label_username') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control" placeholder="{{ trans('forms.create_user_ph_username') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_user_label_email') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" name="email" value="{{ $user->email }}" id="name" class="form-control" placeholder="{{ trans('forms.create_user_ph_email') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="pw-change-container">
                                <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                    <label class="col-md-3 control-label">
                                        {{ trans('forms.create_user_label_password') }}
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" name="password" value="" id="name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                    <label class="col-md-3 control-label">
                                        {{ trans('forms.create_user_label_pw_confirmation') }}
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" value="" id="name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-2">
                                    <a href="#" class="btn btn-outline-secondary btn-block btn-change-pw mt-3" title="{!! trans('forms.change-pw') !!}">
                                        {!! trans('forms.change-pw') !!}
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <button class="btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save">
                                        {{ trans('forms.save-changes') }}
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

