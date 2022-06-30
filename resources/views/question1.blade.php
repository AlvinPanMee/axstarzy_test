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
        
        <h1>Question 1</h1>
        <form method="post" action="checkDownload" id="question1_form" name="question1_form">
            @csrf
            <div style="margin-bottom:10px;">
                @if ($status)
                    <input type="text" name="status" id="status" value="{{ $status }}" hidden>
                @endif

                @if ($submit_count)
                    <input type="text" name="submit_count" id="submit_count" value="{{ $submit_count }}" hidden>
                @endif

            </div>
            
            <label for="memberType">Member Type:</label>
            <select name="memberType" id="memberType">
                <option value="member">Member</option>
                <option value="nonMember">Non Member</option>
            </select>

            <label for="fileType">File Type:</label>
            <input type="text" name="fileType" id="fileType" required>

            
            <button type="submit" name="btn_download" id="btn_download">Download</button>
        </form>

        @if ($msg)
            <p>{{ $msg }}</p>
        @endif
    </body>
    <script src="text/javascript">
        var status      = parseInt(document.getElementById('status').value);
        if(status == 0){
            document.getElementById('question1_form').submit();
        }

    </script>
</html>