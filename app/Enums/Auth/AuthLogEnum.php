<?php

namespace App\Enums\Auth;

enum AuthLogEnum: string
{
    case LogRegisteredUser = 'LogRegisteredUser';
    case LogSuccessfulLogin = 'LogSuccessfulLogin';
    case LogPasswordReset = 'LogPasswordReset';
    case LogPasswordResetRequest = 'LogPasswordResetRequest';
    case LogFailedLogin = 'LogFailedLogin';
}
