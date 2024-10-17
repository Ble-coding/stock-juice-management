<?php

// app/Models/KycStatus.php

namespace App\Models;

class KycStatus
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';

    public static function all()
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::REJECTED,
        ];
    }
}
