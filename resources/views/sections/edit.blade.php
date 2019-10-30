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
                            {!! trans('sections.editing-section', ['name' => $section->name]) !!}
                            <div class="pull-right">
                                <a href="{{ route('sections.index', app()->getLocale()) }}" class="btn btn-light btn-sm float-right">
                                    {!! trans('sections.buttons.back-to-sections') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sections.update', [ app()->getLocale(),$section->id ]) }}" method="POST" role="form" class="needs-validation">
                            {!! csrf_field() !!}
                            @method('PUT')
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_name') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{ $section->name }}" class="form-control" placeholder="{{ trans('forms.create_section_ph_name') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_description') }}
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <textarea name="description" class="form-control">{{ $section->description  }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback row">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_logo') }}
                                </label>
                                <div class="col-md-9">
                                    <img src="/storage/image/{{$section->logo}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    {{ trans('forms.create_section_label_users') }}
                                </label>
                                <div class="col-md-9">
                                    @foreach($users as $user)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $user->id }}" id="check_{{ $user->id }}" name="users[]" @if(!empty($selected_users[ $user->id ])) checked @endif>
                                            <label class="form-check-label" for="check_{{ $user->id }}">
                                                {{ $user->name }} (<a href="{{ route('users.edit', [ app()->getLocale(),$user->id ]) }}">{{ $user->email }}</a>)
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
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

