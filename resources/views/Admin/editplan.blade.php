@extends('Admin.layouts.main')
@section('badion')
    <div class="col-sm">
        <div class="card-text container card">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td class="dark light">
                            <input type="text" class="form-control" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td class="dark light">
                            <input type="text" class="form-control" placeholder="Duration">
                        </td>
                    <tr>
                        <td class="dark light">
                            <input type="text" class="form-control" placeholder="Description">
                        </td>
                    </tr>
                    <tr>
                        <td class="dark light text-end">
                            <a href="editplan" class="btn button">Update</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection