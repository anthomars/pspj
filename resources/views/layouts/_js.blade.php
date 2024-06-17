<!-- Tabler Core -->
<script src="{{ asset('templates/tabler/dist/js/tabler.min.js?1685976846') }}" defer></script>
<script src="{{ asset('templates/tabler/dist/js/demo.min.js?1685976846') }}" defer></script>
<script src="{{ asset('templates/tabler/dist/js/demo-theme.min.js?1685976846') }}" defer></script>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function (){
        $(window).on('load resize', function () {
            var winHeight = $(window).height();

            if (winHeight <= 710) {
                $("#avatar-xl").removeClass("logo-user");
                $("#avatar-xl").addClass("logo-user-scroll");
            } else {
                $("#avatar-xl").addClass("logo-user");
                $("#avatar-xl").removeClass("logo-user-scroll");
            }
        });
    });
</script>
