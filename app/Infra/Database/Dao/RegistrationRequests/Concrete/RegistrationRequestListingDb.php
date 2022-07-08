<?php

namespace App\Infra\Database\Dao\RegistrationRequests\Concrete;

use App\Infra\Database\Config\DbBase;
use App\Infra\Database\Dao\RegistrationRequests\Abstract\IRegistrationRequestListingDb;
use Illuminate\Support\Collection;

class RegistrationRequestListingDb extends DbBase implements IRegistrationRequestListingDb
{

    public function getRegistrationRequestsPendants(): Collection
    {
        return $this->db
            ->table('registration_requests as rr')
            ->select([
                'rr.id as registrationRequestId',
                'u.name as userName',
                'u.email as userEmail',
                'u.phone as userPhone',
                'u.created_at as registrationRequestCreatedAt',
                'rr.rg_photo as registrationRequestRgPhoto',
                'rr.cpf_photo as registrationRequestCpfPhoto',
                'rr.confirm_address_photo as registrationRequestConfirmAddressPhoto',
                'rr.confirmed as registrationRequestConfirmed',
            ])
            ->join('users as u', 'u.id', '=', 'rr.user_id')
            ->where('rr.confirmed', '=', false)
            ->get();
    }
}
