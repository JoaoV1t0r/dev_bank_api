<?php

namespace App\Domains\RegistrationRequest\Services\Abstract;

use Illuminate\Support\Collection;

interface IRegistrationRequestListingService
{
    public function getRegistrationRequestsPendants(): Collection;
}
