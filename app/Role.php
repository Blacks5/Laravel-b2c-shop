<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /*
     * name —— 角色的唯一名称，如“admin”，“owner”，“employee”等
     * display_name —— 人类可读的角色名，例如“后台管理员”、“作者”、“雇主”等
     * description —— 该角色的详细描述
     * display_name和description属性都是可选的，在数据库中的相应字段默认为空。
     */
}
