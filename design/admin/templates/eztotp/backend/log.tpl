<div class="totp">
{include uri='design:eztotp/parts/checkJavaScript.tpl'}
    <h1>
    {$pageTitle}
    </h1>

    <table class="table canBeFiltered">
        <thead>
        <tr>
            <th class="span2">Time</th>
            <th class="span2">User (ID)</th>
            <th class="span1">IP-Address</th>
            <th class="span1">Level</th>
            <th class="span6">Message</th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</div>
{include uri='design:eztotp/parts/logJavascriptInitialisation.tpl'}