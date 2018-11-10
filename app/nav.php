<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class nav extends Model
{
    protected $fillable = [
        'name',
        'url',
        'permission_id',
        'pid'];

    public static function getNavHtml()
    {
        if (!Auth::user()){
            return'';

        }
        $navs=nav::where('pid',0)->get();
        //dd($navs);
        $html='';
        $nav_html = '';
        foreach($navs as $nav) {
            //dd($nav->name);
            $children=nav::where('pid',$nav['id'])->get();
            $children_html = '';
            foreach($children as $child) {
                if(Auth::user()->can($child['url'])){
                    $children_html.='<li><a href="'.$child['url'].'">'.$child['name'].'</a></li>';
                }
            }
            //panduan zicaidan shifou you xianshi
            if($children_html){
                $nav_html .= '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' .$nav['name'].'<span class="caret"></span></a>
                <ul class="dropdown-menu">';
                $nav_html.= $children_html;
                $nav_html.='</ul></li>';
            }
        }
        $html .= $nav_html;
        return $html;
    }


}
