<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Ingredients;
use App\Models\Companies;
use App\Models\Products;
use App\Models\Chapters;
use File;
use Auth;
use Session;
use DataTables;

class PDFController extends Controller{
    public function __construct(){
        $this->middleware(['auth', 'role:admin']); 
    }
    
    public function pdfGenerate($id){
        $product     = Products::find($id);
        $company     = $product->company;
        
echo $id;
        die();
        // return view("pdf.dompdf", compact('product','company'));

        $filename    = "/". $product->id . "_" . $product->version . "_" . str_replace(" ","_",$product->name) . ".pdf";
        $path        = public_path('pdf') . $filename;
        if($product->pdf_link != null){
            $headers = array(
                'Content-Type: application/pdf',
                );
            // return \Response::download($path, $product->id . "_" . $product->version . "_" . str_replace(" ","_",$product->name) . ".pdf", $headers);
        // $dompdf->stream();
        }

        $html        = view("pdf.dompdf", compact('product','company'))->render();
        // $html        = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        
        $dompdf = new Dompdf();
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_option('isJavascriptEnabled', true);
        $dompdf->set_option('isHtml5ParserEnabled', true);


        $dompdf->loadHtml($html);
        $dompdf->render();

        if($product->pdf_link == null){
            $output = $dompdf->output();
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/pdf");
            header("Content-Length: " . mb_strlen($output, "8bit"));
            $product->pdf_link = "/pdf".$filename;
            file_put_contents($path, $output);
            $product->save();
        }
        $headers = array(
            'Content-Type: application/pdf',
        );

    return \Response::download($path, $product->id . "_" . $product->version . "_" . str_replace(" ","_",$product->name) . ".pdf", $headers);
    }

    public function pdfPreview($id){
        $product     = Products::find($id);
        $company     = $product->company;
        return view("pdf.dompdf", compact('product','company'));
        
    }
    
}
