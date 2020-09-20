@extends('layouts.app')

@section('content')
    <h1>Email sent from your website</h1>
    <h2>Stored company information</h2>
    <p><strong>Company name:</strong> {{ $data['ares_firma_fin']}}</p>
    <p><strong>Address:</strong> {{ $data['ares_ulice_fin']}}</p>
    <p><strong>City:</strong> {{ $data['ares_mesto_fin']}}</p>
    <p><strong>Postcode:</strong> {{ $data['ares_psc_fin']}}</p>
    <p><strong>IČO:</strong> {{ $data['ares_ico_fin']}}</p>
    <p><strong>created at:</strong> {{ $data['created_at']}}</p>
@endsection

