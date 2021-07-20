<?php
declare(strict_types=1);

namespace App\Containers\Enterprise\Tests\V1;

use App\Containers\Enterprise\Mail\EnterprisesQuotaEmail;
use App\Containers\Enterprise\Tests\EnterpriseTestCase;
use Illuminate\Support\Facades\Mail;

final class SendEmailEnterprisesListTest extends EnterpriseTestCase
{
    protected $endpoint = 'get@/v1/enterprises-quota';

    /**
     * Тест выборки предприятия с квотой
     */
    public function testItQuotaWithEnterprises():void
    {

       $enterprise = $this->createEnterprisesAndUsersForQuota();

        $response = $this->makeCall(
            [],
            $this->getAuthorizationParams()
        );
        $data = $response->decodeResponseJson()['data'];
        self::assertSame($enterprise->objid, $data[0]['objid']);

    }

    /**
     * Тест отправки email
     */
    public function testItSendEmailWithEnterprises():void
    {
        Mail::fake();
        $this->createEnterprisesAndUsersForQuota();

        $response = $this->makeCall(
            [],
            $this->getAuthorizationParams()
        );
        $data = $response->decodeResponseJson()['data'];

        Mail::assertSent(EnterprisesQuotaEmail::class, function ($mail) use ($data) {
            $mail->build();
            return $mail->hasTo(config('mail.to.support.address'));
        });
    }
}
