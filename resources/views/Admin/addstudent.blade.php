@extends('Admin.layouts.main')
@section('badion')
    <div class="col-sm">
        <div class="card-text container card">
            <form>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="name">Fullname:</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Sername YourName FatherName">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="pname">Parent Name:</label>
                                    <input type="text" class="form-control" id="pname"
                                        placeholder="ParentName Sirname">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="student@studyhub.com">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="pemail">Parent Email:</label>
                                    <input type="text" class="form-control" id="pemail"
                                        placeholder="parent@studyhub.com">
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
                                    <label for="pphone">Parent Phone No:</label>
                                    <input type="tel" class="form-control" maxlength="10" id="pphone"
                                        placeholder="XXXXXXXXXX">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="standred">Class:</label>
                                    <input type="number" class="form-control" max="12" id="standred"
                                        placeholder="Standred">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="division">Div:</label>
                                    <input type="text" class="form-control" pattern="[A-Z]" maxlength="1" id="division"
                                        placeholder="Division Must be in Capital Latter">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="dark light">
                                <div class="form-group">
                                    <label for="roll">Roll No:</label>
                                    <input type="number" class="form-control" id="roll" placeholder="Roll Number">
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
                                    <input type="button" class="form-control btn button" id="clear"
                                        value="Clear">
                                </div>
                            </td>
                            <td class="dark light">
                                <div class="form-group">
                                    <input type="submit" class="form-control btn button" id="clear"
                                        value="Submit">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection