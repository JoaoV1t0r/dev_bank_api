<?php

namespace App\Domains\RegistrationRequest\Services\Concrete;

use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestListingService;
use App\Infra\Database\Dao\RegistrationRequests\Abstract\IRegistrationRequestListingDb;
use Illuminate\Support\Collection;

class RegistrationRequestListingService implements IRegistrationRequestListingService
{
    private IRegistrationRequestListingDb $registrationRequestListingDb;

    public function __construct(IRegistrationRequestListingDb $registrationRequestListingDb)
    {
        $this->registrationRequestListingDb = $registrationRequestListingDb;
    }

    public function getRegistrationRequestsPendants(): Collection
    {
        return $this->registrationRequestListingDb->getRegistrationRequestsPendants();
    }
}
