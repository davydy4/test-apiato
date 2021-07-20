<?php

namespace App\Containers\Authentication\Tests\Helper;

use App\Containers\Enterprise\Models\Enterprise;
use App\Containers\User\Models\User;
use App\Containers\User\Models\UserAsup;
use App\Containers\User\Tables\UsersTable;
use App\Ship\Parents\Models\UserModel;
use Carbon\Carbon;
use Smiarowski\Postgres\Model\Traits\PostgresArray;
use Tymon\JWTAuth\Facades\JWTAuth;


trait TestAuthenticationHelperTrait
{
    public function getAuthorizationParams(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->token),
        ];
    }

    public function setUpTestingUser()
    {
        $this->testingUser = $this->getUserForTest();
        $this->actingAs($this->testingUser, 'api');
        $this->token = JWTAuth::fromUser($this->testingUser);
    }

    public function getEnterpriseForTest():Enterprise
    {
        $headEnterpriseId = $this->getRandomEnterpriseId();
        return factory(Enterprise::class)->create(
            [
                'objid' => $headEnterpriseId,
                'objidref' => 8800000,
                'objsname' => 'Головной офис',
                'objstatus' => null,
                'is_root' => false,
                'parents' => PostgresArray::mutateToPgArray([$headEnterpriseId]),
            ]
        );
    }

    /**
     * @param array $params
     * @return UserModel|User
     * @throws \Exception
     */
    public function getUserForTest(array $params = []): UserModel
    {
        $enterprise = Enterprise::all()->last();
        if ($enterprise === null) {
            $enterprise = $this->getEnterpriseForTest();
        }

        if (!isset($params['user_asup']['integration_id'])) {
            $params['user_asup']['integration_id'] = random_int(1, 1000000);
        }

        /** @var User $user */
        factory(User::class)->create(
            [
                'integration_id' => $params['user_asup']['integration_id']
            ]
        );

        $userAsupParams = [
            'orgid' => $enterprise->objid,
        ];

        if (isset($params['user_asup']) && is_array($params['user_asup'])) {
            $userAsupParams = array_merge(
                $params['user_asup'],
                $userAsupParams
            );
        }

        $userAsup = factory(UserAsup::class)->create(
            $userAsupParams
        );


        /** @var User $user */
        return User::query()->where(
            UsersTable::INTEGRATION_ID,
            $userAsup->getIntegrationid()
        )
            ->get()->first();
    }

    public function createEnterprisesAndUsersForQuota() :Enterprise
    {
        $enterprise = factory(Enterprise::class)->create([
            'objid'     => 11111111,
            'objidref'  => 8800000,
            'objsname'  => 'ООО Самая лучшая компания',
            'objstatus' => null,
            'is_root'   => false,
            'parents'   => null,
            'quota'     => 5
        ]);

        factory(User::class)->create([
            'id'                => 5,
            'integration_id'    => '1',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 2,
            'integration_id'    => '2',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 3,
            'integration_id'    => '3',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 4,
            'integration_id'    => '4',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 1,
            'fullname'          => 'Тестов Тест Тестович',
            'email'             => 'user1@nor.com',
            'integration_id'    => '1',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 2,
            'fullname'          => 'Абрикосов Абрикос Абрикосович',
            'email'             => 'user2@nor.com',
            'integration_id'    => '2',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 3,
            'fullname'          => 'Огурцов Огурец Огурцович',
            'email'             => 'user3@nor.com',
            'integration_id'    => '3',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 4,
            'fullname'          => 'Молодцов Молодец Молодцович',
            'email'             => 'user4@nor.com',
            'integration_id'    => '4',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        return $enterprise;
    }
}
