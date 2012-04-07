<div class="modal hide in" id="seedModal_{$user_object["id"]}">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3>Initial Code for user '{$user_object["login"]}'</h3>
    </div>
    <div class="modal-body">
        <strong>
            This is your Initial Code. If you use a smartphone, you can use the QR-Code.
        </strong>

        <p class="well">
            {$user_object["otpSeed"]}
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
    </div>
</div>