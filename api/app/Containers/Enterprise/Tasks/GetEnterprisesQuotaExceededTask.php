<?php

namespace App\Containers\Enterprise\Tasks;

use App\Containers\Enterprise\Data\Repositories\EnterpriseRepository;
use App\Containers\User\Tables\UsersAsupTable;
use App\Ship\App\Enterprise\EnterpriseTable;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetEnterprisesQuotaExceededTask extends Task
{

    protected $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $search
     * @param int|null $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function run()
    {
        //TODO так как в ТЗ не указано откуда происходит % квоты просто указываю его здесь
        $percent = 0.8;

        $this->addRequestCriteria($this->repository);
        $this->repository
        ->with('user_asup')
        ->select(EnterpriseTable::TABLE .'.*')
        ->leftJoin(UsersAsupTable::TABLE, UsersAsupTable::TABLE . '.orgid', '=', EnterpriseTable::TABLE . '.objid')
        ->groupBy(EnterpriseTable::TABLE .'.objid')
        ->havingRaw( 'count(users_asup.*) >= ' . EnterpriseTable::TABLE .'.quota *' . $percent);


        return $this->repository->paginate($limit ?? '*');
    }
}
