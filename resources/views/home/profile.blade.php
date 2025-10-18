
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Profile</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">


                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" value="{{ old('dob', $profile->dob ?? '') }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>ID Type</label>
                                    <select name="id_type" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="drivers_license" {{ old('id_type', $profile->id_type ?? '') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                                        <option value="international_passport" {{ old('id_type', $profile->id_type ?? '') == 'international_passport' ? 'selected' : '' }}>International Passport</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload front of ID (image/pdf)</label>
                                    <input type="file" name="id_front" accept="image/*,application/pdf" class="form-control-file" {{ empty($profile->id_front_path) ? 'required' : '' }}>
                                    @if(!empty($profile->id_front_path))
                                        <small>Existing file: stored</small>
                                    @endif
                                </div>

                                <div class="form-group" id="id_back_container">
                                    <label>Upload back of driver's license (if applicable)</label>
                                    <input type="file" name="id_back" accept="image/*,application/pdf" class="form-control-file">
                                    @if(!empty($profile->id_back_path))
                                        <small>Existing file: stored</small>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>

                            <script>
                                const idType = document.querySelector('select[name="id_type"]');
                                const back = document.getElementById('id_back_container');
                                function toggle() {
                                    back.style.display = (idType.value === 'drivers_license') ? 'block' : 'none';
                                }
                                idType.addEventListener('change', toggle);
                                toggle();
                            </script>





                            <div class="mt-3 mb-3">
 <a  class="btn btn-secondary " href="{{ asset('/')}}"> Back to dashboard</a>
 </div>


</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->
</div>

<div class="row">
    @include('partials/news')
</div><!-- .row -->


<div class="row">
@include('partials/banner')
</div><!-- .row -->

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $("#issued_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });
    $("#expiry_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });
    $("#birth_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });

</script>
@endpush

