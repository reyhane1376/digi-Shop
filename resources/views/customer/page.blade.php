@extends('customer.layouts.master-one-col')

@section('head-tag')
<title>{{ $page->title }}</title>
@endsection


@section('content')

        {!! $page->body  !!}


@endsection

