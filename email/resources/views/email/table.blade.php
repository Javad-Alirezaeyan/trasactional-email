<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/8/19
 * Time: 2:11 PM
 */

?>
<div class="col-xlg-10 col-lg-8 col-md-8">
    <div class="card-block">
        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary font-18 text-dark"><i class="mdi mdi-inbox-arrow-down"></i></button>
            <button type="button" class="btn btn-secondary font-18 text-dark"><i class="mdi mdi-alert-octagon"></i></button>
            <button type="button" class="btn btn-secondary font-18 text-dark"><i class="mdi mdi-delete"></i></button>
        </div>
        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary text-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-folder font-18 "></i> </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#">Dropdown link</a> <a class="dropdown-item" href="#">Dropdown link</a> </div>
            </div>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn text-dark btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-label font-18"></i> </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#">Dropdown link</a> <a class="dropdown-item" href="#">Dropdown link</a> </div>
            </div>
        </div>
        <button type="button " class="btn btn-secondary m-r-10 m-b-10 text-dark"><i class="mdi mdi-reload font-18"></i></button>
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn m-b-10 text-dark btn-secondary p-10 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#">Mark as all read</a> <a class="dropdown-item" href="#">Dropdown link</a> </div>
        </div>
    </div>
    <div class="card-block p-t-0">
        <div class="card b-all shadow-none">
            <div class="inbox-center table-responsive">
                <table-email>

                </table-email>
            </div>
        </div>
    </div>
</div>