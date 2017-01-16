<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 4:09 PM
 */
?>
@extends('layouts.default')

@section('content')

    <div class="container">
        <h2>Crossover News Publications</h2>
        <p>
            Welcome to the Crossover News Publications application.
        </p>
        @if(Session::has('msg'))
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert">×</a>
                <strong>Heads Up!</strong> {!!Session::get('msg')!!}
            </div>
        @endif
        <table style="width:100%; border-spacing: 5px; border-collapse: separate;">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Details</th>
                <th>Reporter</th>
                <th>Published</th>
                <th>Delete</th>
            </tr>
        @foreach($newsList['data'] as $news)
            <tr>
                <td width="15%"><img src="{!! '/newsimages/'.$news['news_photo'] !!}" width="100" height="100"></td>
                <td width="15%">{{ $news['news_title'] }}</td>
                <td width="45%">{{ $news['news_details'] }}</td>
                <td width="10%">{{ $news['user']['username'] }}</td>
                <td width="10%">{{ Carbon\Carbon::parse($news['created_at'])->format('d-m-Y') }}</td>
                <td>
                        @if( isset(Auth::user()->username))
                    {{ Form::open(['route' => ['news_delete', Crypt::encrypt($news['news_id'])], 'method' => 'delete']) }}
                    {{ Form::hidden('news_id', $news['news_id']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-warning form-control']) }}
                    {{ Form::close() }}
                        @else
                        Login required
                        @endif
                </td>
            </tr>

        @endforeach
        </table>
        @if( isset(Auth::user()->username) )
            {{ link_to_route('news_path', 'Create News', null, ['class' => 'btn btn-lg btn-primary']) }}
        @else
            {{ link_to_route('register_path', 'Sign Up', null, ['class' => 'btn btn-lg btn-primary']) }}
        @endif
    </div>

@stop
