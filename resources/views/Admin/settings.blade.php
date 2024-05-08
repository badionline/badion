@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card container">
                    <div class="table-responsible">
                        <form action="" class="form-group">
                            <table class="table">
                                <tr>
                                    <td class="dark light text-center">
                                        <img src="{{ asset('img/badion-dark.png') }}" alt="logo" height="100px"
                                            width="100px">
                                    </td>
                                    <td class="dark light">
                                        <label for="Logo">Logo</label>
                                        <div class="form-group">
                                            <input type="file" accept=".jpg/.jpeg/.png" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light text-center">
                                        <img src="{{ asset('img/badion-dark.png') }}" alt="favicon" height="100px"
                                            width="100px">
                                    </td>
                                    <td class="dark light">
                                        <label for="favicon">Favicon</label>
                                        <div class="form-group">
                                            <input type="file" accept=".png" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light" colspan="2">
                                        <label for="copyrights">Copy Rights</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                value="Copyright © Global Badion at 2024">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light">
                                        <div class="form-group text-center">
                                            <input type="submit" class="btn button" value="Clear">
                                        </div>
                                    </td>
                                    <td class="dark light">
                                        <div class="form-group text-center">
                                            <input type="submit" class="btn button" value="Update">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
