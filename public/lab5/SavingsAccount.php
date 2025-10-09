<?php
require_once "./BankAccount.php";

class SavingsAccount extends BankAccount {
    static private float $interestRate = 5.5;

    public function applyInterest() {
        $this->balance += ($this->balance * self::$interestRate) / 100;
    }

    public function getInterestRate() {
        return self::$interestRate;
    }

    public function __construct(float $balance, $currency)
    {
        parent::__construct($balance, $currency);
    }
}
