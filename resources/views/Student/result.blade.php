@extends('Student.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            @if ($results)
                @foreach ($results as $name=>$result)
                    <div class="col-md-6">
                        <div class="card flex-row dark">
                            <div class="card-body light">
                                <h4 class="card-title">{{ $name }}</h4>
                                <p class="card-text">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <div class="table dark text-center">
                                            <table class="table">
                                                <tr>
                                                    <th class="dark light">Subject</th>
                                                    <th class="dark light">Marks</th>
                                                    <th class="dark light">Grade</th>
                                                </tr>
                                                @php $count=0 @endphp
                                                @php $total=0 @endphp

                                                @foreach($result as $item)
                                                    <tr>
                                                        <td class="dark light">
                                                            {{ $item['subject'] }}</td>
                                                        <td class="dark light">{{ $item['marks'] }}</td>
                                                        @php $per = (intval($item['marks']) / intval(100)) * 100; @endphp
                                                        <td class="dark light text-center">
                                                            @if ($item['marks'] == 'A')
                                                                -
                                                            @elseif ($item['marks'] >= 90)
                                                                A+
                                                            @elseif($item['marks'] >= 80 && $item['marks'] <= 89)
                                                                A
                                                            @elseif($item['marks'] >= 70 && $item['marks'] <= 79)
                                                                B+
                                                            @elseif($item['marks'] >= 60 && $item['marks'] <= 69)
                                                                B
                                                            @elseif($item['marks'] >= 50 && $item['marks'] <= 59)
                                                                C+
                                                            @elseif($item['marks'] >= 40 && $item['marks'] <= 49)
                                                                C
                                                            @elseif($item['marks'] >= 33 && $item['marks'] <= 39)
                                                                D
                                                            @else
                                                                Fail
                                                            @endif
                                                        </td>
                                                        @php $count += 1 @endphp
                                                        @if ($item['marks'] != 'A')
                                                            @php $total += $item['marks'] @endphp
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="light dark"><b>Total</b></td>
                                                    <td class="light dark">{{ $total }}</td>
                                                    @php $percent = (intval($total) / intval($count) ); @endphp
                                                    <td class="light dark">{{ round($percent,2) }}%</td>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card-head d-flex justify-content-center">
                                <img class="card-img" src="{{ asset('img/no-data-found.gif') }}"
                                     style="width: 18rem;height: 18rem" alt="Card image cap">
                            </div>
                            <div class="card-head d-flex justify-content-center dark light">No Results Yet!</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
