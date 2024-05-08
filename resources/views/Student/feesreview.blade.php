<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Badion | {{ Auth::user()->name }}</title>
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @if (session()->get('theme') == 'dark')
        @php $theme = 'dark' @endphp
    @else
        @php $theme = 'light' @endphp
    @endif
    <link rel="stylesheet" href="{{ asset('css/' . $theme . '.css') }}">
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        {{-- @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                        @endif --}}
                        <div class="card card-default">
                            <div class="card-header light dark">
                                <b>{{ $data->name }} Fees</b>
                            </div>
                            <div class="card-body text-left">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td class="light dark text-start">Name:</td>
                                            <td class="light dark text-start">{{ $data->student }}</td>
                                        </tr>
                                        <tr>
                                            <td class="light dark text-start">Addmission No:</td>
                                            <td class="light dark text-start">{{ $data->addmissionno }}</td>
                                        </tr>
                                        <tr>
                                            <td class="light dark text-start">Class:</td>
                                            <td class="light dark text-start">{{ $data->class }}</td>
                                        </tr>
                                        <tr>
                                            <td class="light dark text-start">Div:</td>
                                            <td class="light dark text-start">{{ $data->div }}</td>
                                        </tr>
                                        <tr>
                                            <td class="light dark text-start">Roll No:</td>
                                            <td class="light dark text-start">{{ $data->rollno }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <form action="{{ route('payfee') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_KEY') }}"
                                        data-amount="{{ $data->amount * 100 }}" data-currency="INR" data-buttontext="Pay {{ $data->amount }} INR"
                                        data-name="BadiOn" data-description="{{ $data->feestatus_id }}" data-image="{{ asset('img/badion.png') }}"
                                        data-prefill.contact="{{ $data->phone }}" data-prefill.name="{{ $data->student }}" data-prefill.email="{{ $data->email }}"></script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $(".razorpay-payment-button").addClass("btn");
        $(".razorpay-payment-button").addClass("button");
    });
</script>
