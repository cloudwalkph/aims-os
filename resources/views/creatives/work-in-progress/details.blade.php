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
                        <div class="panel-heading" style="min-height: 100px;">
                            <div class="col-md-6">
                                <h5><strong>Job Order Number</strong> : {{ $jo->jobOrder->job_order_no }}</h5>
                                <h5><strong>Project Name</strong> : {{ $jo->jobOrder->project_name }}</h5>
                                <h5><strong>Remarks</strong>: {{ $jo->remarks }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Assigned Persons</strong> : {{ $jo->assignedUser->profile->first_name }} {{ $jo->assignedUser->profile->last_name }} </h5>
                                <h5><strong>Internal Deadline</strong> : {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->deadline))->toFormattedDateString() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>


                {{--Production Template--}}
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

                {{--Creatives Tasks--}}
                <div class="col-md-12">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-8">Write a comment...</div>
                        </div>

                        <textarea class="comments" name="message" placeholder="Write a comment..."
                                  style="width: 100%; height: 200px; font-size: 14px;
                              line-height: 18px; border:1px solid #dddddd; padding: 10px; " required>
                        </textarea>

                        <div class="row">
                            <div class="col-md-2 col-md-offset-6">
                                <input type="file" name="file" id="uploadFile" />
                            </div>
                            <div class="col-md-2">
                                <div class="pull-right">
                                    <input type="checkbox" name="is_final" value="1" id="checkArtwork" />
                                    <label for="checkArtwork">&nbsp; Final Artwork</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-block btn-primary pull-right">Post</button>
                            </div>
                        </div>
                    </form>
                </div>

                <hr />
                <h3>Task Updates</h3>
                <div class="col-md-12">
                    <div class="row">
                        @if (! count($jo->tasks))
                            <div class="comments-container">
                                <p>No Updates Yet</p>
                            </div>
                        @endif

                        @foreach ($jo->tasks as $task)
                            <div class="comments-container">
                                <ul id="comments-list" class="comments-list">
                                    <li>
                                        <div class="comment-main-level">
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name">{{ $jo->assignedUser->profile->first_name }} {{ $jo->assignedUser->profile->last_name }}</h6>
                                                    <h6 class="comment-date">{{ $task->created_at->toFormattedDateString() }}</h6>
                                                </div>

                                                {{--<img src="https://www.gstatic.com/webp/gallery3/1.png" class="img-responsive" alt="">--}}

                                                <p class="comment-content" style="min-height: 150px">
                                                    {{ $task->message }}
                                                </p>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
