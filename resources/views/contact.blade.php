<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<form id="commission-upload-form" action="{{ route('contact.submit') }}" method="post" enctype="multipart/form-data">

    {{-- <form action="{{ url('agent/subagents/update_commission') }}/{{ $agreement->id }}" method="post" enctype="multipart/form-data"> --}}
        {{ csrf_field() }}
        <div class="agreement_edit" style="padding: 10px 15px 0px; margin: 10px 15px 15px; border-radius: 0.25rem; background: #fff;">
        {{-- hiddent agreement id and subagent id --}}

        <div class="row">

            <div class="col-lg-6">
                <fieldset class="form-group">
                    <label class="form-label semibold" for="excel_file">
                        Commission File <strong class="text-danger" style="font-size:10px;">(You can only upload in Excel format)</strong>
                    </label>
                    <input type="file" class="form-control" name="excel_file" id="excel_file" accept=".xls,.xlsx">
                </fieldset>
            </div>
            {{-- download sample file --}}
        <div class="col-lg-6">
            <div class="col-md-12 px-4 text-right">
                <a href="{{ asset('/static/commission-import-sample-file.xlsx') }}" class="btn btn-inline btn-secondary">Download Sample File</a>
            </div>
        </div>
        </div>

        </div>

        <div id="error-rows" class="mt-3" style="display:none;">
            <h5 style="color:red;">Error Row:</h5>
            <ul id="error-list" style="color:red;font-size: small"></ul>
        </div>

        <div class="row">
            <div class="col-md-12 px-4 text-right">
                <button class="btn btn-inline cancel_button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-submit submit_button">
                    Save
                </button>
            </div>
        </div>


    </form>

    <script>
        $('#commission-upload-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submit

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Clear previous errors
                    $('#error-list').empty();
                    $('#error-rows').hide();

                    if (response.status === 'error') {
                        // Show error rows
                        $('#error-rows').show();
                        response.errors.forEach(function(error) {
                            // $('#error-list').append('<li>' + error.subagent_email + '</li>');
                            // show full row
                            $('#error-list').append('<li>' +
                                error.subagent_email + ' - ' +
                                moment(error.agreement_start_date['date']).format('DD MMM YYYY') + ' to ' +
                                moment(error.agreement_end_date['date']).format('DD MMM YYYY') + ' - ' +
                                error.destination + ' - ' +
                                error.university + ' - ' +
                                error.course + ' - ' +
                                error.commission +  error.percentage_amount +

                            '</li>');
                        });
                    } else {
                        // Handle success response
                        notify('success', 'Commission file uploaded successfully!');
                        // Optionally, close modal or reset form
                        location.reload();
                    }
                },
                error: function(xhr) {
                    $('#error-list').empty();
                    $('#error-rows').show();
                    $('#error-list').append('<li>Something went wrong. Please try again.</li>');
                }
            });
        });
    </script>

</body>
</html>
