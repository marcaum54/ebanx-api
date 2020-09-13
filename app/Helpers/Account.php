<?php

namespace app\Helpers;

class Account
{
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_TRANSFER = 'transfer';

    const JSON_PATH = __DIR__ . '/../../database/account.json';

    public function __construct()
    {
        $this->json = Json::read(self::JSON_PATH);
    }

    public function reset()
    {
        Json::clear(self::JSON_PATH);
        return ['code' => Http::CODE_200, 'body' => 'OK'];
    }

    public function balance()
    {
        $account_id = $_GET['account_id'];

        if(!$this->json[$account_id])
            Http::header_not_found();

        return [
            'code' => Http::CODE_200,
            'body' => $this->json[$account_id]
        ];
    }

    public function deposit($destination, $amount)
    {
        $this->json[$destination] += $amount;

        return [
            'destination' => [
                'id' => $destination,
                'balance' => $this->json[$destination]
            ]
        ];
    }
    
    public function withdraw($origin, $amount)
    {
        if(!$this->json[$origin])
            Http::header_not_found();

        $this->json[$origin] -= $amount;

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $this->json[$origin]
            ]
        ];
    }
    
    public function transfer($origin, $amount, $destination)
    {
        $withdraw = $this->withdraw($origin, $amount);
        $deposit = $this->deposit($destination, $amount);

        return $withdraw + $deposit;
    }

    public function process_event()
    {
        $params = json_decode(file_get_contents('php://input'), true);

        $type = $params['type'];
        $amount = $params['amount'];
        $origin = $params['origin'];
        $destination = $params['destination'];
        
        if( $type === self::TYPE_DEPOSIT )
        {
            $body = $this->deposit($destination, $amount);
        }

        if( $type === self::TYPE_WITHDRAW )
        {
            $body = $this->withdraw($origin, $amount);
        }

        if( $type === self::TYPE_TRANSFER )
        {
            $body = $this->transfer($origin, $amount, $destination);
        }

        $this->_save();

        return [
            'code' => Http::CODE_201,
            'body' => json_encode($body),
        ];
    }

    protected function _save()
    {
        return Json::write(self::JSON_PATH, $this->json);
    }
}
