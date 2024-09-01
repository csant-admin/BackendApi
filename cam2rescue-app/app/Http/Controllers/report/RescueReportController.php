<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\report\RescueReport;
use PDF;

class RescueReportController extends Controller
{
    //

    public function generateRescueReport($id)
    {
        try {
            $rescue = RescueReport::findOrFail($id);
            // return $rescue;
            $data = [
                'rescue' => $rescue->toArray()
            ];
            $html = view('cam2rescue.generateRescueReport', $data)->render();
            $pdf = PDF::loadHTML($html)->setPaper('letter', 'portrait');
            $pdf->render();
            $dompdf = $pdf->getDomPDF();
            $font = $dompdf->getFontMetrics()->get_font("Montserrat", "normal");
            $dompdf->get_canvas()->page_text(550, 750, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));

            $currentDateTime = \Carbon\Carbon::now()->format('Y-m-d g:i A');
            $dompdf->get_canvas()->page_text(35, 750, $currentDateTime, $font, 10, array(0, 0, 0));

            $filename = 'Cam2Rescue_Rescue_Report_' . $id;
            return $pdf->stream($filename . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error generating report: ' . $e->getMessage()], 500);
        }
    }
}

