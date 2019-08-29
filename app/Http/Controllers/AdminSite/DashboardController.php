<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company_profile;
use App\Models\Order;
use App\Models\Subscriber;
use App\User;
use Excel;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
class DashboardController extends Controller
{
    public function showDashboard()
    {
      return view('administratoronly/dashboard')->with([
        "orders"        =>Order::with("order_details")->where("is_deleted","<>",1)->orderBy("created_at","desc")->limit(10)->get()
        ,"totalPerday"  =>Order::with("order_details")->where('order_status',3)->whereDay('created_at', '=', date('d'))->get()
        ,"totalPermonth"=>Order::with("order_details")->where('order_status',3)->whereMonth('created_at', '=', date('m'))->get()
        ,"totalPeryear" =>Order::with("order_details")->where('order_status',3)->whereYear('created_at', '=', date('Y'))->get()
        ,"totalUser"    =>User::count()
        ,"totalCompleteOrder"    =>Order::where('order_status',3)->count()
        ,"totalSubscriber" =>Subscriber::where('is_subscribe',1)->count()
      ]);
    }

    public function exportToExcel(Request $request)
    {
      $this->validate($request,[
        "start_date"=>"required|date",
        "end_date"  =>"required|date|after_or_equal:start_date"
      ],["end_date.after_or_equal"=>"The end date must be greater or equal than start date."]);

      $start_date = date("Y-m-d",strtotime($request->input('start_date')));
      $end_date = date("Y-m-d",strtotime($request->input('end_date')));

      $orders = Order::getRecordForReport($start_date, $end_date)->get();

      Excel::create('SALESREPOT('.date("Ymd",strtotime($request->input('start_date'))).'-'.date("Ymd",strtotime($request->input('end_date'))).')', function($excel) use ($start_date,$end_date,$orders) {


        $excel->sheet("SALESREPORT", function($sheet) use($start_date,$end_date,$orders) {
          $company = Company_profile::first();
          $headers=[ "No","Nomor Order","Tanggal","Nama Konsumen","Email","Kota","Status","JNE Tracking","Nama Produk","Harga Produk","Harga Produk Net","Quantity","Subtotal","Tax","Ongkos Kirim","Subsidi Ongkos Kirim","Total"];
          $tax=array_sum(array_pluck($orders,'tax'));
          $free_shipping=array_sum(array_pluck($orders,'free_shipping'));
          if($tax == 0){
            if (($key = array_search("Tax",$headers)) !== false) {
                unset($headers[$key]);
            }
          }

          if($free_shipping == 0){
            if (($key = array_search("Subsidi Ongkos Kirim",$headers)) !== false) {
                unset($headers[$key]);
            }
          }

          //Set Header
          $alphabet="A";
          foreach($headers as $header){
            $sheet->cell($alphabet.'3', function($cell) use($header) {
                $cell->setValue($header);
            });
            $alphabet = chr(ord($alphabet)+1);
          }
          $alphabet = chr(ord($alphabet)-1);

          $sheet->getStyle('A3:'.$alphabet.'3')->applyFromArray(array(
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'cacaca')
            ),
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            ),
            'font'  => array(
                'bold'  => true,
            )
          ));

          $sheet->mergeCells('A2:'.$alphabet.'2');
          $sheet->cell('A2', function($cell) use($start_date,$end_date) {
            $cell->setValue("Periode :".date("d F Y",strtotime($start_date))." - ".date("d F Y",strtotime($end_date)));
          });

          if(count($orders) == 0){
            /* No Record */
            $sheet->mergeCells('A4:'.$alphabet.'4');
            $sheet->cell('A4', function($cell)  {
              $cell->setValue("No Record");
            });
            $sheet->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
          }else{
            //set BODY
            $grandtotal=0;
            $loop=4;
            foreach($orders as $order){
              $alphabet="A";
              $headers=[ "No","Nomor Order","Tanggal","Nama Konsumen","Email","Kota","Status","JNE Tracking","Nama Produk","Harga Produk"
              ,"Harga Produk Net","Quantity","Subtotal","Tax","Ongkos Kirim","Subsidi Ongkos Kirim"
              ,"Total"];

              $sheet->cell($alphabet.$loop, function($cell) use($order,$loop) {
                  $cell->setValue($loop-3);
              });
              $sheet->getStyle($alphabet.$loop)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->order_no);
              });
              $sheet->getStyle($alphabet.$loop)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue(date("d-M-Y H:i:s",strtotime($order->created_at)));
              });
              $sheet->getStyle($alphabet.$loop)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->billing_first_name." ".$order->billing_last_name);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->billing_email);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->billing_jne_city_label);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->status);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->jne_track);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->product_name);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->price);
              });
              $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->net_price);
              });
              $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->quantity);
              });

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->subtotal);
              });
              $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');

              if($tax > 0){
                $alphabet = chr(ord($alphabet)+1);
                $sheet->cell($alphabet.$loop, function($cell) use($order) {
                    $cell->setValue($order->tax);
                });
                $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');
              }

              if($free_shipping > 0){
                $alphabet = chr(ord($alphabet)+1);
                $sheet->cell($alphabet.$loop, function($cell) use($order) {
                    $cell->setValue($order->jne_shipping_value ?? 0);
                });
                $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');
              }

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->free_shipping);
              });
              $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');

              $alphabet = chr(ord($alphabet)+1);
              $sheet->cell($alphabet.$loop, function($cell) use($order) {
                  $cell->setValue($order->total);
              });
              $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');
              $loop++;
              $grandtotal += $order->total;
            }
            $sheet->getStyle('A4:'.$alphabet.$loop)->applyFromArray(array(
              'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
                )
              )
            ));

            $alphabet = chr(ord($alphabet)-1);
            $sheet->mergeCells('A'.$loop.':'.$alphabet.$loop);
            $sheet->cell('A'.$loop, function($cell) use($start_date,$end_date) {
              $cell->setValue("GRANDTOTAL :");
            });
            $sheet->getStyle('A'.$loop)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $alphabet = chr(ord($alphabet)+1);
            $sheet->cell($alphabet.$loop, function($cell) use($order,$grandtotal) {
                $cell->setValue($grandtotal);
            });
            $sheet->getStyle($alphabet.$loop)->getNumberFormat()->setFormatCode('#,##0');

            $sheet->getStyle('A'.$loop.':'.$alphabet.$loop)->applyFromArray(array(
              'font'  => array(
                  'bold'  => true,
              )
            ));
          }//END count ORDER
        });
      })->download('xls');
    }
}
