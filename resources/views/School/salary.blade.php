@extends("School.layouts.main")
@section("badion")
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-dark">
                        <tr>
                            <th class="dark light">Teacher ID</th>
                            <th class="dark light">Teacher Name</th>
                            <th class="dark light">Salary</th>
                            <th class="dark light">Pay Now</th>
                        </tr>
                        <tr>
                            <td class="dark light">123</td>
                            <td class="dark light">ABC</td>
                            <td class="dark light">123</td>
                            <td class="dark light"><label type="button" class="btn button">Pay</label></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection