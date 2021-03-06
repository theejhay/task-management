<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Task</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <a href="/task" class="btn btn-sm btn-info"> Go Back </a>
                    <h2 class="form-title">Update task</h2>
                    @foreach($task as $tasks)

                    <form method="POST" action="{{  url('process-update-task/'.$tasks->id) }}" class="register-form" id="register-form">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" value="{{ $tasks->name }}" placeholder="Task title"/>
                        </div>

                        <div class="form-group">
                            <label for="priority"><i class="zmdi zmdi-edit"></i></label>
                            <select name="priority" id="name">
                                <option value="{{ $tasks->priority }}"> {{ $tasks->priority }}</option>
                                <option value="">--------------</option>
                                <option value="low"> Low </option>
                                <option value="medium"> Medium </option>
                                <option value="high"> High </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description"><i class="zmdi zmdi-comment-edit material-icons-name"></i></label>
                            <textarea name="description" id="" placeholder="Task Description"> {{  $tasks->description }}</textarea>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="submit" id="" class="form-submit" value="Update Task"/>
                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('images/signup-image.jpg') }}" alt="sing up image"></figure>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- JS -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
