<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class HostDomainActive
 *
 * @package App\Components\Subscribers\Http\Rules
 */
class HostDomainActive implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $email
     *
     * @return bool
     */
    public function passes($attribute, $email): bool
    {
        $domain = strrchr($email, "@");

        if (!$domain) {
            return false;
        }

        $host = substr($domain, 1);

        $active = checkdnsrr($host);

        return $active;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "Email domain is not active.";
    }
}
