<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /*
     * name —— 权限的唯一名称，如“create-post”，“edit-post”等
     * display_name —— 人类可读的权限名称，如“发布文章”，“编辑文章”等
     * description —— 该权限的详细描述
     * */
}
