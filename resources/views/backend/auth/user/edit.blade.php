@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

<form method="POST"
      action="{{ route('admin.auth.user.update', $user->id) }}"
      class="form-horizontal">
    @csrf
    @method('PATCH')

    <div class="pb-3 d-flex justify-content-between">
        <h4>
            @lang('labels.backend.access.users.management')
            <small class="text-muted ml-3">
                @lang('labels.backend.access.users.edit')
            </small>
        </h4>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- First Name --}}
            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="first_name">
                    {{ __('validation.attributes.backend.access.users.first_name') }}
                </label>
                <div class="col-md-10">
                    <input type="text"
                           name="first_name"
                           id="first_name"
                           class="form-control"
                           value="{{ old('first_name', $user->first_name) }}"
                           maxlength="191"
                           required>
                </div>
            </div>

            {{-- Last Name --}}
            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="last_name">
                    {{ __('validation.attributes.backend.access.users.last_name') }}
                </label>
                <div class="col-md-10">
                    <input type="text"
                           name="last_name"
                           id="last_name"
                           class="form-control"
                           value="{{ old('last_name', $user->last_name) }}"
                           maxlength="191"
                           required>
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group row">
                <label class="col-md-2 form-control-label" for="email">
                    {{ __('validation.attributes.backend.access.users.email') }}
                </label>
                <div class="col-md-10">
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control"
                           value="{{ $user->email }}"
                           readonly
                           maxlength="191"
                           required>
                </div>
            </div>

            {{-- Employee Type --}}
            <div class="form-group row">
                <label class="col-md-2">Type</label>
                <div class="col-md-10 mt-2">
                    <select name="employee_type" class="form-control">
                        <option value="" {{ $user->employee_type == '' ? 'selected' : '' }}>General</option>
                        <option value="internal" {{ $user->employee_type == 'internal' ? 'selected' : '' }}>Internal</option>
                        <option value="external" {{ $user->employee_type == 'external' ? 'selected' : '' }}>External</option>
                    </select>
                </div>
            </div>

            {{-- Roles --}}
            <div class="form-group row">
                <label class="col-md-2 form-control-label">Abilities</label>

                <div class="col-md-10 table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                @foreach($roles as $role)
                                    @if(1)
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <div class="form-check">
                                                    <input type="radio"
                                                           name="roles[]"
                                                           id="role-{{ $role->id }}"
                                                           value="{{ $role->name }}"
                                                           class="form-check-input"
                                                           {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                                        {{ ucwords($role->name) }}
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- <div class="card-body">
                                                @if($role->permissions->count())
                                                    @foreach($role->permissions as $permission)
                                                        <i class="fas fa-dot-circle"></i>
                                                        {{ ucwords($permission->name) }} <br>
                                                    @endforeach
                                                @else
                                                    @lang('labels.general.none')
                                                @endif
                                            </div> --}}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('admin.auth.user.index') }}" class="btn btn-secondary">
                        {{ __('buttons.general.cancel') }}
                    </a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('buttons.general.crud.update') }}
                    </button>
                </div>
            </div>

        </div>
    </div>

</form>
@endsection
