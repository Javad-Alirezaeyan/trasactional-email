<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/9/19
 * Time: 10:58 AM
 */

?>


<div class="card-block">
    <h3 class="card-title">Compose New Message</h3>
    <div class="form-group">
        <input class="form-control" placeholder="To:">
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Subject:">
    </div>
    <div class="form-group">
        <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
    </div>
    <h4><i class="ti-link"></i> Attachment</h4>
    <form action="#" class="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>
    <button type="submit" class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
    <button class="btn btn-inverse m-t-20"><i class="fa fa-times"></i> Discard</button>
</div>