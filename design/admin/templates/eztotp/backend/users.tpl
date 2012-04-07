

{switch match=$userType}
    {case match='active'}
        {def $adminPagePart="users/active"
        $pageTitle="Active Users"
        $userList = fetch("eztotpadmin", "user_list", hash("type", "active"))}
    {/case}

    {case match='blocked'}
        {def $adminPagePart="users/blocked"
        $pageTitle="Blocked Users"
        $userList = fetch("eztotpadmin", "user_list", hash("type", "blocked"))}
    {/case}

    {case match='inactive'}
        {def $adminPagePart="users/inactive"
        $pageTitle="Inactive Users"
        $userList = fetch("eztotpadmin", "user_list", hash("type", "inactive"))}
    {/case}

    {case match=''}
        {def $adminPagePart="users"
        $pageTitle="Users"
        $userList = fetch("eztotpadmin", "user_list")}
    {/case}
{/switch}

<div class="totp">
    <h1>
        {$pageTitle}
    </h1>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>E-Mail</th>
            <th>Groups</th>
            <th>TOTP State</th>
            <th>TOTP Account Data</th>
            <th>Edit</th>
        </tr>
    {foreach $userList as $user}
        <tr class="userListItem_{$user["id"]}">
            <td class="id">
                {$user["id"]}
            </td>
            <td class="login">
                {$user["login"]}
            </td>
            <td class="mail">
                {$user["mail"]}
            </td>
            <td class="groups">
                {$user["groups"]}
            </td>
            <td class="otpState">
                {$user["otpState"]|eztotp_user_state()}

            </td>
            <td class="otpAccountData">
                {if $user["otpSeed"]|eq("")}
                    <p>OTP Authentication not available!</p>
                {else}
                    <div class="btn-group">
                        <button class="btn" data-toggle="modal" href="#qrModal_{$user["id"]}">QR Code</button>
                        <button class="btn" data-toggle="modal" href="#seedModal_{$user["id"]}">Initial Code</button>
                    </div>
                    {include uri='design:eztotp/parts/qr_modal.tpl' user_object=$user}
                    {include uri='design:eztotp/parts/seed_modal.tpl' user_object=$user}
                {/if}

            </td>
            <td class="editUser">
                {if or( $user["otpState"]|eq(""), $user["otpState"]|eq(0) )}
                    <button class="btn btn-primary" data-toggle="modal" href="#enableUserModal_{$user["id"]}">Enable</button>
                    {include uri='design:eztotp/parts/enable_user_modal.tpl' user_object=$user}
                {else}
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Set Active</a></li>
                            <li><a href="#">Set Inactive</a></li>
                            <li><a href="#">Set Blocked</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Enable OTP Support</a></li>
                            <li><a href="#">Disable OTP Support</a></li>
                            <li><a href="#">Reset OTP Seed</a></li>
                        </ul>
                    </div>
                {/if}
            </td>

        </tr>
    {/foreach}
    </table>
</div>
<script type="text/javascript">
    jQuery("li[rel='{$adminPagePart}']").addClass("active");
</script>