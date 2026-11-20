@extends('admin.app')
@section('content')
    @include('admin.components.earnings.index')
    @include('admin.components.earnings.create')
    @include('admin.components.earnings.delete')
    @include('admin.components.earnings.edit')
@endsection
