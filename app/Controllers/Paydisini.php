<?php

namespace App\Controllers;

use App\Models\DepositModel;
use App\Models\UserModel;
use App\Models\RiwayatSaldoModel;

/**
 * @CSRFExcept
 */

class Paydisini extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->depositModel = new DepositModel();
    }

    public function callback()
    {
        $settings = $this->getSettingsData();
        $apiKey = $settings['paydisini_apikey'];
        $callbackIP = '154.26.137.133';
    
        if ($_SERVER['REMOTE_ADDR'] !== $callbackIP || $_POST['key'] !== $apiKey) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    
        $paymentId = $_POST['unique_code'];
        $status = $_POST['status'];
        $signature = $_POST['signature'];
    
        $expectedSignature = md5($apiKey . $paymentId . 'CallbackStatus');
    
        if ($signature !== $expectedSignature) {
            $result = ['success' => false];
        } else {
            $depositModel = new DepositModel();
            $invoice = $depositModel
                ->where('no_inv', $paymentId)
                ->where('status', 'UNPAID')
                ->first();
    
            if ($invoice) {
                $userModel = new UserModel();
                $user = $userModel->find($invoice['user_id']);
    
                $newBalance = $user['balance'] + $invoice['amount'];
    
                $updateUserResult = $userModel->update($invoice['user_id'], ['balance' => $newBalance]);
    
                $riwayatSaldoModel = new RiwayatSaldoModel();
                $riwayatSaldoData = [
                    'user_id' => $user['id'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'catatan' => 'Top Up Saldo',
                    'jumlah' => $invoice['amount'],
                    'saldo_awal' => $user['balance'],
                    'saldo_akhir' => $newBalance,
                ];
                $riwayatSaldoModel->insert($riwayatSaldoData);
    
                $updateDepositResult = $depositModel->update($invoice['id'], ['status' => 'PAID']);
    
                if ($updateUserResult && $updateDepositResult) {
                    log_message('info', 'Callback successfully handled: ' . json_encode($_POST));
                    $result = ['success' => true];
                } else {
                    log_message('error', 'Failed to handle callback. User update: ' . $updateUserResult . ', Deposit update: ' . $updateDepositResult);
                    $result = ['success' => false];
                }
            } else {
                log_message('error', 'Invoice not found or status is not UNPAID.');
                $result = ['success' => false];
            }
        }
    
        header('Content-type: application/json');
        echo json_encode($result);
    }
}