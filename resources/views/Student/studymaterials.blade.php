@extends('Student.layouts.main')
@section('badion')
    @if ($studymaterials->isNotEmpty())
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card flex-row dark">
                        <div class="card-body light">
                            <div>
                                <table class="table text-center table-responsive dark">
                                    <thead>
                                        <tr>
                                            <th class="dark light"><label class="card-title text-left">Subject</label></th>
                                            <th class="dark light"><label class="card-title text-center">Title</label></th>
                                            <th class="dark light"><label class="card-title text-center">Download</label>
                                            </th>
                                        </tr>
                                    <tbody>
                                        @foreach ($studymaterials as $content)
                                            <tr>
                                                <td class="dark light">{{ $content->subject }}</td>
                                                <td class="dark light">{{ $content->title }}</td>
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
                    <div class="card-head d-flex justify-content-center dark light">Studymaterials are not Added Yet!</div>
                </div>
            </div>
        </div>
    @endif
@endsection
