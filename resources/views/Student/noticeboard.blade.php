@extends('Student.layouts.main')
@section('badion')
    @if ($notices->isNotEmpty())
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card flex-row dark">
                        <div class="card-body light">
                            <div>
                                <table class="table text-center table-responsive dark">
                                    <thead>
                                        <tr>
                                            <th class="dark light"><label class="card-title text-left">Title</label></th>
                                            <th class="dark light"><label class="card-title text-center">Description</label>
                                            </th>
                                            <th class="dark light"><label class="card-title text-center">Download</label>
                                            </th>
                                        </tr>
                                    <tbody>
                                        @foreach ($notices as $content)
                                            <tr>
                                                <td class="dark light">{{ $content->title }}</td>
                                                <td class="dark light">{{ $content->description }}</td>
                                                <td class="dark light">
                                                    @isset($content->file)
                                                        <a href="{{ asset($content->file) }}">
                                                            <button class="btn button fa fa-eye"></button>
                                                        </a>
                                                        <a href="{{ asset($content->file) }}" download>
                                                            <button class="btn button fa fa-download"></button>
                                                        </a>
                                                    @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
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
                    <div class="card-head d-flex justify-content-center dark light">Notices are not Added Yet!</div>
                </div>
            </div>
        </div>
    @endif
@endsection
