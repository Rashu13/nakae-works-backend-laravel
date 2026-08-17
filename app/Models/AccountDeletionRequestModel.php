<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDeletionRequestModel extends Model
{
    use HasFactory;

    protected $table = 'account_deletion_requests';

    protected $fillable = [
        'user_type',
        'phone_or_email',
        'reason',
        'status',
    ];
}
