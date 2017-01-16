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
        <h2>Crossover News RSS Feed</h2>
        <p>
            Welcome to the Crossover News Publications RSS Feed.
        </p>
       <p>
           {{ $feeds }}
       </p>
    </div>

@stop
