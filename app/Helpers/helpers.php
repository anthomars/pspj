<?php

use App\Models\User;
use App\Models\AppSetting;

if (!function_exists('appSetting'))
{
    function appSetting()
    {
        $data = AppSetting::firstOrFail();

        return $data;
    }
}

if (!function_exists('explodeFullname'))
{
    function explodeFullname($fullname)
    {
        $words = explode(" ", $fullname);
        $initial = "";

        for ($i = 0; $i < count($words); $i++) {
            if ($i == 0 or $i == count($words) - 1) {
                $initial .= mb_substr($words[$i], 0, 1);
            }
        }

        return $initial;
    }
}


if (!function_exists('userData'))
{
    function userData($id)
    {
        $user = User::where('id', $id)->first();
        $userData['image'] = $user->image;
        $userData['username'] = $user->username;
        $userData['nama_lengkap'] = $user->nama_lengkap;
        $userData['email'] = $user->email;
        $userData['no_hp'] = $user->no_hp;

        return $userData;
    }
}
