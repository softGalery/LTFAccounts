@extends('admin.app')
@section('content')
    @include('admin.components.asset.index')
    @include('admin.components.asset.create-asset')
    @include('admin.components.asset.delete-asset')
    @include('admin.components.asset.update-asset')
@endsection
