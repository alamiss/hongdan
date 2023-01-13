<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MatchListController extends Controller
{
    public function show($name)
    {   
        $client = new Client();
        $request = $client->request('GET','https://open.sportnanoapi.com/api/v5/football/match/schedule/diary', [
            'query' => [
                'user' => 'cqyxs',
                'secret' => 'afd2975f506709986cb45c0b934c3966'
            ]
        ]);
        $match_list = json_decode($request->getBody()->getContents());
        $matchs = $match_list->results->match;
        $competitions = $match_list->results->competition;
        $teams = $match_list->results->team;
        for($i=0; $i<count($matchs); $i++){
            /*星期*/
            $week = array('天','一','二','三','四','五','六');
            $matchs[$i]->week = '周' . $week[date('w', $matchs[$i]->match_time)];

            /*球队信息*/
            foreach($teams as $team){
                if($matchs[$i]->home_team_id == $team->id){
                    $matchs[$i]->home_team_name = $team->name;
                    $matchs[$i]->home_team_logo = $team->logo;
                }elseif($matchs[$i]->away_team_id == $team->id){
                    $matchs[$i]->away_team_name = $team->name;
                    $matchs[$i]->away_team_logo = $team->logo;
                }
            }
            /*赛事信息*/
            foreach($competitions as $competition){
                if($matchs[$i]->competition_id == $competition->id){
                    $matchs[$i]->competition_name = $competition->name;
                    $matchs[$i]->competition_logo = $competition->logo;
                }
            }
            /*比赛状态*/
            $status = array(
                ['id'=>0, 'name'=>'比赛异常'],
                ['id'=>1, 'name'=>'未开赛'],
                ['id'=>2, 'name'=>'上半场'],
                ['id'=>3, 'name'=>'中场'],
                ['id'=>4, 'name'=>'下半场'],
                ['id'=>5, 'name'=>'加时赛'],
                ['id'=>6, 'name'=>'加时赛(弃用)'],
                ['id'=>7, 'name'=>'点球决战'],
                ['id'=>8, 'name'=>'完场'],
                ['id'=>9, 'name'=>'推迟'],
                ['id'=>10, 'name'=>'中断'],
                ['id'=>11, 'name'=>'腰斩'],
                ['id'=>12, 'name'=>'取消'],
                ['id'=>13, 'name'=>'待定']
            );
            $status = json_encode($status);
            $status = json_decode($status);
            foreach($status as $statu){
                if($matchs[$i]->status_id == $statu->id){
                    $matchs[$i]->status_name = $statu->name;
                }
            }
        }
        return view('match_list', ['matchs' => $matchs]);
    }
}

