<?php

namespace App\Infra\Database\Dao\RegistrationRequests\Abstract;

use Illuminate\Support\Collection;

interface IRegistrationRequestListingDb
{
    public function getRegistrationRequestsPendants(): Collection;
}
