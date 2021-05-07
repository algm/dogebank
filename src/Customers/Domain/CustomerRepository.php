<?php


namespace Dogebank\Customers\Domain;


interface CustomerRepository
{
    public function save(Customer $customer): void;

    public function find(CustomerId $id): ?Customer;

    public function update(Customer $customer): void;
}
