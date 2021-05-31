<?php

namespace Bageur\BuktiTransaksi\Model;

use Bageur\Auth\Model\upload;
use Illuminate\Database\Eloquent\Model;

class bukti_transaksi extends Model
{
    protected $table = 'bgr_bukti_transaksi';

    public function scopeDatatable($query,$request,$page=12)
    {
        $search       = ["type"];
        $searchqry    = '';

        $searchqry = "(";
        foreach ($search as $key => $value) {
            if($key == 0){
                $searchqry .= "lower($value) like '%".strtolower($request->search)."%'";
            }else{
                $searchqry .= "OR lower($value) like '%".strtolower($request->search)."%'";
            }
        }

        $searchqry .= ")";
        if(@$request->sort_by){
            if(@$request->sort_by != null){
            	$explode = explode('.', $request->sort_by);
                 $query->orderBy($explode[0],$explode[1]);
            }else{
                  $query->orderBy('created_at','desc');
            }

             $query->whereRaw($searchqry);
        }else{
             $query->whereRaw($searchqry);
        }

        if($request->get == 'all'){
            return $query->get();
        }else{
                return $query->paginate($page);
        }

    }

    public function bukti()
    {
        return $this->hasOne('Bageur\Auth\Model\upload', 'id', 'bgr_upload_id');
    }
}
