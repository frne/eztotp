<div class="totp">
{include uri='design:eztotp/parts/checkJavaScript.tpl'}
    <h1>
    {$pageTitle}
    </h1>

    <table class="table">
        <tr>
            <th>Time</th>
            <th>User ID</th>
            <th>IP-Address</th>
            <th>Level</th>
            <th>Message</th>
        </tr>
        <tr class="logListItem logListItemDummy uiTableFilterIgnore" style="display: none;">
            <td class="time">
                time
            </td>
            <td class="user">
                user
            </td>
            <td class="ip">
                ip
            </td>
            <td class="level">
                level
            </td>
            <td class="message">
                message
            </td>
        </tr>
        <tr class="loadMoreTrigger uiTableFilterIgnore" id="loadMoreLogsTrigger">
            <td colspan="5">
                <button class="btn btn-primary">load older entries</button>
            </td>
        </tr>
    </table>
</div>
{include uri='design:eztotp/parts/logJavascriptInitialisation.tpl' logtype="access"}