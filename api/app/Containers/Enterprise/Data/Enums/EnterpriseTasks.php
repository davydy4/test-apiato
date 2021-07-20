<?php

namespace App\Containers\Enterprise\Data\Enums;

class EnterpriseTasks
{
    public const GET_ALL_TASK = 'Enterprise@GetAllEnterprisesTask';
    public const GET_ALL_BY_PARENT_TASK = 'Enterprise@GetEnterprisesByParentTask';
    public const GET_QUOTA_EXCEEDED_TASK = 'Enterprise@GetEnterprisesQuotaExceededTask';
}
