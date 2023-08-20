<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function invoice($id){
        $order = Order::find($id);
        if ($order){
            $data = array();
            $data['order'] = $order;
            $data['user'] = $order->user;
            $data['passengers'] = $order->passengers;
            $data['travels'] = $order->travels;

            $view =  view('pdf.booking-invoice',$data);
            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Courier');
            $options->setChroot(public_path());
            $dompdf->setOptions($options);
            $dompdf->loadHtml($view);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            $dompdf->stream('booking_invoice_'.$order->booking_id);
        }

    }
}
