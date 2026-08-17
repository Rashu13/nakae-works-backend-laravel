<?php



namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    public function notifications()
    {
        return $this->hasMany(NotificationsModel::class, 'user_id')
            ->where('user_type', 'admin');
    }
}
