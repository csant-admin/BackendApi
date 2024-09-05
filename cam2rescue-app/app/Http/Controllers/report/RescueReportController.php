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
            $rescue = RescueReport::with(['userDetail','barangay', 'petColor', 'petSex', 'urgency', 'injury', 'rescueStatuses'])->findOrFail($id);
            
            $data = [
                'ImagePath'         => $rescue->ImagePath,
                'RescueId'          => $rescue->RescueId,
                'Address'           => $rescue->SBZ_Address . ' ' . $rescue->barangay->description . ', ' . $rescue->City,
                'BarangayId'        => $rescue->barangay->description,
                'City'              => $rescue->City,
                'PetColorId'        => $rescue->petColor->description,
                'PetSexId'          => $rescue->petSex->description,
                'ImportantNote'     => $rescue->urgency->description . ', ' . $rescue->injury->description,
                'InjuryId'          => $rescue->injury->description,
                'Description'       => $rescue->Description,
                'RescueStatus'      => $rescue->rescueStatuses->description,
                'RescueStatusId'    => $rescue->rescueStatuses->StatusId,
                'created_by'        => $rescue->userDetail->Lastname . ', ' . $rescue->userDetail->Firstname,
                'updated_by'        => $rescue->updated_by ? $rescue->userDetail->Lastname . ', ' . $rescue->userDetail->Firstname : "-",
                'created_at'        => $rescue->created_at->format('Y-m-d g:i A'),
                'updated_at'        => $rescue->updated_at->format('Y-m-d g:i A')
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

