{def $adminPagePart="users/blocked"}

<h1 class="totp">
    Blocked users
</h1>
<hr/>
<div id="totp container">


</div>
<script type="text/javascript">
    jQuery("li[rel='{$adminPagePart}']").addClass("active");
</script>