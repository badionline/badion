<div class="container footer">
    <div class="d-flex footer justify-content-between border-top">
        <div class="justify-content-start">
            <span class="light">&commat; 2024 BadiOn</span>
            {{-- &copy; --}}
        </div>
        <ul class="nav justify-content-end list-unstyled d-flex">
            <a class="whatsapp" href="https://wa.me/919924847147?text=Hello%20From%20Badion" target="_blank">
                <li class="light fab fa-whatsapp" style="font-size:20px"></li>
            </a>
            <a class="instagram" href="https://www.instagram.com/rahulhemaraju/" target="_blank">
                <li class="light fab fa-instagram" style="font-size:20px"></li>
            </a>
            <a href="{{ route('support') }}">
                <li class="light fa fa-comment" style="font-size:20px"></li>
            </a>
            <a class="location" href="https://maps.app.goo.gl/nXZC4u8Ab8MSrJRD7" target="_blank">
                <li class="light fa fa-map-marker-alt" style="font-size:20px"></li>
            </a>
            <a class="email" href="https://mailto:badionlineinfo@gmail.com" target="_blank">
                <li class="light fa fa-envelope" style="font-size:20px"></li>
            </a>
        </ul>
    </div>
</div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"
    integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script> --}}


<script>
    $(document).ready(function() {
        $(".loaderClass").css("display", "none");
        var screen = localStorage.getItem("fullscreen");
        // console.log(screen);

        function toggleFullscreen() {
            var isFullscreen = document.fullscreenElement || document.webkitFullscreenElement || document
                .mozFullScreenElement || false;

            if (isFullscreen) {
                exitFullscreen();
            } else {
                enterFullscreen();
            }
        }

        function enterFullscreen() {
            var element = document.documentElement;
            localStorage.setItem("fullscreen", true);
            if (element.requestFullscreen) {
                element.requestFullscreen();

            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            }
        }

        function exitFullscreen() {
            localStorage.setItem("fullscreen", false);
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            }
        }
        if (screen) {
            $('#toggleButton').click();
        }
        $("#toggleButton").click(toggleFullscreen);

        $.ajax({
            type: 'get',
            url: '{{ route('verifystatus') }}',
            // data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                if (data == 0) {
                    window.location.href = "{{ route('disabled') }}";
                }
            }
        });
    });
</script>
