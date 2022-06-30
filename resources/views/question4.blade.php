<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <a href="{{ route('question1') }}">Question 1</a>
        <a href="{{ route('question2') }}">Question 2</a>
        <a href="{{ route('question3') }}">Question 3</a>
        <a href="{{ route('question4') }}">Question 4</a>

        <h1>Question 4</h1>

        <div style="margin-bottom:10px;">
            <label for="bank_value">Bank Value: </label>
            <input type="decimal" id="bank_value" value="20.20" disabled>
    
            <label for="wallet_value">Wallet Value: </label>
            <input type="decimal" id="wallet_value" value="1000" disabled>
        </div>

        <div>
            <label for="deposit">Deposit</label>
            <input type="number" name="deposit" id="deposit">
    
            <button name="btn_deposit" id="btn_deposit">Deposit</button>
        </div>
        
        

        <p id="msg" style="display: none; color:red">Deposit amount is more than wallet amount</p>

            


    </body>

    <script type="text/javascript">

        //deposit function
        document.getElementById('btn_deposit').addEventListener('click', depositFunction);
        function depositFunction(){
            //input deposit
            var deposit_amount      = parseFloat(document.getElementById('deposit').value);

            //initial amount
            var wallet_value        = parseFloat(document.getElementById('wallet_value').value);
            var bank_value          = parseFloat(document.getElementById('bank_value').value);

            //error message
            var msg                 = document.getElementById('msg');


            if(deposit_amount <= wallet_value){
                console.log('valid amount');
                
                if(deposit_amount >= 100){
                    var cash_bonus = deposit_amount * 0.1;

                    if (cash_bonus > 50){
                        cash_bonus = 50;
                    }

                    console.log(cash_bonus);
                } else {
                    var cash_bonus = 0;
                }

                var newBankValue = bank_value + deposit_amount + cash_bonus;
                document.getElementById('bank_value').value = newBankValue;

                var newWalletValue = wallet_value - deposit_amount;
                document.getElementById('wallet_value').value = newWalletValue;

                
                console.log(newBankValue, newWalletValue);

                msg.style.display = 'none';

            } else if(deposit_amount > wallet_value){
                console.log('invalid amount');


                msg.style.display = 'block';

            }

        }



        

      
        
    </script>
    

</html>