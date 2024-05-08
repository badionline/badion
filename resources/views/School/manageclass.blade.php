@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row dark">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Add Class</h4>
                        <p class="card-text">
                        <form id="addclass">
                            @csrf
                            <input type="hidden" name="schoolid" id="schoolid">
                            <div class="form-group">
                                <label for="class">Select Class</label>
                                <select class="form-select dark light" name="class" id="class">
                                    <option value="" disabled selected>Classes</option>
                                    <option value="Playgroup">Playgroup</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="LKG">LKG</option>
                                    <option value="UKG">UKG</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                    <option value="6th">6th</option>
                                    <option value="7th">7th</option>
                                    <option value="8th">8th</option>
                                    <option value="9th">9th</option>
                                    <option value="10th">10th</option>
                                    <option value="11th">11th</option>
                                    <option value="12th">12th</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="div">Section</label>
                                <input type="text" class="form-control" name="div" id="div"
                                    placeholder="Section">
                            </div>
                            <button type="submit" class="btn button">Add Class</button>
                        </form>
                        </p>
                    </div>
                </div>
                {{-- <div class="card flex-row dark col-sm"><img class="card-img-left example-card-img-responsive"
                        src="{{ asset('img/board.png') }}" style="height: 100px;width: 100px;" />
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Notice Board</h4>
                        <p class="card-text">Count</p>
                    </div>
                </div> --}}
            </div>
            <div class="col-sm">
                <div class="card flex-row dark">
                    <img class="card-img-left example-card-img-responsive" src="{{ asset('img/class.png') }}"
                        style="height: 100px;width: 100px;" />
                    <div class="card-body light" id="allclasses">
                        <h4 class="card-title h5 h4-sm">Running Classes</h4>
                        <div class="card-text" id="classes">
                            {{-- <ul id="classes" style="list-style-type:none;"></ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        function classes() {
            $.ajax({
                type: 'get',
                url: "getstandard",
                dataType: 'JSON',
                beforeSend: function() {
                    $("#classes").empty();
                },
                success: function(data) {
                    $("#schoolid").val(data.school);
                    var shandard = data.standard;

                    var standardValues = {
                        "Playgroup": 0,
                        "Nursery": 1,
                        "LKG": 2,
                        "UKG": 3,
                        "1st": 4,
                        "2nd": 5,
                        "3rd": 6,
                        "4th": 7,
                        "5th": 8,
                        "6th": 9,
                        "7th": 10,
                        "8th": 11,
                        "9th": 12,
                        "10th": 13,
                        "11th": 14,
                        "12th": 15,
                    };

                    shandard.sort(function(a, b) {
                        if (standardValues[a.name] !== standardValues[b.name]) {
                            return standardValues[a.name] - standardValues[b.name];
                        } else {
                            return a.div.localeCompare(b.div);
                        }
                    });

                    var sortedshandard = [];
                    $.each(shandard, function(index, standard) {
                        sortedshandard.push(standard.name + ' - ' + standard.div);
                    });

                    $.each(shandard, function(index, standard) {
                        // var optionID =standard.class_id;
                        var optionValue = standard.name + ' - ' + standard.div;
                        $("#classes").append(
                            "<div class='row d-flex justify-content-between'><div class='col-sm'><span>" +
                            optionValue + "</span></div></div>");
                        //div class='col-sm'><span class='fa fa-trash text-danger' id='"+optionID+"'></span></div>
                    });
                }
            });
        }
        $(document).ready(function() {

            classes();
            $("#addclass").validate({
                rules: {
                    schoolid: {
                        required: true,
                    },
                    class: {
                        required: true,
                    },
                    div: {
                        required: true,
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "addclass",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                classes();
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
