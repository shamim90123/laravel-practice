<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <form id="contactForm">
        <label>Name:</label><br>
        <input type="text" name="name" id="name"><br>

        <label>Email:</label><br>
        <input type="text" name="email" id="email"><br>

        <button type="submit">Submit</button>
    </form>

    <div id="responseMessage" style="color: green; margin-top: 20px;"></div>

    <script>
        $(document).ready(function(){
            $('#contactForm').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: "{{ route('contact.submit') }}",
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        name: $('#name').val(),
                        email: $('#email').val()
                    },
                    success: function(response){
                        $('#responseMessage').text(response.success);
                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr){
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value){
                            errorMessages += value + '\n';
                        });
                        alert(errorMessages);
                    }
                });
            });
        });
    </script>

</body>
</html>
