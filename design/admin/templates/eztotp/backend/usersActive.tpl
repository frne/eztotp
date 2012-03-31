{def $adminPagePart="users/active"
$userList = fetch("eztotpadmin", "user_list", hash("type", "active"))}

<h1 class="totp">
    Active Users
</h1>

<div id="totp" class="container">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>E-Mail</th>
            <th>Groups</th>
            <th>OTP State</th>
            <th>OTP Initial Seed</th>
            <th>Edit</th>
        </tr>
    {foreach $userList as $user}
        <tr>
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
            <td class="otpSeed">
                {$user["otpSeed"]}
            </td>
            <td class="editUser">
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
            </td>

        </tr>
    {/foreach}
    </table>
</div>
<script type="text/javascript">
    jQuery("li[rel='{$adminPagePart}']").addClass("active");
</script>