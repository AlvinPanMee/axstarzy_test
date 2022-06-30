<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <a href="{{ route('question1') }}">Question 1</a>
        <a href="{{ route('question2') }}">Question 2</a>
        <a href="{{ route('question3') }}">Question 3</a>
        <a href="{{ route('question4') }}">Question 4</a>
        <a href="{{ route('question5') }}">Question 5</a>
        
        <h1>Question 5</h1>

        <h4>1. The database design is good as it seperates different data into different tables, allowing it to be more scalable and easier to expand. Moreover, there is no USERID foreign key in TBL_TRANSACTIONS, hence making modification such as edit/delete easier.</h4>

        <br>

        <h4>2. </h4>

        <br>

        <h4>3. note: all queries were written in the FunctionsController question5() </h4>
        <h4>a. Top Spender: {{ $top_spender->name }}</h4>
        <h4>b. Number of transactions in each hour of the day: </h4>
        @foreach ($all_hours as $key => $all_hour)
            <p>{{ $key }} : {{ $all_hour }}</p>
        @endforeach
        <h4>c. Items that Adam has bought so far:</h4>
        @foreach ($adam_fruits as $adam_fruit)
            <p>{{ $adam_fruit }}</p>
        @endforeach
        
    </body>
</html>
