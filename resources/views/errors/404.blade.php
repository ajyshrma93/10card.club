@extends('errors.minimal')

@section('title', __('Not Found'))
@php
    $message ='Not Found';
@endphp
@section('message', __($message))
