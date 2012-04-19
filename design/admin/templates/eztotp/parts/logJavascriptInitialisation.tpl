<script type="text/javascript">
    jQuery("li[rel='log/{$logType}']").addClass("active");

    window.eztotp = window.eztotp || {ldelim}{rdelim};
    window.eztotp.settings = window.eztotp.settings || {ldelim}{rdelim};
    window.eztotp.settings.logServiceUrl = '{concat("eztotpadminaction/getlogdata/", $logType, "/")|ezurl("no")}';

    jQuery(document).ready(function () {ldelim}
        eztotp.admin.logAdmin.getLogData(0, 10);
    {rdelim});
</script>