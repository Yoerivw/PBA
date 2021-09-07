<?php 

include_once ('application/config/config.php');

function transformDate($date){
    $newDate = date('Y-m-d', strtotime($date));
    return $newDate;
}

//id=39?dt=2021-06-24%2000:00:00?desctask%202%20?cat=Transportation?amt=8291.24
$id = $_GET['id'];
$transaction = $_GET['transaction'];
$description = $_GET['description'];
$category = $_GET['category'];
$date = transformDate($_GET['date']);
$amount = $_GET['amount'];

echo $transaction . ' + ' . $description . ' + ' . $category . ' + ' . $date . ' + ' . $amount;

/*
output
48
income
07-06-2021
entry number 2
Household
1235888.25 */





            echo '<form method="POST">';

             if($transaction == "income"){
                  
            echo   '<fieldset class="form-group row">
                            <div class="col-8">
                            <div class="form-check form-check-inline">
                            
                                <input class="form-check-input" type="radio" name="transaction" value="expense">
                                <label class="form-check-label" for="transaction">
                                    Expense
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="transaction" value="income" checked>
                                <label class="form-check-label" for="transaction">
                                    Income
                                </label>
                            </div>
                            </div>
                    </fieldset>';
                         } else {

                 echo   '<fieldset class="form-group row">
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
                    </fieldset>';
                }
                    

                       
                    echo '<label for="date of transaction">
                            Enter the Date:
                            <input type="date" name="date" value="'.$date.'">
                        </label>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" value="'.$description.'" aria-describedby="Description">
                        </div>

                        <div class="form-group">
                            <label for="categories">Category</label>
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
                        <div>
                            <input type="hidden" name="id" value="<?php echo $row[0];?>">
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" value="'.$amount.'" aria-describedby="amount" step="0.01">
                        </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">Save</button>
                        </div>
                    </div>
                </form>';