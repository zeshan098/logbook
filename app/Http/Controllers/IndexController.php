<?php

namespace App\Http\Controllers;
use App\Models\User;  
use App\Models\Chanel;  
use App\Models\ChanelService; 
use App\Models\CustomerInfo; 
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;  
use Carbon\Carbon;
use Session;
use DB;  

class IndexController extends Controller
{

    public function index()
    
    {
        $role = Auth::user()->role; 
        
        if($role == 'admin'){
            return view('admin.index.index');
        } 
        else if($role == 'employee'){
            return view('employee.index.index');
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }

    public function st_dashboard()
    
    {
        $role = Auth::user()->role;  
        $total_vol =  DB::select(" select  SUM(REPLACE(volume, '.', ''))  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $total_pro =  DB::select(" select  SUM(REPLACE(provision, '.', ''))  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $total_count =  DB::select(" select  ROUND(SUM(REPLACE(provision, '.', ''))/count(*),2)  AS price from customer_info
                                    where status = 'Won' 
                                    and chanel_id = '1' 
                                    LIMIT 1" );
        $won_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Won')->count();
        $pipeline_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Pipeline')->count();
        $holds_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Holds')->count();
        $lost_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Lost')->count();

        $service_count =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                   ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                   inner join chanel_services cs on ci.service_id = cs.id 
                                   where ci.chanel_id = '1' 
                                   and cs.status = 'open'
                                   group by  cs.service_name,cs.bg_colr,cs.txt_colr " );  
        $service_counts =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                        inner join chanel_services cs on ci.service_id = cs.id 
                                        where ci.chanel_id = '1' 
                                         and cs.status = 'open'
                                        group by  cs.service_name,cs.bg_colr,cs.txt_colr " ); 
        $total_ref_pg = DB::table("customer_info")->where('chanel_id', '1')->where('status','!=', 'close')->count(); 
        
        $total_vol_p =  DB::select(" select  FORMAT(SUM(REPLACE(volume, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $total_pro_p =  DB::select(" select  FORMAT(SUM(REPLACE(provision, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '1' 
                                   LIMIT 1" );

        $pipeline_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Pipeline')->get(); 
        $hold_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Holds')->get(); 
        $won_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Won')->get(); 
        $lost_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Lost')->get(); 
        
        $chanel_review_won =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count ,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '1' 
                                            and ci.status = 'Won'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        $chanel_review_lost =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count ,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '1' 
                                            and ci.status = 'Lost'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        $total_ch_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, 
                                    REPLACE(sum(ci.volume), '.', '') as vol, sum(ci.volume) as vol_ind
                                    FROM customer_info ci 
                                    inner join chanel_services cs on ci.service_id = cs.id 
                                    where ci.chanel_id = '1' 
                                    and ci.status = 'Won'
                                    group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
                                    
        $items_vol = array();
        foreach($total_ch_colume as $username) {
           $items_vol[] = $username->vol;
           $items_ch[] =  $username->service_name;
           $items_colr[] =  $username->txt_colr;
        }
          
        if(empty($total_ch_colume)){
            $items_colr[] = '';
            $items_ch[] = '';
            $items_vol[] = '';
            $ch_col = '';
        }else{
            $chanel_vol = implode(",", $items_colr);
            $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
            $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';
        }
        // $chanel_vol = implode(",", $items_colr);
        // $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
        // $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';
         
        $total_pro_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, 
                                    REPLACE(sum(ci.provision), '.', '') as pro, sum(ci.provision) as pro_ind
                                    FROM customer_info ci 
                                    inner join chanel_services cs on ci.service_id = cs.id 
                                    where ci.chanel_id = '1' 
                                    and ci.status = 'Won'
                                    group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
                                    
        $items_pro = array();
        foreach($total_pro_colume as $username_pro) {
           $items_pro[] = $username_pro->pro;
           $items_ch_pro[] =  $username_pro->service_name;
           $items_colr_pro[] =  $username_pro->txt_colr;
        }
        if(empty($total_pro_colume)){
            $items_colr_pro[] = '';
            $items_ch_pro[] = '';
            $ch_col_pro = '';
        }else{
            $chanel_vol_pro = implode(",", $items_colr_pro);
            $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
            $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';
        }    
        // $chanel_vol_pro = implode(",", $items_colr_pro);
        // $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
        // $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';

        if($role == 'admin'){
            return view('admin.index.index')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('total_count', $total_count)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust)
            ->with('chanel_review_won', $chanel_review_won)
            ->with('chanel_review_lost', $chanel_review_lost)
            ->with('total_ch_colume', $total_ch_colume)
            ->with('items_vol', implode(",", $items_vol))
            ->with('items_ch', implode(",", $items_ch))
            ->with('ch_col', $ch_col)
            ->with('total_pro_colume', $total_pro_colume)
            ->with('items_pro', implode(",", $items_pro))
            ->with('items_ch_pro', implode(",", $items_ch_pro))
            ->with('ch_col_pro', $ch_col_pro);
        } 
        else{
            return redirect()->back();
        }
         
    }

    public function dashboard_new()
    
    {
        $role = Auth::user()->role;  
        $total_vol =  DB::select(" select  SUM(REPLACE(volume, '.', ''))  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_pro =  DB::select(" select  SUM(REPLACE(provision, '.', ''))  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_count =  DB::select(" select  ROUND(SUM(REPLACE(provision, '.', ''))/count(*),2)  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $won_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Won')->count();
        $pipeline_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Pipeline')->count();
        $holds_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Holds')->count();
        $lost_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Lost')->count();

        $service_count =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                   ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                   inner join chanel_services cs on ci.service_id = cs.id 
                                   where ci.chanel_id = '2' 
                                   and cs.status = 'open'
                                   group by  cs.service_name,cs.bg_colr,cs.txt_colr " );  
        $service_counts =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                        inner join chanel_services cs on ci.service_id = cs.id 
                                        where ci.chanel_id = '2' 
                                        and cs.status = 'open'
                                        group by  cs.service_name,cs.bg_colr,cs.txt_colr " ); 
        $total_ref_pg = DB::table("customer_info")->where('chanel_id', '2')->where('status','!=', 'close')->count(); 

        $total_vol_p =  DB::select(" select  FORMAT(SUM(REPLACE(volume, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_pro_p =  DB::select(" select  FORMAT(SUM(REPLACE(provision, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );

        $pipeline_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Pipeline')->get(); 
        $hold_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Holds')->get(); 
        $won_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Won')->get(); 
        $lost_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Lost')->get(); 

        $chanel_review_won =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '2' 
                                            and ci.status = 'Won'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        $chanel_review_lost =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '2' 
                                            and ci.status = 'Lost'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        
        $total_ch_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, 
                            REPLACE(sum(ci.volume), '.', '') as vol, sum(ci.volume) as vol_ind
                            FROM customer_info ci 
                            inner join chanel_services cs on ci.service_id = cs.id 
                            where ci.chanel_id = '2' 
                            and ci.status = 'Won'
                            group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
        
        $items_vol = array();
        foreach($total_ch_colume as $username) {
            $items_vol[] = $username->vol;
            $items_ch[] =  $username->service_name;
            $items_colr[] =  $username->txt_colr;
        }
        if(empty($total_ch_colume)){
            $items_colr[] = '';
            $items_ch[] = '';
            $items_vol[] = '';
            $ch_col = '';
        }else{
            $chanel_vol = implode(",", $items_colr);
            $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
            $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';
        }

        // $chanel_vol = implode(",", $items_colr);
        // $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
        // $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';

        $total_pro_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr,
                            REPLACE(sum(ci.provision), '.', '') as pro, sum(ci.provision) as pro_ind
                            FROM customer_info ci 
                            inner join chanel_services cs on ci.service_id = cs.id 
                            where ci.chanel_id = '2' 
                            and ci.status = 'Won'
                            group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
                
        $items_pro = array();
        foreach($total_pro_colume as $username_pro) {
            $items_pro[] = $username_pro->pro;
            $items_ch_pro[] =  $username_pro->service_name;
            $items_colr_pro[] =  $username_pro->txt_colr;
        }

        if(empty($total_pro_colume)){
            $items_colr_pro[] = '';
            $items_ch_pro[] = '';
            $ch_col_pro = '';
        }else{
            $chanel_vol_pro = implode(",", $items_colr_pro);
            $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
            $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';
        }   

        // $chanel_vol_pro = implode(",", $items_colr_pro);
        // $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
        // $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';

        if($role == 'admin'){
            return view('admin.index.dashboard_new')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('total_count', $total_count)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust)
            ->with('chanel_review_won', $chanel_review_won)
            ->with('chanel_review_lost', $chanel_review_lost)
            ->with('total_ch_colume', $total_ch_colume)
            ->with('items_vol', implode(",", $items_vol))
            ->with('items_ch', implode(",", $items_ch))
            ->with('ch_col', $ch_col)
            ->with('total_pro_colume', $total_pro_colume)
            ->with('items_pro', implode(",", $items_pro))
            ->with('items_ch_pro', implode(",", $items_ch_pro))
            ->with('ch_col_pro', $ch_col_pro);
         
        } 
        else{
            return redirect()->back();
        }
         
    }


    public function dashboard_total()
    
    {
        $role = Auth::user()->role;  
        $total_vol =  DB::select(" select  SUM(REPLACE(volume, '.', ''))  AS price from customer_info
                                   where status = 'Won' 
                                   LIMIT 1" );
        $total_pro =  DB::select(" select  SUM(REPLACE(provision, '.', ''))  AS price from customer_info
                                   where status = 'Won'  
                                   LIMIT 1" );
        $total_count =  DB::select(" select  ROUND(SUM(REPLACE(provision, '.', '')) / count(*),0) AS price from customer_info ci
                                    where status = 'Won'  
                                    LIMIT 1" ); 

        $service_count =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                   ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                   inner join chanel_services cs on ci.service_id = cs.id 
                                   where ci.chanel_id = '2' 
                                   group by  cs.service_name,cs.bg_colr,cs.txt_colr " );  
        $service_counts =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                        inner join chanel_services cs on ci.service_id = cs.id 
                                        where ci.chanel_id = '2' 
                                        group by  cs.service_name,cs.bg_colr,cs.txt_colr " ); 
        $total_ref_pg = DB::table("customer_info")->where('chanel_id', '2')->count(); 

        $total_vol_p =  DB::select(" select  FORMAT(SUM(REPLACE(volume, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_pro_p =  DB::select(" select  FORMAT(SUM(REPLACE(provision, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );

        $pipeline_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Pipeline')->get(); 
        $hold_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Holds')->get(); 
        $won_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Won')->get(); 
        $lost_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Lost')->get(); 

        $chanel_review_won =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '2' 
                                            and ci.status = 'Won'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        $chanel_review_lost =  DB::select("SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*) as count,
        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                            inner join chanel_services cs on ci.service_id = cs.id 
                                            where ci.chanel_id = '2' 
                                            and ci.status = 'Lost'
                                            group by  cs.service_name,cs.bg_colr,cs.txt_colr");
        
        $total_ch_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, 
                            REPLACE(sum(ci.volume), '.', '') as vol, sum(ci.volume) as vol_v
                            FROM customer_info ci 
                            inner join chanel_services cs on ci.service_id = cs.id  
                            where ci.status = 'Won'
                            group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
        
        $items_vol = array();
        foreach($total_ch_colume as $username) {
            $items_vol[] = $username->vol;
            $items_ch[] =  $username->service_name;
            $items_colr[] =  $username->txt_colr;
        }

        if(empty($total_ch_colume)){
            $items_colr[] = '';
            $items_ch[] = '';
            $items_vol[] = '';
            $ch_col = '';
        }else{
            $chanel_vol = implode(",", $items_colr);
            $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
            $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';
        }

        // $chanel_vol = implode(",", $items_colr);
        // $rep_ch_col = str_replace('text', '--vz', $chanel_vol);
        // $ch_col = '["'.str_replace(',','","',$rep_ch_col).'"]';

        $total_pro_colume =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, 
                REPLACE(sum(ci.provision), '.', '') as pro,sum(ci.provision) as pro_v
                FROM customer_info ci 
                inner join chanel_services cs on ci.service_id = cs.id  
                where ci.status = 'Won'
                group by  cs.service_name,cs.bg_colr,cs.txt_colr " );
                
        $items_pro = array();
        foreach($total_pro_colume as $username_pro) {
            $items_pro[] = $username_pro->pro;
            $items_ch_pro[] =  $username_pro->service_name;
            $items_colr_pro[] =  $username_pro->txt_colr;
        }

        if(empty($total_pro_colume)){
            $items_colr_pro[] = '';
            $items_ch_pro[] = '';
            $ch_col_pro = '';
        }else{
            $chanel_vol_pro = implode(",", $items_colr_pro);
            $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
            $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';
        }   
        
        // $chanel_vol_pro = implode(",", $items_colr_pro);
        // $rep_pro_col = str_replace('text', '--vz', $chanel_vol_pro);
        // $ch_col_pro = '["'.str_replace(',','","',$rep_pro_col).'"]';
        
        if($role == 'admin'){
            return view('admin.index.dashboard_total')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro) 
            ->with('total_count', $total_count) 
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust)
            ->with('chanel_review_won', $chanel_review_won)
            ->with('chanel_review_lost', $chanel_review_lost)
            ->with('total_ch_colume', $total_ch_colume)
            ->with('items_vol', implode(",", $items_vol))
            ->with('items_ch', implode(",", $items_ch))
            ->with('ch_col', $ch_col)
            ->with('total_pro_colume', $total_pro_colume)
            ->with('items_pro', implode(",", $items_pro))
            ->with('items_ch_pro', implode(",", $items_ch_pro))
            ->with('ch_col_pro', $ch_col_pro);
         
        } 
        else{
            return redirect()->back();
        }
         
    }

    public function results()
    
    {
        $role = Auth::user()->role;  
        $total_vol =  DB::select(" select  SUM(REPLACE(volume, '.', ''))  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $total_pro =  DB::select(" select  SUM(REPLACE(provision, '.', ''))  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $won_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Won')->count();
        $pipeline_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Pipeline')->count();
        $holds_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Holds')->count();
        $lost_status = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Lost')->count();

        $service_count =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                   ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                   inner join chanel_services cs on ci.service_id = cs.id 
                                   where ci.chanel_id = '1' 
                                   group by  cs.service_name,cs.bg_colr,cs.txt_colr " );  
        $service_counts =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '1' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                        inner join chanel_services cs on ci.service_id = cs.id 
                                        where ci.chanel_id = '1' 
                                        group by  cs.service_name,cs.bg_colr,cs.txt_colr " ); 
        $total_ref_pg = DB::table("customer_info")->where('chanel_id', '1')->count(); 

        $total_vol_p =  DB::select(" select  FORMAT(SUM(REPLACE(volume, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '1' 
                                   LIMIT 1" );
        $total_pro_p =  DB::select(" select  FORMAT(SUM(REPLACE(provision, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '1' 
                                   LIMIT 1" );

        $pipeline_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Pipeline')->get(); 
        $hold_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Holds')->get(); 
        $won_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Won')->get(); 
        $lost_cust = DB::table("customer_info")->where('chanel_id', '1')->where('status', 'Lost')->get(); 

        if($role == 'admin'){
            return view('admin.results.results')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust);
        }else if($role == 'employee'){
            return view('employee.results.results')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust);
        } 
        else{
            return redirect()->back();
        }
         
    }

    public function results_new()
    
    {
        $role = Auth::user()->role;  
        $total_vol =  DB::select(" select  SUM(REPLACE(volume, '.', ''))  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_pro =  DB::select(" select  SUM(REPLACE(provision, '.', ''))  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $won_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Won')->count();
        $pipeline_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Pipeline')->count();
        $holds_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Holds')->count();
        $lost_status = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Lost')->count();

        $service_count =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                   ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                   inner join chanel_services cs on ci.service_id = cs.id 
                                   where ci.chanel_id = '2' 
                                   group by  cs.service_name,cs.bg_colr,cs.txt_colr " );  
        $service_counts =  DB::select(" SELECT  cs.service_name,cs.bg_colr,cs.txt_colr, COUNT(*),
                                        ROUND((COUNT(*) / (SELECT COUNT(*) FROM customer_info WHERE chanel_id = '2' )) * 100,2) AS 'percentage' FROM customer_info ci 
                                        inner join chanel_services cs on ci.service_id = cs.id 
                                        where ci.chanel_id = '2' 
                                        group by  cs.service_name,cs.bg_colr,cs.txt_colr " ); 
        $total_ref_pg = DB::table("customer_info")->where('chanel_id', '2')->count(); 

        $total_vol_p =  DB::select(" select  FORMAT(SUM(REPLACE(volume, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won'
                                   and chanel_id = '2' 
                                   LIMIT 1" );
        $total_pro_p =  DB::select(" select  FORMAT(SUM(REPLACE(provision, '.', '')), 0, 'de_DE')  AS price from customer_info
                                   where status = 'Won' 
                                   and chanel_id = '2' 
                                   LIMIT 1" );

        $pipeline_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Pipeline')->get(); 
        $hold_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Holds')->get(); 
        $won_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Won')->get(); 
        $lost_cust = DB::table("customer_info")->where('chanel_id', '2')->where('status', 'Lost')->get(); 

        if($role == 'admin'){
            return view('admin.results.results_new')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust);
        } else if($role == 'employee'){
            return view('employee.results.results_new')
            ->with('total_vol', $total_vol)
            ->with('total_pro', $total_pro)
            ->with('pipeline_status', $pipeline_status)
            ->with('won_status', $won_status)
            ->with('holds_status', $holds_status)
            ->with('lost_status', $lost_status)
            ->with('service_count', $service_count)
            ->with('service_counts', $service_counts)
            ->with('total_ref_pg', $total_ref_pg)
            ->with('total_vol_p', $total_vol_p)
            ->with('total_pro_p', $total_pro_p)
            ->with('pipeline_cust', $pipeline_cust)
            ->with('hold_cust', $hold_cust)
            ->with('won_cust', $won_cust)
            ->with('lost_cust', $lost_cust);
        } 
        else{
            return redirect()->back();
        }
         
    }


    //Result Page

    public function changeStatus(Request $request)
    {
        if($request->status == 'Pipeline'){
            $user = CustomerInfo::find($request->id);
            $user->status = $request->status;
            $user->pipeline_date = now();
            $user->save();
        }else if($request->status == 'Won'){ 
            $user = CustomerInfo::find($request->id);
            $user->status = $request->status;
            $user->won_date = now();
            $user->save();
        }else if($request->status == 'Holds'){
            $user = CustomerInfo::find($request->id);
            $user->status = $request->status;
            $user->hold_date = now();
            $user->save();
        }else if($request->status == 'Lost'){
            $user = CustomerInfo::find($request->id);
            $user->status = $request->status;
            $user->lost_date = now();
            $user->save(); 
        }else{

        }
        
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    //Chanel
    public function add_chanel()
    
    {
        $role = Auth::user()->role; 
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 
        if($role == 'admin'){
            return view('admin.chanel.add_chanel')
            ->with('chanel', $chanel);
        } 
        else if($role == 'employee'){
            return view('employee.chanel.add_chanel')
            ->with('chanel', $chanel);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }


    public function create_chanel(Request $request)
    
    {  
        $user_id = Auth::user()->id;
         
        Chanel::create([
            'chanel_name' => $request->input('chanel_name'),  
            'date' => now(),
            'status' => 'open',
            'user_id' => $user_id,
        ]);
 

        return response()->json(['success'=>'Added successfully']);
        
        
    }

    public function update_chanel(Request $request)
    
    {  
        $user_id = Auth::user()->id; 
        DB::table('chanels')
                    ->where('id', $request->input('id'))
                    ->update([ 'chanel_name' => $request->input('chanel_name'),  
                    'user_id' => $user_id,
                    'date' => now() ]); 
        
         
        return response()->json(['success'=>'Update successfully']);
        
        
    }

    public function delete_chanel($id)
    
    {  
        DB::table('chanels')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'date' => now(), 
                        'user_id' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }

    //Chanel Service

    public function add_chanel_service()
    
    {
        $role = Auth::user()->role; 
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 
        $chanel_service =  \DB::table('chanel_services') 
                            ->leftjoin('chanels', 'chanels.id', '=', 'chanel_services.chanel_id') 
                            ->Select('chanel_services.*',  'chanels.chanel_name')  
                            ->where('chanel_services.status', 'open')
                            ->get(); 
        if($role == 'admin'){
            return view('admin.chanel.add_chanel_service')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service);
        } 
        else if($role == 'employee'){
            return view('employee.chanel.add_chanel_service')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }

    public function create_service(Request $request)
    
    {  
        $user_id = Auth::user()->id; 
        ChanelService::create([
            'service_name' => $request->input('service_name'),  
            'chanel_id' => $request->input('chanel_id'),  
            'txt_colr' => $request->input('colorPicker'),  
            'bg_colr' => $request->input('colorPicker'), 
            'date' => now(),
            'status' => 'open',
            'user_id' => $user_id,
        ]);
 

        return response()->json(['success'=>'Added successfully']);
        
        
    }

    public function edit_service($id)
    {   
        $role = Auth::user()->role; 
        $edit_service = ChanelService::find($id); 
       
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 
         
        if($role == 'admin'){
            return view('admin.chanel.edit_service') 
                  ->with('chanel', $chanel) 
                  ->with('edit_service', $edit_service);
        } 
        else if($role == 'employee'){
            return view('employee.chanel.edit_service') 
                  ->with('chanel', $chanel) 
                  ->with('edit_service', $edit_service);
        } 
        else{
            return redirect()->back();
        }

        
         
    }


    public function update_service(Request $request, $id)
     
    {    
        $role = Auth::user()->role; 
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 
        // $same_colr =  \DB::table('chanel_services')->where('txt_colr', $request->input('txt_colr'))->first(); 
        $chanel_service =  \DB::table('chanel_services') 
                            ->leftjoin('chanels', 'chanels.id', '=', 'chanel_services.chanel_id') 
                            ->Select('chanel_services.*',  'chanels.chanel_name')  
                            ->where('chanel_services.status', 'open')
                            ->get(); 
        DB::table('chanel_services')
                    ->where('id', $id)
                    ->update([
                        'service_name' => $request->input('service_name'),  
                        'chanel_id' => $request->input('chanel_id'),
                        'txt_colr' => $request->input('txt_colr'),  
                        'bg_colr' => $request->input('txt_colr'), 
                        'user_id' => Auth::user()->id,
                        'date' =>now()  ]); 
        if($role == 'admin'){
            return redirect('admin/add_chanel_service')
                            ->with('chanel', $chanel)
                            ->with('chanel_service', $chanel_service);
        }else if($role == 'employee'){
            return redirect('employee/add_chanel_service')
                            ->with('chanel', $chanel)
                            ->with('chanel_service', $chanel_service);
        }else{
                return redirect()->back();
        }
         
    }


    public function delete_service($id)
    
    {  
        DB::table('chanel_services')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'date' => now(), 
                        'user_id' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }

    //Add Customer
    public function add_customer()
    
    {
        $role = Auth::user()->role; 
        $customer_info =  \DB::table('customer_info')
                            ->leftjoin('chanels', 'chanels.id', '=', 'customer_info.chanel_id') 
                            ->leftjoin('chanel_services', 'chanel_services.id', '=', 'customer_info.service_id') 
                            ->Select('customer_info.*',  'chanels.chanel_name', 'chanel_services.service_name')  
                            ->whereIn('customer_info.status', ['Pipeline', 'Holds', 'Won', 'Lost'])
                            ->get(); 
         
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 

        $chanel_service =  \DB::table('chanel_services') 
                            ->leftjoin('chanels', 'chanels.id', '=', 'chanel_services.chanel_id') 
                            ->Select('chanel_services.*',  'chanels.chanel_name')  
                            ->where('chanel_services.status', 'open')
                            ->get(); 
        if($role == 'admin'){
            return view('admin.customer.add_customer')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service)
            ->with('customer_info', $customer_info);
        } 
        else if($role == 'employee'){
            return view('employee.customer.add_customer')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service)
            ->with('customer_info', $customer_info);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }

    // Fetch records
    public function getService($departmentid=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = ChanelService::orderby("service_name","asc")
        			->select('id','service_name')
        			->where('chanel_id',$departmentid)
        			->get();
  
        return response()->json($empData);
     
    }


    public function getNewService($departmentid=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = ChanelService::orderby("service_name","asc")
        			->select('id','service_name')
        			->where('chanel_id',$departmentid)
        			->get();
  
        return response()->json($empData);
     
    }

    public function create_customer(Request $request)
    
    {  
        $user_id = Auth::user()->id;
        $pipe_date = null;
        $hold_date = null;
        $won_date = null;
        $lost_date = null;
        if($request->input('status') == 'Pipeline'){
            $pipe_date = now();
        }else if($request->input('status') == 'Holds'){
             $hold_date = now();
        }else if($request->input('status') == 'Won'){
             $won_date = now();
        }else if($request->input('status') == 'Lost'){
            $lost_date = now();
        } 
         
        CustomerInfo::create([
            'first_name' => $request->input('first_name'),  
            'last_name' => $request->input('last_name'),   
            'email' => $request->input('email'),   
            'phone_no' => $request->input('phone_no'),   
            'volume' => $request->input('volume'),   
            'provision' => $request->input('provision'),   
            'capital_income' => $request->input('capital_income'),  
            'chanel_id' => $request->input('chanel_ids'), 
            'service_id' => $request->input('service_ids'), 
            'status' => $request->input('status'), 
            'date' => now(), 
            'pipeline_date' => $pipe_date,
            'hold_date' => $hold_date,
            'won_date' => $won_date,
            'lost_date' => $lost_date,
            'user_id' => $user_id,
        ]);
 

        return response()->json(['success'=>'Added successfully']);
        
        
    }

    public function edit_customer($id)
    {   
        $role = Auth::user()->role; 
        $edit_customer = CustomerInfo::find($id); 
       
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 
        $chanel_service =  \DB::table('chanel_services')->where('id', $edit_customer->service_id)->first();  
        if($role == 'admin'){
            return view('admin.customer.edit_customer') 
                  ->with('chanel', $chanel) 
                  ->with('edit_customer', $edit_customer)
                  ->with('chanel_service', $chanel_service);
        } 
        else if($role == 'employee'){
            return view('employee.customer.edit_customer') 
                  ->with('chanel', $chanel) 
                  ->with('edit_customer', $edit_customer)
                  ->with('chanel_service', $chanel_service);
        } 
        else{
            return redirect()->back();
        }

        
         
    }
    

    public function update_customer(Request $request, $id)
     
    {    
        $role = Auth::user()->role; 
        $user_id = Auth::user()->id;
        $check_dates = DB::table('customer_info')->where('id', $id)->first(); 
         
        if($request->input('status') == 'Pipeline' && $check_dates->pipeline_date == ''){
            $pipe_date = now();
        }else{
            $pipe_date = $check_dates->pipeline_date;
        }

        if($request->input('status') == 'Holds' && $check_dates->hold_date == ''){
             $hold_date = now();
        }else{
            $hold_date = $check_dates->hold_date;
        }
        
        if($request->input('status') == 'Won' && $check_dates->won_date == ''){
            $won_date = now();
        }else{
            $won_date = $check_dates->won_date;
        }

        if($request->input('status') == 'Lost' && $check_dates->lost_date == ''){
            $lost_date = now();
        }else{
            $lost_date = $check_dates->lost_date;
        }


        DB::table('customer_info')
                    ->where('id', $id)
                    ->update([
                        'first_name' => $request->input('first_name'),  
                        'last_name' => $request->input('last_name'),   
                        'email' => $request->input('email'),   
                        'phone_no' => $request->input('phone_no'),   
                        'volume' => $request->input('volume'),   
                        'provision' => $request->input('provision'), 
                        'capital_income' => $request->input('capital_income'),    
                        'chanel_id' => $request->input('chanel_id'), 
                        'service_id' => $request->input('service_id'), 
                        'status' => $request->input('status'), 
                        'pipeline_date' => $pipe_date,
                        'hold_date' => $hold_date,
                        'won_date' => $won_date,
                        'lost_date' => $lost_date,
                        'user_id' => $user_id,  ]); 
        if($role == 'admin'){
            return redirect('admin/customer_list');
        }else if($role == 'employee'){
            return redirect('employee/customer_list');
        }else{
                return redirect()->back();
        }
         
    }


    public function delete_customer($id)
    
    {  
        DB::table('customer_info')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'date' => now(), 
                        'user_id' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }


    public function customer_list()
    
    {
        $role = Auth::user()->role; 
        $customer_info =  \DB::table('customer_info')
                            ->leftjoin('chanels', 'chanels.id', '=', 'customer_info.chanel_id') 
                            ->leftjoin('chanel_services', 'chanel_services.id', '=', 'customer_info.service_id') 
                            ->Select('customer_info.*',  'chanels.chanel_name', 'chanel_services.service_name')  
                            ->whereIn('customer_info.status', ['Pipeline', 'Holds', 'Won', 'Lost'])
                            ->orderBy('id', 'DESC')
                            ->get(); 
         
        $chanel =  \DB::table('chanels')->where('status', 'open')->get(); 

        $chanel_service =  \DB::table('chanel_services') 
                            ->leftjoin('chanels', 'chanels.id', '=', 'chanel_services.chanel_id') 
                            ->Select('chanel_services.*',  'chanels.chanel_name')  
                            ->where('chanel_services.status', 'open')
                            ->get(); 
        if($role == 'admin'){
            return view('admin.customer.customer_list')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service)
            ->with('customer_info', $customer_info);
        } 
        else if($role == 'employee'){
            return view('employee.customer.customer_list')
            ->with('chanel', $chanel)
            ->with('chanel_service', $chanel_service)
            ->with('customer_info', $customer_info);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }

    //Capital

    public function immobilien_customer_list()
    
    {
        $role = Auth::user()->role; 
        $customer_info =  \DB::table('customer_info')
                            ->leftjoin('chanels', 'chanels.id', '=', 'customer_info.chanel_id') 
                            ->leftjoin('chanel_services', 'chanel_services.id', '=', 'customer_info.service_id') 
                            ->Select('customer_info.*',  'chanels.chanel_name', 'chanel_services.service_name')  
                            ->whereIn('customer_info.status', ['Pipeline', 'Holds', 'Won', 'Lost'])
                            ->where('customer_info.chanel_id', '=', '1')
                            ->orderBy('id', 'DESC')
                            ->get(); 
         
         
        if($role == 'admin'){
            return view('admin.capital.immobilienmakler_customer_list')
            ->with('customer_info', $customer_info);
        } 
        else if($role == 'employee'){
            return view('employee.capital.immobilienmakler_customer_list')
            ->with('customer_info', $customer_info);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }


    public function finanzierung_customer_list()
    
    {
        $role = Auth::user()->role; 
        $customer_info =  \DB::table('customer_info')
                            ->leftjoin('chanels', 'chanels.id', '=', 'customer_info.chanel_id') 
                            ->leftjoin('chanel_services', 'chanel_services.id', '=', 'customer_info.service_id') 
                            ->Select('customer_info.*',  'chanels.chanel_name', 'chanel_services.service_name')  
                            ->whereIn('customer_info.status', ['Pipeline', 'Holds', 'Won', 'Lost'])
                            ->where('customer_info.chanel_id', '=', '2')
                            ->orderBy('id', 'DESC')
                            ->get(); 
         
         
        if($role == 'admin'){
            return view('admin.capital.immobilienfinanzierung_customer_list')
            ->with('customer_info', $customer_info);
        } 
        else if($role == 'employee'){
            return view('employee.capital.immobilienfinanzierung_customer_list')
            ->with('customer_info', $customer_info);
        } 
        else{
            return redirect()->back();
        }
        
         
         
    }

}
