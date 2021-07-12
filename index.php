<?php

require_once "application/config/config.php";

//transform the date retrieved from mysql "1970-01-01 00:33:41" into "01-01-1970" (day , month , year) format
function sanitizeDate($date){
    $newDate = date('d-m-Y', strtotime($date));
    return $newDate;
}

    //$date = $_GET['date']; //string(10) "2021-06-01" 
    //$mysqldate = date('Y-m-d H:i:s', strtotime($date)); //string(19) "1970-01-01 00:33:41" // this variable to be sent as date to mysql

    //!empty($transaction) && !empty($description) && !empty($category) && !empty($date) && !empty($amount)

    /*
        $transaction = varchar 255;
        $description = varchar 255
        $category = varchar 255
        $date = mysqldate
        $amount = float 
    */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            //echo "1. Submit button is clicked and set <br>";
                $transaction = $_POST['transaction'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $date = $_POST['date'];
                $amount = $_POST['amount'];

            if(isset($transaction) && isset($description) && isset($category) && isset($date) && isset($amount)){
                /* echo "2. This if statement works <br>";
                
    
                echo "Transaction: " . $transaction . "<br>";
                echo "Description: " . $description . "<br>";
                echo "Category: " . $category . "<br>";
                echo "Amount: " . $amount . "<br>";
                echo "Date:" . $date . "<br>"; */
    
                try {
                    $sql = 'INSERT INTO transaction_list (transaction,description,category,date,amount) VALUES (:transaction, :description, :category, :date, :amount)';
                
                    $statement = $pdo->prepare($sql);
                
                    $statement->execute(array(
                        ':transaction' => $transaction,
                        ':description' => $description,
                        ':category' => $category,
                        ':date' => $date,
                        ':amount' => $amount
                    ));
                    //echo "3. this is after the sql insert is successful <br>";
                } catch (PDOException $e){
                        echo "ERROR: " . $e->getMessage();
                }
                
            }
            
            
        } else {
            echo "4. it did not set <br>";
        }
    }

    

    $stmt = $pdo->query('SELECT  * from transaction_list');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Home Page</title>
</head>
<body>
    <header class="px-3 py-1" style="background-color: #ccc;">
        <div class="row">
            <div class="col-12">
            <div class="d-flex justify-content-around p-2 bd-highlight">
                <p>Current Balance: <span id="CBalance">$30,000,000.98</span></p>
                <p>Income This Month: <span id="Ibalance">$1,000,000</span></p>
                <p>Expense This Month: <span id="Ebalance">$100,000</span></p>
                
            </div>
                
            </div>
        </div>
    </header>

    <section id="data" class="vh-100">
        <div class="row h-100">
            <div class="col-8 bg-secondary pl-5 py-5">
                <h3>Options and search functionality come here</h3>
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Edit/delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($results as $result) :?>
                        <tr>
                            <th scope="row"><?= sanitizeDate($result['date']); ?></th>
                            <td><?= $result['description'] ?></td>
                            <td><?= $result['category'] ?></td>
                            <td><?= $result['amount'] ?></td>
                            <td><a><span>Edit</span></a> | <a><span>Delete</span></a></td>
                        </tr>

                    <?php endforeach; ?>
                       
                        
                    </tbody>
                </table>
            </div>
            <div class="col-4 bg-dark pr-5 py-5">
                <h3>Data entry in form comes here</h3>

                <form method="POST">
                    <fieldset class="form-group row">
                            <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="transaction" value="expense" checked>
                                <label class="form-check-label" for="transaction">
                                    Expense
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="transaction" value="income">
                                <label class="form-check-label" for="transaction">
                                    Income
                                </label>
                            </div>
                            </div>
                    </fieldset>

                       
                        <label for="date of transaction">
                            Enter the Date:
                            <input type="date" name="date">
                        </label>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" aria-describedby="Description">
                        </div>

                        <div class="form-group">
                            <label for="categories" >Category</label>
                            <select class="form-control" name="category">
                            <option>Groceries</option>
                            <option>Eating Out</option>
                            <option>Housing</option>
                            <option>Utilities</option>
                            <option>Household</option>
                            <option>Living</option>
                            <option>Transportation</option>
                            <option>Health Care</option>
                            <option>Personal</option>
                            <option>Entertainment</option>
                            <option>Debt Payments</option>
                            <option>Savings</option>
                            <option>Business Expenses</option>
                            <option>Miscelaneous</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" aria-describedby="amount" step="0.01">
                        </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>