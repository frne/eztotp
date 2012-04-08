<script type="text/javascript">
    jQuery("li[rel='log/{$logtype}']").addClass("active");

    window.eztotp = window.eztotp || {ldelim}{rdelim};
    window.eztotp.settings = window.eztotp.settings || {ldelim}{rdelim};
    window.eztotp.settings.logServiceUrl = '{concat("eztotpadminaction/getlogdata/", $logtype, "/")|ezurl("no")}';

    jQuery(document).ready(function () {ldelim}
        eztotp.admin.logAdmin.getLogData(10);
    {rdelim});
</script>