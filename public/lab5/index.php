<?php

require_once 'BankAccount.php';
require_once 'SavingsAccount.php';


try{
    $not_working = new BankAccount("UAH", -150);
} catch(Exception $ex){
    echo "<br/> <b>Помилка: </b>" . $ex->getMessage(); //  Початковий баланс не може бути менше 0
}

try{
    $denys = new BankAccount("USD", 200);
    $denys->deposit(-10);
} catch(Exception $ex){
    echo "<br/> <b>Помилка: </b>" . $ex->getMessage(); // Сума поповнення повинна бути більшою за 0
}

try{
    $denys = new BankAccount("USD", 200);
    $denys->withdraw(-10);
} catch(Exception $ex){
    echo "<br/> <b>Помилка: </b>" . $ex->getMessage(); // Сума зняття повинна бути більшою за 0
}

try{
    $denys = new BankAccount("USD", 200);
    $denys->withdraw(210);
} catch(Exception $ex){
    echo "<br/> <b>Помилка: </b>" . $ex->getMessage(); // Недостатньо коштів
}

try {
    $denys = new BankAccount("USD", 200);
    $denys->deposit(50);
    $denys->withdraw(30);

    echo "<br/> Баланс denys: " . $denys->getBalance(); // 220 USD

    $savings = new SavingsAccount("EUR", 200);
    $savings->applyInterest(); // 200 + 0.5*200 = 210 EUR

    echo "<br/> Баланс savings + відсотки: " . $savings->getBalance();
} catch (Exception $ex) {
    echo "<br/> Помилка: " . $ex->getMessage();
}
?>
