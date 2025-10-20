@extends('layouts.app_home')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Profile Overview</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (!$profile)
                        <div class="alert alert-warning">
                            You haven’t created your profile yet.
                            <a href="{{ route('profile.details') }}" class="btn btn-sm btn-primary ml-2">Create Profile</a>
                        </div>
                    @else
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>{{ $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $profile->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $profile->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>ID Type:</th>
                                <td>{{ $profile->id_type ? ucfirst(str_replace('_', ' ', $profile->id_type)) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Account Activated:</th>
                                <td>{{ $profile->user ? $profile->user->created_at->diffForHumans() : 'N/A' }}</td>
                            </tr>
                            </tbody>
                        </table>


                    @endif
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>

    <div class="row">
        @include('partials/news')
    </div>

    <div class="row">
        @include('partials/banner')
    </div>
@endsection
