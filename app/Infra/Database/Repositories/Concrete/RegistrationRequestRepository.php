<?php

namespace App\Infra\Database\Repositories\Concrete;

use App\Infra\Database\Config\DbBase;
use App\Infra\Database\Repositories\Abstract\IRegistrationRequestRepository;
use App\Models\RegistrationRequest;
use Exception;
use RuntimeException;

class RegistrationRequestRepository extends DbBase implements IRegistrationRequestRepository
{

    public function delete(RegistrationRequest $registrationRequest): void
    {
        try {
            $registrationRequest->delete();
            $registrationRequest->refresh();
        } catch (Exception $e) {
            throw new RuntimeException('Error deleting registration request');
        }
    }

    public function update(RegistrationRequest $registrationRequest): void
    {
        try {
            $registrationRequest->update();
            $registrationRequest->refresh();
        } catch (Exception $e) {
            throw new RuntimeException('Error updating registration request');
        }
    }

    public function confirmRegistration(RegistrationRequest $registrationRequest): void
    {
        try {
            $this->db->beginTransaction();
            $registrationRequest->confirmed = true;
            if (
                $registrationRequest->save()
            )
                $this->db->commit();
            $registrationRequest->refresh();
        } catch (Exception $e) {
            throw new RuntimeException('Error confirming registration');
        }
    }

    public function save(RegistrationRequest $registrationRequest): void
    {
        try {
            $this->db->beginTransaction();
            $registrationRequest->save();
            $registrationRequest->refresh();
            $this->db->commit();
        } catch (Exception $e) {
            throw new RuntimeException('Error saving registration');
        }
    }
}
