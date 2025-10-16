<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use setasign\Fpdi\Fpdi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function generatePDF()
    {
        $data = [
            
        ];
        $customPaper = array(0,0,80,400);
        $pdf = PDF::loadView('depot_bl.printcard', $data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper($customPaper,'landscape');
    
        return $pdf->download('card.pdf');
    }
    public function fillPDF(Request $request)
    {
        $filePath = public_path("1 card.pdf");
        $outputFilePath = public_path("1 card_o.pdf");
        $this->fillPDFFile($filePath, $outputFilePath);
          
        return response()->file($outputFilePath);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillPDFFile($file, $outputFilePath)
    {
        $fpdi = new FPDI;
          
        $count = $fpdi->setSourceFile($file);
  
        for ($i=1; $i<=$count; $i++) {
  
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
              
            $fpdi->SetFont("helvetica", "", 15);
            $fpdi->SetTextColor(0,0,0);
  
            $left = 120;
            $top = 40;
            $text = "35201-1234567-8";
            $fpdi->Text($left,$top,$text);
            $left1 = 30;
            $top1 = 45;
            $text1 = "student";
            $fpdi->Text($left1,$top1,$text1);
            $left2 = 30;
            $top2 = 40;
            $text2 = "zainmahmod";
            $fpdi->Text($left2,$top2,$text2);
  
            $fpdi->Image("https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg", 80, 25,20);
        }
  
        return $fpdi->Output($outputFilePath, 'F');
    }
    public function fillbPDF(Request $request)
    {
        $filePath = public_path("2 card.pdf");
        $outputFilePath = public_path("2 card_o.pdf");
        $this->fillbPDFFile($filePath, $outputFilePath);
          
        return response()->file($outputFilePath);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillbPDFFile($file, $outputFilePath)
    {
        $fpdi = new FPDI;
          
        $count = $fpdi->setSourceFile($file);
  
        for ($i=1; $i<=$count; $i++) {
  
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
              
            $fpdi->SetFont("helvetica", "", 15);
            $fpdi->SetTextColor(0,0,0);
  
            $left = 130;
            $top = 110;
            $text = "35201-1234567-8";
            $fpdi->Text($left,$top,$text);
            $left1 = 150;
            $top1 = 27;
            $text1 = "student";
            $fpdi->Text($left1,$top1,$text1);
            $left2 = 150;
            $top2 = 23;
            $text2 = "zainmahmod";
            $fpdi->Text($left2,$top2,$text2);
  
            $fpdi->Image("https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg", 190, 10,20);
        }
  
        return $fpdi->Output($outputFilePath, 'F');
    }
}
