@extends('Student.layouts.main')
@section('badion')
    @if ($homework->isNotEmpty())
        @foreach ($homework as $hw)
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="card flex-row dark">
                            <div class="card-body light">
                                <table class="table text-center table-responsive dark">
                                    <tbody>
                                        <tr>
                                            <td class="dark light text-start"><label
                                                    class="card-title text-left">{{ $hw->subject }}</label>
                                            </td>
                                            <td class="dark light text-center"><label
                                                    class="card-title text-center">{{ $hw->content }}</label></td>
                                            <td class="dark light text-end">
                                                @isset($hw->file)
                                                    <a href="{{ asset($hw->file) }}">
                                                        <button class="btn button fa fa-eye"></button>
                                                    </a>
                                                    <a href="{{ asset($hw->file) }}" download>
                                                        <button class="btn button fa fa-download"></button>
                                                    </a>
                                                @endisset
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card-head d-flex justify-content-center">
                        <img class="card-img" src="{{ asset('img/no-data-found.gif') }}" style="width: 18rem;height: 18rem"
                            alt="Card image cap">
                    </div>
                    <div class="card-head d-flex justify-content-center dark light">Homework are not Added Yet!
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
