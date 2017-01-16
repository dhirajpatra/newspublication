<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 14/1/17
 * Time: 7:56 AM
 */
?>
@extends('layouts.default')

@section('content')
    <div id="container">
        @if(isset($success))
            <div class="alert alert-success"> {{$success}} </div>
        @endif
        <div class="page-header">&nbsp;</div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h1>Create News</h1>

            @include('layouts.partials.errors')

            {{ Form::open(['route' => 'news_path', 'files'=>true]) }}
            {!! csrf_field() !!}
            <!--- Username Field --->
            {{ Form::hidden('news_reporter_id', Auth::user()->id) }}
                <!--- Photo Field --->
                <div class="form-group">
                {!! Form::label('image', 'Photo:') !!}
                {!! Form::file('image') !!}
                </div>
                <!--- Title Field --->
                <div class="form-group">
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                <!--- Details Field --->
                <div class="form-group">
                    {{ Form::label('details', 'Details:') }}
                    {{ Form::textarea('details', '', ['class' => 'form-control', 'required' => 'required', 'size' => '30x10']) }}
                </div>
                <!--- Save Field --->
                <div class="form-group">
                    {{ Form::submit('Save', ['class' => 'btn btn-large btn-primary form-control']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
@stop
    </div>