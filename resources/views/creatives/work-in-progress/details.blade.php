@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Creatives<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/creatives"><i class="fa fa-dashboard"></i> Creatives Department</a>
                    </li>
                    <li>
                        <a href="/creatives/work-in-progress"><i class="fa fa-archive"></i> Work in Progress Lists</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-list"></i> Work in Progress Details
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-sm-12">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="min-height: 80px;">
                            <div class="col-md-6">
                                <h5>Job Order Number : {{ $jo->jo->job_order_no }}</h5>
                                <h5>Project Name : {{ $jo->jo->project_name }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Deadline : {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->deadline))->toFormattedDateString() }}</h5>
                                <h5>Assigned Persons : {{ $jo->assigned->user->profile->first_name }} {{ $jo->assigned->user->profile->last_name }} </h5>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 hide">
                    <h4>Productions Template</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Template</th>
                            <th>Uploaded By</th>
                            <th>Uploaded Date</th>
                            <th>Remarks</th>
                            <th>Download</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Occular Template</td>
                            <td>Alleo Indong</td>
                            <td>February 17, 2017</td>
                            <td>Please use vibrant colors</td>
                            <td><i class="fa fa-lg fa-download"></i></td>
                        </tr>
                        </tbody>
                    </table>

                    <hr/>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">Write a comment...</div>
                        <div class="col-md-4"><input type="file" name="uploadFile" id="uploadFile" /></div>
                    </div>
                    <textarea class="comments" placeholder="Write a comment..."
                              style="width: 100%; height: 200px; font-size: 14px;
                              line-height: 18px; border:1px solid #dddddd; padding: 10px; ">
                    </textarea>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-7">
                            <input type="checkbox" name="checkArtwork" id="checkArtwork" />
                            <label for="checkArtwork">&nbsp; Final Artwork</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary pull-right">Post</button>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="col-md-12">
                    <div class="row">
                        <div class="comments-container">
                            <ul id="comments-list" class="comments-list">
                                <li>
                                    <div class="comment-main-level">
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name">Alleo Indong</h6>
                                                <h6 class="comment-date">February 20, 2017</h6>
                                            </div>

                                            <img src="https://www.gstatic.com/webp/gallery3/1.png" class="img-responsive" alt="">

                                            <p class="comment-content" style="min-height: 150px">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cumque,
                                                dignissimos eligendi eveniet ex exercitationem fuga illum in necessitatibus,
                                                officia, officiis perferendis quas qui reiciendis sequi similique
                                                sint vitae voluptatem.
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="comments-container">
                            <ul id="comments-list" class="comments-list">
                                <li>
                                    <div class="comment-main-level">
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name">Alleo Indong</h6>
                                                <h6 class="comment-date">February 18, 2017</h6>
                                            </div>

                                            <p class="comment-content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cumque,
                                                dignissimos eligendi eveniet ex exercitationem fuga illum in necessitatibus,
                                                officia, officiis perferendis quas qui reiciendis sequi similique
                                                sint vitae voluptatem.
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
