@extends('layouts.main')

@section('content')
    <livewire:propertyadd :mode="$mode" :propertyId="$propertyid" />
@endsection
