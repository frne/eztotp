<div class="totp">
{include uri='design:eztotp/parts/checkJavaScript.tpl'}
<h1>
{$pageTitle}
</h1>

<div class="clear"></div>
<br /><br />

<div class="">
<div class="accordion"
  id="accordion2">
<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle"
      data-toggle="collapse"
      data-parent="#accordion2"
      href="#collapseBase">
      Base
    </a>
  </div>
  <div id="collapseBase"
    class="accordion-body collapse"
    style="height: 0px; ">
    <div class="accordion-inner">
      <div class="control-group">
        <label>
          <strong>
            Key length
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="This is the length, which the generated TOTP-Key's will have. If you change this, All TOTP-Acvcounts have to be regenerated.">
            <span class="badge badge-info">?</span>
          </a>
        </label>
        <input type="text"
          class="span2"
          value="{ezini( 'base', 'keyLength', 'eztotp.ini' )}" />
      </div>

      <div class="control-group">
        <label>
          <strong>
            Key Regeneration Interval
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="The time in seconds for the regeneration of the TOTP-Key's.">
            <span class="badge badge-info">?</span>
          </a>
        </label>
        <input type="text"
          class="span2"
          value="{ezini( 'base', 'keyRegenerationInterval', 'eztotp.ini' )}" />
      </div>

      <div class="control-group">
        <label>
          <strong>
            Time Shift Tolerance
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="Specify how many regeneration-intervals +/- the key will be valid. (To tolerate timeshift between Smartphone and Server)">
            <span class="badge badge-info">?</span>
          </a>
        </label>
        <input type="text"
          class="span2"
          value="{ezini( 'base', 'timeShiftTolerance', 'eztotp.ini' )}" />
      </div>

      <div class="control-group settingsAction">
        <button class="btn btn-success">Save</button>
        <button class="btn btn-danger">Dismiss</button>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle"
      data-toggle="collapse"
      data-parent="#accordion2"
      href="#collapseLog">
      Log
    </a>
  </div>
  <div id="collapseLog"
    class="accordion-body collapse"
    style="height: 0px; ">
  {def $logTypes = ezini( 'log', 'logType', 'eztotp.ini' )}
    <div class="accordion-inner">
      <div class="control-group">
        <label>
          <strong>
            Logging
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="Enable or disable logging generally.">
            <span class="badge badge-info">?</span>
          </a>
        </label>

        <div class="btn-group"
          data-toggle="buttons-radio"
          rel="log">
          <button class="btn {if ezini( 'log', 'log', 'eztotp.ini' )|eq("enabled")}active{/if}"
            rel="enabled">Enabled
          </button>
          <button class="btn {if ezini( 'log', 'log', 'eztotp.ini' )|eq("disabled")}active{/if}"
            rel="disabled">Disabled
          </button>
        </div>
      </div>

      <div class="control-group">
        <label>
          <strong>
            Access Log
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="Enable or disable access logging generally.">
            <span class="badge badge-info">?</span>
          </a>
        </label>

        <div class="btn-group"
          data-toggle="buttons-radio"
          rel="logType[access]">
          <button class="btn {if $logTypes.access|eq("enabled")}active{/if}"
            rel="enabled">Enabled
          </button>
          <button class="btn {if $logTypes.access|eq("disabled")}active{/if}"
            rel="disabled">Disabled
          </button>
        </div>
      </div>

      <div class="control-group">
        <label>
          <strong>
            Error Log
          </strong>
          &nbsp;
          <a href="#"
            rel="popover"
            data-original-title="Help"
            data-content="Enable or disable error logging generally.">
            <span class="badge badge-info">?</span>
          </a>
        </label>

        <div class="btn-group"
          data-toggle="buttons-radio"
          rel="logType[error]">
          <button class="btn  {if $logTypes.error|eq("enabled")}active{/if}"
            rel="enabled">Enabled
          </button>
          <button class="btn  {if $logTypes.error|eq("disabled")}active{/if}"
            rel="disabled">Disabled
          </button>
        </div>
      </div>

      <div class="control-group settingsAction">
        <button class="btn btn-success">Save</button>
        <button class="btn btn-danger">Dismiss</button>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle"
      data-toggle="collapse"
      data-parent="#accordion2"
      href="#collapseMisc">
      Under the hood
    </a>
  </div>
  <div id="collapseMisc"
    class="accordion-body collapse"
    style="height: 0px; ">
    <div class="accordion-inner">
      Please do edit this settings directly in the 'eztotp.ini'

    </div>
  </div>
</div>
</div>
</div>

</div>
<script type="text/javascript">
  jQuery("li[rel='settings']").addClass("active");
</script>
<script type="text/javascript">
  {literal}
  (function () {
    $("[rel=popover]").popover();
  })();
  {/literal}
</script>