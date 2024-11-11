


<script type="text/javascript" src="{{ asset('header/js/core/jquery-3.7.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('header/js/core/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('header/js/core/bootstrap.min.js') }}"></script>


<!-- jQuery Scrollbar -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Chart JS -->
<script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
{{-- <script src="{{ asset('js/plugin/jsvectormap/jsvectormap.min.js') }}"></script> --}}
<script src="{{ asset('js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/setting-demo.js') }}"></script>
{{-- <script src="{{ asset('js/demo.js') }}"></script>  --}}
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>



{{-- custom script start --}}

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">


@if (session('success'))
    <script>
        $(document).ready(function() {

            toastr.success("{{ session('success') }}")

        })
    </script>
@endif
@if (session('error'))
    <script>
        $(document).ready(function() {

            toastr.error("{{ session('error') }}")

        })
    </script>
@endif

<script>
    $(document).ready(function() {
        $("#basic-datatables").DataTable({
            "pageLength": 20,
            "aaSorting": []
        });
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 5,
            defaultTime: '11',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
                beforeShowDay: function(date) {
                    var days = JSON.parse($('#days').val());
                    var day = date.getDay();
                    return [days.includes(day), ''];
                }
            });
        });

        $(function() {

            $("#date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
            });
        });

        $("#department_id").change(function() {
            $('#doctor_id').html("");
            var department_id = $('#department_id').val()
            $.ajax({
                url: "{{ url('get-doctor-by-department') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'department_id': department_id
                },
                success: function(result) {
                    var div = ` <option value="
                        ">Select</option>`;
                    result.doctor.forEach(function(item) {
                        div += ` <option value='${item.id}
                        '>${item.doctor_name}</option>`;

                    });
                    $('#doctor_id').append(div);
                }
            })
        })




    })
</script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $("#searchBtn").click(function() {
            var search = $('#search').val();
            var array = [];
            var found = false;

            $("#tableContent").find("td").each(function() {
                array.push($(this));
                $(this).hide();
            });

            array.forEach(function(td) {
                if (td.text().includes(search)) {
                    var row = td.parent();
                    row.children().show();
                    found = true;
                }
            });

            if (!found) {
                $("#noResults").show();
            } else {
                $("#noResults").hide();
            }
        });
    </script>


 --}}


<!-- jQuery script -->


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
{{-- <script>
    // Search by Date
    $("#dateSearchBtn").click(function() {
        var searchDate = $('#searchDate').val();
        var found = false;

        $("#tableContent tr").each(function() {
            var rowDate = $(this).find("td:eq(6)").text().trim();

            if (rowDate === searchDate) {
                $(this).show();
                found = true;
            } else {
                $(this).hide();
            }
        });

        if (!found) {
            $("#noResults").show();
        } else {
            $("#noResults").hide();
        }
    });

    // Search by Doctor Name
    $("#searchBtn").click(function() {
        var searchQuery = $('#search').val().toLowerCase();
        var found = false;

        $("#tableContent tr").each(function() {
            var doctorName = $(this).find("td:eq(3)").text().toLowerCase();

            if (doctorName.includes(searchQuery)) {
                $(this).show();
                found = true;
            } else {
                $(this).hide();
            }
        });

        if (!found) {
            $("#noResults").show();
        } else {
            $("#noResults").hide();
        }
    });
</script> --}}

{{-- custom script end --}}
