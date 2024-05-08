@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="container card">
                    <form action="">
                        <div class="row">
                            <div class="col-sm">
                                <label for="plan">Add Plans</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" placeholder="Duration (Year)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <button class="btn button" type="submit">Add Plan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="card container">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="dark light">Title</th>
                                <th class="dark light">Duration</th>
                                <th class="dark light">Description</th>
                                <th class="dark light">Options</th>
                            </tr>
                            <tr>
                                <td class="dark light">Silver Plan</td>
                                <td class="dark light">1 Year</td>
                                <td class="dark light">abcdefghijklmnopqrstuvwxyz</td>
                                <td class="dark light">
                                    <a href="editplan"><label class="fa fa-edit"></label></a>
                                    <label class="fa fa-trash"></label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
