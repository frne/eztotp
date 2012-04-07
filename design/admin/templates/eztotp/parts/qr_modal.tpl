<div class="modal hide in" id="qrModal_{$user_object["id"]}">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3>QR-Code for user '{$user_object["login"]}'</h3>
    </div>
    <div class="modal-body">
        <strong>
            Scan this QR-Code with your Google Authenticator App
        </strong>

        <div>
            <img src="{concat("/eztotp/qr/", $user_object["id"])|ezurl("no")}" alt="{$user_object["otpSeed"]}" />
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
    </div>
</div>