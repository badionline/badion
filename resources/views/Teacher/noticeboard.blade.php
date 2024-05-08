@extends('Teacher.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                @if ($notices->isNotEmpty())
                    <div class="card flex-row dark">
                        <div class="card-body light">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="dark light text-start">Date time</th>
                                            <th class="dark light text-start">Title</th>
                                            <th class="dark light text-start">Description</th>
                                            <th class="dark light text-end">Download</th>
                                        </tr>
                                        @foreach ($notices as $notice)
                                            <tr>
                                                <td class="dark light">
                                                    {{ $notice->created_at }}
                                                </td>
                                                <td class="dark light">
                                                    {{ $notice->title }}
                                                </td>
                                                <td class="dark light">
                                                    {{ $notice->description }}
                                                </td>
                                                <td class="dark light text-end">
                                                    @isset($notice->file)
                                                        <a href="{{ asset($notice->file) }}" target="_blank">
                                                            <button class="btn fa fa-eye button"></button>
                                                        </a>
                                                        <a href="{{ asset($notice->file) }}" target="_blank" download>
                                                            <button class="btn fa fa-download button"></button>
                                                        </a>
                                                    @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card-head d-flex justify-content-center">
                                    <img class="card-img" src="{{ asset('img/no-data-found.gif') }}"
                                        style="width: 18rem;height: 18rem" alt="Card image cap">
                                </div>
                                <div class="card-head d-flex justify-content-center dark light">There are no notices yet!
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                </a>
            </div>
        </div>
    </div>
@endsection
