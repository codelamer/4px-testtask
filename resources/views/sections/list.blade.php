@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {!! trans('sections.showing-all-sections') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a href="{{ route('sections.create', app()->getLocale()) }}" class="btn btn-primary btn-sm pull-right">
                                {!! trans('sections.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive sections-table">
                        <table class="table table-striped data-table">
                            <thead class="thead">
                            <tr>
                                <th>{!! trans('sections.sections-table.id') !!}</th>
                                <th>{!! trans('sections.sections-table.logo') !!}</th>
                                <th><b>{!! trans('sections.sections-table.name') !!}</b></th>
                                <th class="hidden-xs">{!! trans('sections.sections-table.description') !!}</th>
                                <th class="hidden-sm hidden-xs hidden-md">{!! trans('sections.sections-table.users') !!}</th>
                                <th>{!! trans('sections.sections-table.actions') !!}</th>
                            </tr>
                            </thead>
                            <tbody id="sections_table">
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{$section->id}}</td>
                                    <td><img src="/storage/image/{{$section->logo}}"/></td>
                                    <td>{{$section->name}}</td>
                                    <td class="hidden-xs">{{$section->description}}</td>
                                    <td class="hidden-sm hidden-xs hidden-md">
                                        <b>Users</b>
                                        <ol>
                                            @foreach($section->users as $user)
                                            <li>{{ $user->name }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <a href="{{ route('sections.show', [ app()->getLocale(),$section->id ]) }}" class="btn btn-primary btn-sm">
                                            {{trans('sections.buttons.edit')}}
                                        </a>
                                        <form action="{{ route('sections.destroy', [ app()->getLocale(),$section->id ]) }}" method="POST">
                                            {!! csrf_field() !!}
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">{{trans('sections.buttons.delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $sections->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
