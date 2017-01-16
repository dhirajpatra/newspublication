<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 4:12 PM
 */
?>
@extends('layouts.default')

@section('content')
    <div id="container">
        <div id="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <h1>Sign In!</h1>

        @include('layouts.partials.errors')

        {{ Form::open(['route' => 'login_path']) }}

        <!--- Username Field --->
            <div class="form-group">
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
            <!--- Password Field --->
            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}
            </div>
            <!--- Sign In Field --->
            <div class="form-group">
                {{ Form::submit('Sign In', ['name' => 'login', 'class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
    </div>
@stop
