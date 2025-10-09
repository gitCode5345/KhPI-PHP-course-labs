<?php
require_once "./AccountInterface.php";

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0.0;

    protected float $balance;
    protected string $currency;

    public function deposit(float $amount) {
        if ($amount <= 0) {
            throw new Exception("Будь ласка, перевірьте суму коштів вашого депозиту.");
        }

        $this->balance += $amount;
    }

    public function withdraw(float $amount) {
        if ($amount <= 0 || $amount > $this->balance) {
            throw new Exception("Будь ласка, перевірьте суму коштів, яку Ви хочете зняти.");
        }
        
        $this->balance -= $amount;
    }

    public function getBalance() {
        return "Баланс: " . round($this->balance, 2) . " " . $this->currency;
    }

    public function __construct(float $balance, $currency) {
        $this->balance = self::MIN_BALANCE;
        $this->currency = $currency;
        $this->deposit($balance);
    }
}
