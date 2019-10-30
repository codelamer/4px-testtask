@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {!! trans('users.showing-all-users') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a href="{{ route('users.create', app()->getLocale()) }}" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" data-placement="left">
                                {!! trans('users.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive users-table">
                        <table class="table table-striped data-table">
                            <thead class="thead">
                            <tr>
                                <th>{!! trans('users.users-table.id') !!}</th>
                                <th>{!! trans('users.users-table.name') !!}</th>
                                <th class="hidden-xs">{!! trans('users.users-table.email') !!}</th>
                                <th class="hidden-sm hidden-xs hidden-md">{!! trans('users.users-table.created') !!}</th>
                                <th class="hidden-sm hidden-xs hidden-md">{!! trans('users.users-table.updated') !!}</th>
                                <th class="no-search no-sort">{!! trans('users.users-table.actions') !!}</th>
                            </tr>
                            </thead>
                            <tbody id="users_table">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td class="hidden-xs">{{$user->email}}</td>
                                    <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                    <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('users.show', [ app()->getLocale(),$user->id ]) }}" class="btn btn-primary btn-sm">
                                            {{trans('users.buttons.edit')}}
                                        </a>
                                        <form action="{{ route('users.destroy', [ app()->getLocale(),$user->id ]) }}" method="POST">
                                            {!! csrf_field() !!}
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">{{trans('users.buttons.delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
