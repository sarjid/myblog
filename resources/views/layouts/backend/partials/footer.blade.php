    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/vendors') }}/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/main.js"></script>

    <script src="{{ asset('backend/vendors') }}/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="{{ asset('backend/vendors') }}/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/dashboard.js"></script>
    <script src="{{ asset('backend/assets') }}/js/widgets.js"></script>

    <script src="{{ asset('backend/vendors') }}/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="{{ asset('backend/vendors') }}/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="{{ asset('backend/vendors') }}/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
    @yield('scripts')
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click','#delete',function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                this.form.submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })

    });
</script>



