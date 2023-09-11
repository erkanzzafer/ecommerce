@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} - Ödeme Sayfası
@endsection
@section('content')
{{ session()->has('deneme') ? 'var' : 'yok'}}

@endsection
@push('scripts')
@endpush
