<div class="card-body">
    <div class="form-group">
        {{ Form::label('name', "User Name") }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', "Email") }}
        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', "Password") }}
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', "Password confirmation") }}
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', "Roles") }}
        {!! Form::select('id', $roles, null, ['class' => 'form-control custom-select']) !!}

    </div>
</div>
<div class="card-footer">
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
</div>