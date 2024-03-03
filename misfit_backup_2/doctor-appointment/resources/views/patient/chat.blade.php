<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Chat With Doctor </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <style>
        /* Add your styling for left and right messages */
        .left-message {
            text-align: left;
            background-color: #eaeaea;
            padding: 5px;
            margin-bottom: 5px;
        }

        .right-message {
            text-align: right;
            background-color: #dff5e7;
            padding: 5px;
            margin-bottom: 5px;
        }

        ul li {
            list-style: none;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 shadow py-3">
                {{-- <div class="doctor-list">
                    <h5>Select a Doctor:</h5>
                    <select class="form-control" id="selected-doctor" required>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div> --}}


                <div class="chat">
                    <ul id="chat-list-{{ $chat->id }}">
                        @foreach ($chat->messages as $message)
                            {{-- Apply different styles based on the message sender --}}
                            <li class="{{ $message->sent_user_id === Auth::id() ? 'right-message' : 'left-message' }}">
                                {{ $message->sent_user_id === Auth::id() ? Auth::user()->name : 'Doctor' }}:
                                {{ $message->content }}
                            </li>
                        @endforeach
                    </ul>
                </div>




                <form method="post" action="{{ route('chat.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea class="form-control" id="message" rows="3" name="message" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-secondary">Send</button>
                </form>
                <div class="d-flex justify-content-end">
                    <a href="{{ url('/patient/dashboard') }}" class="btn btn-danger">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>




    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Your JavaScript -->
    <script>
        // Function to fetch and update data
        function fetchData() {
            $.ajax({
                url: '/without-reload-chat-with-doctor',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the content of the data container
                    // $('#data-container').html(data.yourDataProperty);

                    // Clear existing messages
                    $('#chat-list-{{ $chat->id }}').html('');

                    // Append new messages
                    $.each(data.messages, function(index, message) {
                        var sender = (message.sent_user_id === {{ Auth::id() }}) ?
                            '{{ Auth::user()->name }}' : 'Doctor';
                        var liClass = (message.sent_user_id === {{ Auth::id() }}) ? 'right-message' :
                            'left-message';

                        var messageHtml = '<li class="' + liClass + '">' + sender + ': ' + message
                            .content + '</li>';
                        $('#chat-list-{{ $chat->id }}').append(messageHtml);
                    });
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Periodically fetch data every second
        setInterval(fetchData, 1000);
    </script>


</body>

</html>
