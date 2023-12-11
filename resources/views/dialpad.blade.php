<!-- resources/views/dialpad.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dialpad</div>

                <div class="panel-body">
                    <div id="dialpad" class="text-center">
                        <input type="text" id="phoneNumber" class="form-control" placeholder="Enter phone number">
                        <button type="button" onclick="call()" class="btn btn-primary">Call</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #dialpad {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    #phoneNumber {
        width: 300px;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        width: 150px;
        padding: 10px;
        font-size: 16px;
    }

    /* Add more styles as needed for a modern look */
</style>

<script>
    // Function to handle the call button click
    function call() {
        // Your existing JavaScript code
        var phoneNumber = $('#phoneNumber').val().trim();

        if (phoneNumber !== '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post("/dial", { digit: phoneNumber })
                .done(function(data) {
                    if (data.success) {
                        alert('Call initiated successfully!');
                    } else {
                        alert('Error initiating the call. Please try again.');
                    }
                })
                .fail(function(error) {
                    alert('Error: ' + error.responseText);
                });
        }
    }
</script>

@endsection
