@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Edit Transaction</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                        <form action="{{ route('transactions.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="inputAddress">Date</label>
                                <input type="text" id="theDate" value="{{ $data->theDate }}" name="theDate"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Paid In (add 0 if incase of no amount, number only)</label>
                                <input type="text" value="{{ $data->paidin }}" name="paidin" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Paid Out (add 0 if incase of no amount, number only)</label>
                                <input type="text" value="{{ $data->paidout }}" name="paidout" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Description</label>
                                <input type="text" value="{{ $data->description }}" name="description"
                                    class="form-control">
                            </div>




                            <a class="btn btn-danger" href="{{ asset('statements/transactions/' . $data->statement_id) }}">back</a>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>


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
        $("#theDate").datepicker({
            "dateFormat": "yy-mm-dd",
        });

    </script>
@endpush
