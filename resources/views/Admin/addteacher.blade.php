@extends('Admin.layouts.main')
@section('badion')
    <div class="col-sm">
        <div class="card-text container card light">
            <form>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="id">School id:</label>
                                    <input type="text" class="form-control" value="XXX" readonly>
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="name">Scdhool Name:</label>
                                    <input type="text" class="form-control" value="XXX" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="name">Teacher Name:</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Sername YourName FatherName">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Teacher@studyhub.com">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" class="form-control" maxlength="10" id="phone"
                                        placeholder="XXXXXXXXXX">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="degree">Graduation:</label>
                                    <input type="text" class="form-control" id="degree" placeholder="Degree/Degrees">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="salary">Salary:</label>
                                    <input type="number" class="form-control" id="salary" placeholder="Salary">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="dob">Date of birth:</label>
                                    <input type="date" class="form-control" id="dob">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="aadhaar">Aadhaar No:</label>
                                    <input type="number" class="form-control" pattern=".{12}" id="aadhaar"
                                        placeholder="XXXXXXXXXXXX">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="profile">Profile Picture:</label>
                                    <input type="file" accept=".jpg,.jpeg" class="form-control" id="profile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="roll">Address:</label>
                                    <textarea class="form-control" id="address" placeholder="Your Address Here"></textarea>
                                </div>
                            </td>
                            <td class="dark light">
                                <label for="gender">Gender:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="male" id="male">
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="male" id="female">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <input type="button" class="form-control btn button" id="clear" value="Clear">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <input type="submit" class="form-control btn button" id="clear" value="Submit">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
