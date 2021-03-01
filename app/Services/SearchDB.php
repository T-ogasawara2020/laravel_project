<?php

namespace App\Services;
class SearchDB{
    public static function searchInspect($data,$search){
        if($search !== null){
        //relace  full-width with half-width
            $search_split = mb_convert_kana($search,'s');

            //separate with blanks
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //word loop
            foreach($search_split2 as $value){
                $data->where('your_name','like','%'.$value.'%');
            }
            $data->select('id','your_name', 'title','created_at');
            $data->orderBy('created_at', 'asc');
        };
        return $data;
}
}