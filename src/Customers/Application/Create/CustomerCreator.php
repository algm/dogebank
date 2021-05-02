<?php


namespace Dogebank\Customers\Application\Create;

use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Application\CustomerResponse;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerBalance;
use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerName;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use InvalidArgumentException;

class CustomerCreator
{
    public function __construct(
        private BranchesRepository $branchesRepository,
        private CustomerRepository $customerRepository,
        private EventBus $bus
    ) {
    }

    public function __invoke(CustomerCreateRequest $request): CustomerResponse
    {
        $branchId = new BranchId($request->getBranchId());

        $this->ensureBranchExists($branchId);

        $customer = Customer::create(
            new CustomerId($request->getId()),
            $branchId,
            new CustomerName($request->getName()),
            new CustomerBalance($request->getBalance())
        );

        $this->customerRepository->save($customer);
        $this->bus->publish(...$customer->pullEvents());

        return CustomerResponse::fromEntity($customer);
    }

    /**
     * @param BranchId $branchId
     */
    private function ensureBranchExists(BranchId $branchId): void
    {
        $foundBranch = $this->branchesRepository->find($branchId);

        if (empty($foundBranch)) {
            throw new InvalidArgumentException("Branch {$branchId->getValue()} not found");
        }
    }
}
