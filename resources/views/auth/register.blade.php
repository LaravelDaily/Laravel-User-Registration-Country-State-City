@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h1>{{ trans('panel.site_title') }}</h1>
                    <p class="text-muted">{{ trans('global.register') }}</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-flag fa-fw"></i>
                            </span>
                        </div>
                        <select class="custom-select{{ $errors->has('country_id') ? ' is-invalid' : '' }}" id="country_id" name="country_id">
                            <option value="" selected>Choose country</option>
                            @foreach($countries as $id=>$countries)
                                <option value="{{ $id }}">{{ $countries }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('country_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3" id="state" style="display:none">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-flag fa-fw"></i>
                            </span>
                        </div>
                        <select class="custom-select{{ $errors->has('state_id') ? ' is-invalid' : '' }}" id="state_id" name="state_id">
                            <option value="" selected>Choose state</option>
                            @foreach($states as $id=>$states)
                                <option value="{{ $id }}">{{ $states }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('state_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3" id="city" style="display:none">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-building fa-fw"></i>
                            </span>
                        </div>
                        <select class="custom-select{{ $errors->has('city_id') ? ' is-invalid' : '' }}" id="city_id" name="city_id">
                            <option value="" selected>Choose city</option>
                        </select>
                        @if($errors->has('city_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3" id="cityName" style="display:none">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-building fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" id="city_name" name="city_name" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" placeholder="City">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-block btn-primary mt-1">
                        {{ trans('global.register') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#country_id').change(function() {
        $('#state_id, #city_id, #city_name').val("");
        if($('#country_id option:selected').text() == "United States") {
            $('#cityName').hide(150);
            $('#city_id').html('<option value="" selected>Choose city</option>');
            $('#state, #city').show(150);
        } else {
            $('#state, #city').hide(150);
            $('#cityName').show(150);
        }
    });

    $('#state_id').change(function() {
        var $city = $('#city_id');
        $.ajax({
            url: "{{ route('cities.index') }}",
            data: {
                state_id: $(this).val()
            },
            success: function(data) {
                $city.html('<option value="" selected>Choose city</option>');
                $.each(data, function(id, value) {
                    $city.append('<option value="'+id+'">'+value+'</option>');
                });
                $('#city').show(150);
            }
        });
    });
});
</script>
@endsection