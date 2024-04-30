<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Const\KCconst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use stdClass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function listCustomer()
    {
        $select = DB::table('users')
            ->where('position', '=', KCconst::DB_POSITION_CUSTOMER)
            ->where('display', '1')
            ->paginate(10);
        return $select;
    }
    public function countCustomer()
    {
        $count = DB::table('users')
            ->where('position', '=', KCconst::DB_POSITION_CUSTOMER)
            ->where('display', '1')
            ->count();
        return $count;
    }

    public function getAllStaff()
    {
        $select = DB::table('users')
            ->whereIn('position', [KCconst::DB_POSITION_STAFF, KCconst::DB_POSITION_ADMIN])
            ->where('display', '1')
            ->paginate(10);
        return $select;
    }
    public function getAllStaffAssign()
    {
        $select = DB::table('users')
            ->where('position', KCconst::DB_POSITION_STAFF)
            ->where('display', '1')
            ->get()->toArray();
        return $select;
    }

    public function countStaff(): int
    {
        $count = DB::table('users')
            ->whereIn('position', [KCconst::DB_POSITION_STAFF, KCconst::DB_POSITION_ADMIN])
            ->where('display', '1')
            ->count();
        return $count;
    }

    public function detailUser(string $data): stdClass
    {
        $select = DB::table('users')
            ->where('id', $data)
            ->where('display', '1')
            ->first();

        return $select;
    }

}
