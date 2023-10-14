<?php
namespace App\Models\Sanctum;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    //'this' pega atributos do token. Os atributos do token como ele é um model, os atributos dele vem da migration
    //vc pode criar novos atributos aq se precisar
    public function expiredOrRevoked():bool {
        if (!$this->revoked && $this->expires_at > now()) {
            // O token não foi revogado e ainda não expirou
            return true;
        }else{
            return false;
        }
    }
}
