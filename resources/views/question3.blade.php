<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="{{ route('question1') }}">Question 1</a>
        <a href="{{ route('question2') }}">Question 2</a>
        <a href="{{ route('question3') }}">Question 3</a>
        <a href="{{ route('question4') }}">Question 4</a>

        <h1>Question 3</h1>        
        <form method="post" action="testSummary" id="question3_form" name="question3_form">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">

            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="mathScore">Mathematics Score:</label>
            <input type="number" name="mathScore" id="mathScore">

            <label for="scienceScore">Science Score:</label>
            <input type="number" name="scienceScore" id="scienceScore">
            
            <button type="submit">Generate</button>
        </form>

        @if ($msg)
            <p>Summary: {{$msg}}</p>
        @endif
    </body>
    <script>


    </script>
</html>