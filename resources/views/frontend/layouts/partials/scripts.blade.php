<script src=" {{ asset('frontend/js') }}/vendor/jquery-2.2.4.min.js"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"
  ></script>
    <script src=" {{ asset('frontend/js') }}/vendor/bootstrap.min.js"></script>
    <script src=" {{ asset('frontend/js') }}/jquery.ajaxchimp.min.js"></script>
    <script src=" {{ asset('frontend/js') }}/parallax.min.js"></script>
    <script src=" {{ asset('frontend/js') }}/owl.carousel.min.js"></script>
    <script src=" {{ asset('frontend/js') }}/jquery.magnific-popup.min.js"></script>
    <script src=" {{ asset('frontend/js') }}/jquery.sticky.js"></script>
    <script src=" {{ asset('frontend/js') }}/main.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
    @yield('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click','#like',function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Before Like This,You Need To login',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route("login") }}'
                    window.location.href=url
                }
            })

        });
    </script>

    {{-- Swal.fire({
        title: "Opps..!",
        text: "To Like,Login First",
        icon: "warning",
        button: false,
        timer: 1500,
})


var url = '{{ route("login") }}'
window.location.href=url --}}
