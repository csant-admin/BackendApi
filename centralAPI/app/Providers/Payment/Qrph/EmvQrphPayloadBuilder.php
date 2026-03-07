<?php
namespace App\Modules\InvestmentApp\Payments\Providers\Qrph;

use App\Modules\InvestmentApp\Payments\Contracts\QrphPayloadBuilderInterface;

class EmvQrphPayloadBuilder implements QrphPayloadBuilderInterface
{
    public function buildDynamic(array $fields): string
    {
        // TLV helper: ID(2) + LEN(2) + VALUE
        $tlv = function(string $id, string $value): string {
            $len = str_pad((string)strlen($value), 2, '0', STR_PAD_LEFT);
            return $id . $len . $value;
        };

        // Example fields (illustrative only)
        $payload  = $tlv('00', '01');                 // Payload Format Indicator
        $payload .= $tlv('01', '12');                 // Point of Initiation Method (dynamic)
        $payload .= $tlv('53', $fields['currency']);  // 608 for PHP (example depends on standard mapping used)
        $payload .= $tlv('54', $fields['amount']);    // Transaction Amount
        $payload .= $tlv('58', 'PH');                 // Country
        $payload .= $tlv('59', $fields['merchant']);  // Merchant Name
        $payload .= $tlv('62', $tlv('05', $fields['reference'])); // Additional Data Field Template (ref)

        // CRC placeholder (compute real CRC16/CCITT-FALSE in production)
        $payload .= '6304' . $this->crc16($payload . '6304');

        return $payload;
    }

    private function crc16(string $input): string
    {
        // CRC16/CCITT-FALSE
        $crc = 0xFFFF;
        foreach (str_split($input) as $ch) {
            $crc ^= (ord($ch) << 8);
            for ($i = 0; $i < 8; $i++) {
                $crc = ($crc & 0x8000) ? (($crc << 1) ^ 0x1021) : ($crc << 1);
                $crc &= 0xFFFF;
            }
        }
        return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }
}
