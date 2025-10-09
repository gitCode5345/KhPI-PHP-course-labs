<?php
interface AccountInterface {
    public function deposit(float $amount);
    public function withdraw(float $amount);
    public function getBalance();
}
