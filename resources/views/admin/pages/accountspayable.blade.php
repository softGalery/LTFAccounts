@extends('admin.app')
@section('content')
    @include('admin.components.accountspayable.list')
    @include('admin.components.accountspayable.create-accontsPayable')
    @include('admin.components.accountspayable.delete-accounts-payable')
@endsection
