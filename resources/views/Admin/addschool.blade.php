@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="container">
                        <form id="addschool">
                            @csrf
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="sname" class="form-control" placeholder="School Name">
                                    <input type="hidden" name="role" class="form-control" value="2">
                                    <span class="text-danger">
                                        @error('sname')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="waurl" class="form-control" placeholder="Whatsapp Url">
                                    <span class="text-danger">
                                        @error('waurl')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="location" class="form-control" placeholder="Location Url">
                                    <span class="text-danger">
                                        @error('location')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="number" name="phone" class="form-control" placeholder="Phone">
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="instagram" class="form-control" placeholder="Instagram Url">
                                    <span class="text-danger">
                                        @error('instagram')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="youtube" class="form-control" placeholder="Youtube Url">
                                    <span class="text-danger">
                                        @error('youtube')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="registernum" class="form-control"
                                        placeholder="Registered Number (Govt.)">
                                    <span class="text-danger">
                                        @error('registernum')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="pan" class="form-control" placeholder="Pan">
                                    <span class="text-danger">
                                        @error('pan')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <x-fileinput name="panfile" labelid="panfileid" label="Pan File"
                                        accept="application/pdf" />
                                    {{-- <label for="pan">Pan File</label>
                                    <input type="file" name="panfile" placeholder="Placeholder" id="pan" style="display: none" class="form-control">
                                    <span class="text-danger">
                                        @error('panfile')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <hr class="mt-3">
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm">
                                    <input type="number" name="gst" class="form-control" placeholder="GST">
                                    <span class="text-danger">
                                        @error('gst')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <input type="file" name="gstfile" class="form-control">
                                    <span class="text-danger">
                                        @error('gstfile')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-sm">
                                    <input type="number" name="adhaar" class="form-control" placeholder="Adhaar">
                                    <span class="text-danger">
                                        @error('adhaar')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <x-fileinput name="adhaarfront" labelid="adhaarfrontfile" label="Adhaar Front File"
                                        accept="application/pdf" />
                                    {{-- <label for="">Adhaar Front</label>
                                    <input type="file" name="adharfrontfile" class="form-control">
                                    <span class="text-danger">
                                        @error('adharfrontfile')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <div class="col-sm">
                                    <x-fileinput name="adhaarback" labelid="adhaarbackfile" label="Adhaar Back File"
                                        accept="application/pdf" />
                                    {{-- <label for="">Adhaar Back</label>
                                    <input type="file" name="adharbackfile" class="form-control">
                                    <span class="text-danger">
                                        @error('adharbackfile')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="submit" class="btn button" value="Add">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {


            $.validator.addMethod("startsWith", function(value, element, param) {
                return this.optional(element) || value.indexOf(param) === 0;
            }, "Value must start with {0}.");

            $("#addschool").validate({
                rules: {
                    role: {
                        required: true,
                    },
                    sname: {
                        required: true,
                        minlength: 2,
                    },
                    address: {
                        required: true,
                        minlength: 10,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    email: {
                        required: true,
                    },
                    location: {
                        // required: true,
                        startsWith: "https://g.co/"
                    },
                    waurl: {
                        // required: true,
                        startsWith: "https://w"
                    },
                    instagram: {
                        // required: true,
                        startsWith: "https:/instagram.com/"
                    },
                    youtube: {
                        // required: true,
                        startsWith: "https://www.youtube.com/@"
                    },
                    registernum: {
                        required: true,
                    },
                    pan: {
                        required: true,
                    },
                    panfile: {
                        required: true,
                        accept: "application/pdf",
                    },
                    adhaar: {
                        required: true,
                        minlength: 12,
                        maxlength: 12,
                    },
                    adhaarfront: {
                        required: true,
                        accept: "application/pdf",
                    },
                    adhaarback: {
                        required: true,
                        accept: "application/pdf",
                    },
                },
                messages: {
                    location: {
                        startsWith: "Location url must start with https://g.co/"
                    },
                    waurl: {
                        startsWith: "WhatsApp url must start with https://w"
                    },
                    instagram: {
                        startsWith: "Instagram url must start with https://www.instagram.com/"
                    },
                    youtube: {
                        startsWith: "Youtube url must start with https://www.youtube.com/@"
                    },
                    address: {
                        required: "Address is required",
                        minlength: "Minimim 10 letters are required for address"
                    }
                },
                errorClass: "text-danger",
                // errorElement: "small",
                // errorPlacement: function(error, element) {
                //     // if (error[0].innerText) {
                //     //     $("#errors").append(`<li>${error[0].innerText}</li>`);
                //     //     console.log(error);
                //     // }
                // },

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('aaaddschool') }}",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        beforeSend: function() {
                            $(".loaderClass").css("display", "flex");
                        },
                        success: function(data) {
                            $(".loaderClass").css("display", "none");
                            if (data.status == 0) {
                                $.each(data.message, function(index, value) {
                                    toastr.error(value);
                                });
                            } else {
                                toastr.success(data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
