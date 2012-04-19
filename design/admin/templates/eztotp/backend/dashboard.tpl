{def $adminPagePart="dashboard"}

<div class="totp">
    <div style="position: relative; display: block;">
        <a target="_blank" href="http://github.com/frne/eztotp">
            <img style="position: absolute; top: 55px; right: -13px; border: 0;"
                 src="https://a248.e.akamai.net/assets.github.com/img/abad93f42020b733148435e2cd92ce15c542d320/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67"
                 alt="Fork me on GitHub">
        </a>
    </div>
{include uri='design:eztotp/parts/checkJavaScript.tpl'}
    <h1>
        Dashboard
    </h1>

    <div class="clear"></div>
    <hr/>
    <div>
        <h2>In development...</h2>
        The following parts of the Backend are working:<br/><br/>
        <ul>
            <li style="list-style: disc !important; ">
                Users
                <ul>
                    <li style="list-style: disc !important; ">Active</li>
                    <li style="list-style: disc !important; ">Inactive</li>
                </ul>
            </li>
            <li style="list-style: disc !important; ">
                Logs
                <ul>
                    <li style="list-style: disc !important; ">Error Log</li>
                    <li style="list-style: disc !important; ">Access Log</li>
                </ul>
            </li>
        </ul>
        <br/><br/><strong>Help me developing, if you want... </strong><br/>
        Fork on GITHub
        <a href="https://github.com/frne/eztotp"
           class="gitforked-button gitforked-watchers">Fork</a>
        <script src="http://gitforked.com/api/1.1/button.js" type="text/javascript"></script>
    </div>
</div>

<script type="text/javascript">
    jQuery("li[rel='{$adminPagePart}']").addClass("active");
</script>
