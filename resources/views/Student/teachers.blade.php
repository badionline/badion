@extends('Student.layouts.main')
@section('badion')
    @if ($teachers->isNotEmpty())
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table dark text-center">
                                <thead>
                                    <tr>
                                        <th class="dark light">Sr No.</th>
                                        <th class="dark light">Teacher</th>
                                        <th class="dark light">Subject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td class="dark light">{{ $i }}</td>
                                            <td class="dark light">{{ $teacher->teacher }}</td>
                                            <td class="dark light">{{ $teacher->subject }}</td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card-head d-flex justify-content-center">
                        <img class="card-img" src="{{ asset('img/no-data-found.gif') }}" style="width: 18rem;height: 18rem"
                            alt="Card image cap">
                    </div>
                    <div class="card-head d-flex justify-content-center dark light">Subject Teachet Not Assigned!</div>
                </div>
            </div>
        </div>
    @endif
@endsection
