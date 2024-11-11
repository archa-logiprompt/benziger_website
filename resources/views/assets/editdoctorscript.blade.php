<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        getSlot();
    })

    function addSlot(id) {
        var from = $('#from').val();
        var to = $('#to').val();

        $.ajax({
            url: "{{ url('add-slot') }}", // Ensure this route is correct
            type: "post",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'from': from,
                'to': to,
                'doctor_id': id // Use the id variable passed to the function
            },
            success: function(result) {
                getSlot();
                if (result.msg == "Slot Exists") {
                    alert("Slot Exists")
                }
            }
        });
    }

    function getSlot() {
        $('.time-slot-section').html("");
        $.ajax({
            url: "{{ url('get-slot') }}", // Ensure this route is correct
            type: "get",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                // 'from': from,
                // 'to': to,
                'doctor_id': "{{ $doctor->id }}" // Use the id variable passed to the function
            },
            success: function(result) {
                if (result.slot.length > 0) {

                    result.slot.forEach(function(item) {

                        var div = `<div class="p-2 border text-center rounded bg-dark-subtle --h-35">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span class="lh-1"> ${item.from}- ${item.to}</span>
                                                            <button type="button" onclick="slotDelete(${item.id})"
                                                                class="btn btn-xs btn-round px-1 py-0 text-danger"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>`
                        $('.time-slot-section').append(div);
                    });
                } else {
                    var div = "No Slot Added"
                    $('.time-slot-section').append(div);

                }

            }
        })
    }

    function slotDelete(id) {
        $.ajax({
            url: "{{ url('delete-slot') }}", // Ensure this route is correct
            type: "post",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(result) {
                getSlot();
            }
        });
    }
</script>
