<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {



        $("#doctor_id").change(function() {

            var doctor_id = $('#doctor_id').val()
            $('#slot_id').val("");
            $('#datepicker').val("");
            $(datepicker).attr('disabled', 'disabled');
            $('.time-slot-section').html("");
            $('.slot-div').hide();
            $.ajax({
                url: "{{ url('get-days-by-doctor') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'doctor_id': doctor_id
                },
                success: function(result) {

                    var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday",
                        "Friday", "Saturday"
                    ];
                    var values = [];
                    (result.days.days.split(',')).forEach(function(item) {
                        values.push((weekdays.indexOf(item)))
                    });
                    $("#days").val(JSON.stringify(values));
                    $('#datepicker').removeAttr("disabled")
                }
            })
        })

        $("#datepicker").change(function() {

            var doctor_id = $('#doctor_id').val();
            var date = $('#datepicker').val();
            $('#slot_id').val("");

            $('.time-slot-section').html("");
            $.ajax({
                url: "{{ url('get-slot-by-doctor') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'doctor_id': doctor_id,
                    'date': date
                },
                success: function(result) {
                    if (result.slots.length > 0) {
                        var div = "";
                        result.slots.forEach(function(item) {
                            var div = `<div class="p-2 border text-center rounded bg-dark-subtle --h-35" id='slot_${item.id}'>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            ${item.patient?`<div class="lh-1 disabled opacity-50"> ${item.from}- ${item.to}</div>`:`<div class="lh-1 pointer" onclick='slotSelected(${item.id})'> ${item.from}- ${item.to}</div>`}
                                                        </div>
                                                    </div>`
                            $('.time-slot-section').append(div);


                        });
                        $('.slot-div').show();
                    } else {
                        var div = `<div class="p-2 border text-center rounded bg-danger --h-35">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div class="lh-1 disabled"> No Slots Available</div>
                                                        </div>
                                                    </div>`
                        $('.time-slot-section').append(div);
                        $('.slot-div').show();

                    }


                }
            })
        })


        function bookingValidation() {

            var validation = true;

            if (!$('#patient_name').val()) {
                $('#patient_name_validation').html("Enter Patient Name");
                validation = false;
            } else {
                $('#patient_name_validation').html("");
            }

            if (!$('#phone').val()) {
                $('#phone_validation').html("Enter Phone Number");
                validation = false;
            } else {
                $('#phone_validation').html("");
            }

            // if ($('#phone').val().length) {
            //     $('#phone_validation').html("Enter 10 Numbersz");
            //     validation = false;
            // } else {
            //     $('#phone_validation').html("");
            // }

            if (!$('#age').val()) {
                $('#age_validation').html("Enter age");
                validation = false;
            } else {
                $('#age_validation').html("");
            }

            if (!$('#id_proof').val()) {
                $('#id_proof_validation').html("Select ID proof");
                validation = false;
            } else {
                $('#id_proof_validation').html("");
            }

            if (!$('#id_number').val()) {
                $('#id_number_validation').html("Enter ID number");
                validation = false;
            } else {
                $('#id_number_validation').html("");
            }

            if (validation) {
                $('#booking_page1').hide();
                $('#booking_page2').show();
            }
        }


    })

    function bookingValidation() {


        var validation = true;

        if (!$('#patient_name').val()) {
            $('#patient_name_validation').html("Enter Patient Name");
            validation = false;
        } else {
            $('#patient_name_validation').html("");
        }

        if (!$('#phone').val()) {
            $('#phone_validation').html("Enter Phone Number");
            validation = false;
        } else {
            $('#phone_validation').html("");
        }

        // if ($('#phone').val().length) {
        //     $('#phone_validation').html("Enter 10 Numbersz");
        //     validation = false;
        // } else {
        //     $('#phone_validation').html("");
        // }

        if (!$('#age').val()) {
            $('#age_validation').html("Enter age");
            validation = false;
        } else {
            $('#age_validation').html("");
        }

        if (!$('#id_proof').val()) {
            $('#id_proof_validation').html("Select ID proof");
            validation = false;
        } else {
            $('#id_proof_validation').html("");
        }

        if (!$('#id_number').val()) {
            $('#id_number_validation').html("Enter ID number");
            validation = false;
        } else {
            $('#id_number_validation').html("");
        }

        if (validation) {
            $('#booking_page1').hide();
            $('#booking_page2').show();
        }
    }

    function slotSelected(id) {
        $(".time-slot-section>div.bg-success").removeClass("bg-success");
        $(".time-slot-section>div").addClass("bg-dark-subtle");
        $('#slot_' + id).removeClass("bg-dark-subtle");
        $('#slot_' + id).addClass("bg-success");
        $('#slot_id').val(id);

    }

    function bookingPrevious() {
        $('#booking_page1').show();
        $('#booking_page2').hide();
    }

    function submitBooking() {
        var validation = true;
        if (!$('#department_id').val()) {
            $('#department_id_validation').html("Select Departement");
            validation = false;
        } else {
            $('#department_id_validation').html("");
        }

        if (!$('#doctor_id').val()) {
            $('#doctor_id_validation').html("Select Doctor");
            validation = false;
        } else {
            $('#doctor_id_validation').html("");
        }

        if (!$('#datepicker').val()) {
            $('#date_validation').html("Select Date");
            validation = false;
        } else {
            $('#date_validation').html("");
        }

        if (!$('#slot_id').val()) {
            $('#slot_id_validation').html("Select Slot");
            validation = false;
        } else {
            $('#slot_id_validation').html("");
        }

        if (validation) {
            $('#loader').show();
            $('.container').css("filter", "blur(4px)");
            $(".btn-booking").attr("disabled", true);
            var formData = $('#booking_form').serialize();
            $.ajax({
                url: "{{ url('store-booking') }}",
                type: "post",
                dataType: 'json',
                data: formData,
                success: function(result) {

                    $('#pdf-download').attr('href', 'public/onlinebookingreceipts/' + result.fileName)
                    $('#pdf-download')[0].click();
                    window.location.href = "{{ url('booked') }}/" + result.appointment;

                }
            })
        }
    }
</script>
