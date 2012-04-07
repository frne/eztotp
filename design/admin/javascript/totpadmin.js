/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

window.eztotp = window.eztotp || {};
window.eztotp.admin = window.eztotp.admin || {};

(function ($) {

    /**
     *
     */
    var globNs = window.eztotp.admin;

    /**
     * @class UserAdmin
     */
    var UserAdmin = function () {
        var self = this;

        this.init = function () {
            jQuery(".enableUserAction").bind("click", function (event) {
                self.enableUser($(this).attr("rel"));
            });
        };

        this.enableUser = function (url) {

            var urlArray = url.split("/");
            var userId = urlArray[urlArray.length-1];

            // change navigation elements
            $("#enableUserModal_" + userId + " .enableUserAction").remove();
            $("#enableUserModal_" + userId + " .modalCloseAction").addClass("btn-primary").removeAttr("data-dismiss").attr("disabled", "disabled").html("Close");

            var jqxhr = $.getJSON(url, function (data) {
                if (data.error) {
                    self.printError(data.errormsg);
                }
                else {

                    switch (data.action) {
                        case "none":
                            self.printSuccess("User is already active.", userId);
                            break;

                        case "created":
                            self.printSuccess("TOTP Object was successfully created. User is now active!", userId);
                            break;

                        case "enabled":
                            self.printSuccess("User activated.", userId);
                            break;
                    }
                }
            })
        };

        this.printError = function (message, id) {

        };

        this.printSuccess = function (message, id) {
            console.log("success!");
            var domObject = $('<div class="alert alert-success">' + message + '</div>');

            $("#enableUserModal_" + id + " .modal-body")
                .prepend(domObject);

            $("#enableUserModal_" + id + " .modalCloseAction")
                .removeAttr("disabled")
                .attr("data-dismiss", "modal")
                .attr("onclick", '$(".userListItem_' + id +'").hide();');
        };
    };

    $(document).ready(function () {
        // bind namespaces
        globNs.userAdmin = new UserAdmin();

        // fire init
        globNs.userAdmin.init();
    });


})(jQuery);