@extends('layouts')

@section('title', '这是世界杯列表页')
@section('pagename', 'match-list-page')

@section('content')
    <section class="match-list">
        <div class="list-head clearfix">
            <h1 class="title">世界杯</h1>
            <select class="pull-down form-control">
                <option value="2022赛季">2022赛季</option>
                <option value="2022赛季">2021赛季</option>
                <option value="2022赛季">2020赛季</option>
            </select>
            <a href="/">赛事回查 ></a>
        </div>
        <div class="list-main">
            <table class="table title-table">
                <tbody>
                    <colgroup class="match-table-width"><col><col><col><col><col><col><col><col><col><col></colgroup>
                    <tr>
                        <th>时间</th>
                        <th>赛事</th>
                        <th>状态</th>
                        <th></th>
                        <th>主队VS客队</th>
                        <th></th>
                        <th><div class="result"><span>胜</span></div></th>
                        <th><div class="result"><span>平</span></div></th>
                        <th><div class="result"><span>负</span></div></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
            <div class="">
                <div class="time">
                    <div class="on-off"><span>收起</span></div>
                    <span>2022-12-10</span>
                    <span>星期六</span>
                </div>
            </div>
            <table class="table item-table">
                <tbody>
                    <colgroup class="match-table-width"><col><col><col><col><col><col><col><col><col><col></colgroup>
                    <?php foreach($matchs as $key=>$match):?>
                    <tr class="list-item">
                        <td><div class="item-text"><span><?php echo $match->week; ?><?php echo str_pad($key+1, 3, '0', STR_PAD_LEFT); ?></span></div></td>
                        <td><div class="item-name"><a class=""><?php echo $match->competition_name; ?></a></div></td>
                        <td><div class="item-text"><span><?php echo $match->status_name; ?></span></div></td>
                        <td><div class="item-text"><span><?php echo date('m-d H-i', $match->match_time); ?></span></div></td>
                        <td>
                            <div class="item-team clearfix">
                                <div class="user"><span>[<?php echo $match->home_position; ?>]</span><?php echo $match->home_team_name; ?></div>
                                <div class="or"><span>VS</span></div>
                                <div class="user"><?php echo $match->away_team_name; ?><span>[<?php echo $match->away_position; ?>]</span></div>
                            </div>
                        </td>
                        <td></td>
                        <td><div class="item-result"><span>0</span><span>0</span></div></td>
                        <td><div class="item-result"><span>0</span><span>0</span></div></td>
                        <td><div class="item-result"><span>0</span><span>0</span></div></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
@endsection