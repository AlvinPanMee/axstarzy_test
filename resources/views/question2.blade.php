<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="{{ route('question1') }}">Question 1</a>
        <a href="{{ route('question2') }}">Question 2</a>
        <a href="{{ route('question3') }}">Question 3</a>
        <a href="{{ route('question4') }}">Question 4</a>

        @if ($errors->any())
            {{-- <p>Invalid Data</p> --}}
            <p>{{ $errors->first() }}</p>
        @endif

        @if ($msg)
            <p>{{ $msg }}</p>
        @endif
        
        <h1>Question 2</h1>
        <form method="post" action="analyzeMsg" id="question2_form" name="question2_form">
            @csrf
            <label for="input">Input:</label>
            <input type="number" name="input" id="input" required>

            <label for="output">Output:</label>
            <input type="number" name="output" id="output" required>

            <button type="submit">Analyze</button>
        </form>

    </body>
    <script>

    </script>
</html>