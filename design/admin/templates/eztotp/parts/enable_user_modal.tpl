<div class="modal hide in enableUserModal" id="enableUserModal_{$user_object["id"]}">
    <div class="modal-header">
        <h3>Enable TOTP authentication for user '{$user_object["login"]}' ?</h3>
    </div>
    <div class="modal-body">
        <p class="actionDescription">
            This user will be forced to user TOTP authentication on next login. <br />
            The QR-Code will be provided after enabling...
        </p>
        <p class="actionResult">
            TOTP authentication is now active for user '{$user_object["login"]}'.
        </p>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);"
           class="btn modalCloseAction"
           data-dismiss="modal">
            Cancel
        </a>
        <a href="javascript:void(0);"
           class="btn btn-primary enableUserAction"
           rel="{concat("eztotpadminaction/enableuser/", $user_object["id"])|ezurl("no")}">
            Enable
        </a>
    </div>
</div>