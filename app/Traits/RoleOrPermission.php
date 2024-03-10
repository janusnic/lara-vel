<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait RoleOrPermission
{
    public function handlePermission($roleOrPermission)
    {
        $authGuard = Auth::guard();
        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if (! $authGuard->user()->hasAnyRole($rolesOrPermissions) && ! $authGuard->user()->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }
    }
}
