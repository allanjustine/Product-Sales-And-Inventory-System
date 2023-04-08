@extends('pages.admin.layout.base')

@section('title', '| Profile')

@section('content-header')
    <h1><u>{{ Auth::user()->name }} Profile</u></h1>
@endsection

@section('content')
    <livewire:admin.pages.profile />
@endsection
