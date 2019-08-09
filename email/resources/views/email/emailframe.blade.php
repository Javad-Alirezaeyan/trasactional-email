<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/9/19
 * Time: 11:07 AM
 */

?>

<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/9/19
 * Time: 10:58 AM
 */

?>

<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/8/19
 * Time: 2:11 PM
 */

?>

@extends("layouyts.master");
@section('title', "Email List");

@section('content')
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-xlg-2 col-lg-4 col-md-4">
                        <div class="card-block inbox-panel"><a href="compose" class="btn btn-danger m-b-20 p-10 btn-block waves-effect waves-light">Compose</a>
                            <ul class="list-group list-group-full">
                                <!-- <li class="list-group-item active"> <a href="javascript:void(0)"><i class="mdi mdi-gmail"></i> Inbox </a><span class="badge badge-success ml-auto">6</span></li>-->
                                <li class="list-group-item ">
                                    <a href="/"> <i class="mdi mdi-file-document-box"></i> Sent Mail </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="/star"> <i class="mdi mdi-star"></i> Starred </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="/draft"> <i class="mdi mdi-send"></i> Draft </a><span class="badge badge-danger ml-auto">3</span></li>

                                <li class="list-group-item">
                                    <a href="/trash"> <i class="mdi mdi-delete"></i> Trash </a>
                                </li>
                            </ul>
                            <h3 class="card-title m-t-40">Labels</h3>
                            <div class="list-group b-0 mail-list">
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-warning m-r-10"></span>Queued</a>
                                <!--<a href="#" class="list-group-item"><span class="fa fa-circle text-purple m-r-10"></span>Delivered</a>-->
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-danger m-r-10"></span>Not-Delivered</a>
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-info m-r-10"></span>Sent</a>
                                <a href="#" class="list-group-item"><span class="fa fa-circle text-success m-r-10"></span>Delivered</a>
                            </div>
                        </div>
                    </div>
                    @include('email.'. $partialview)
                </div>
            </div>
        </div>
    </div>


@endsection
