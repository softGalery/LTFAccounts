@extends('admin.app')
@section('content')
    @include('admin.components.liability.index')
    @include('admin.components.liability.liability-create')
    @include('admin.components.liability.delete')
@endsection
